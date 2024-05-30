<?php

namespace App\Http\Controllers;

use App\Mail\PartnerSendRegistration;
use App\Models\AboutSite;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\OrderData;
use App\Models\Partner;
use App\Models\Portofolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FrontendController extends Controller
{
    public function index()
    {
        $getBanner = Cache::remember('banner', now()->addMonth(), function () {
            return Banner::all();
        });

        $services = Cache::remember('services', now()->addMonth(), function () {
            return Service::all();
        });

        $data = [
            'mitra' => Partner::count(),
            'user' => User::count(),
            'order' => OrderData::count(),
        ];

        $blogs = Cache::remember('blogs', now()->addMonth(), function () {
            return Blog::limit(3)->get();
        });

        $portofolios = Cache::remember('portofolios', now()->addMonth(), function () {
            return Portofolio::limit(3)->get();
        });

        return view('frontend.index', compact('getBanner', 'services', 'data', 'blogs', 'portofolios'));
    }

    public function blog()
    {
        $blogs = Blog::paginate(5);
        $blogs_terbaru = Blog::orderBy('date_post', 'desc')->take(3)->get();

        return view('frontend.blog', compact('blogs', 'blogs_terbaru'));
    }

    public function blogDetail($id)
    {
        $blog = Blog::whereSeoTitle($id)->first();
        $blogs_terbaru = Blog::orderBy('date_post', 'desc')->take(3)->get();

        return view('frontend.blog_detail', compact('blog', 'blogs_terbaru'));
    }

    public function testMail()
    {
        $partner = Partner::find('3pt3cEkOpf');

        $password = 'adfafadf';

        return view('mail.partner_send_regist', compact('partner', 'password'));
    }

    public function register()
    {
        return view('frontend.register');
    }

    public function registerPost(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'partner_id' => 'nullable|string|max:255',
                'gender' => 'required|in:Laki - Laki,Perempuan',
                'phone' => 'required|between:10,15|' . Rule::unique('partner')->ignore($request->partner_id, 'partner_id'),
                'email' => 'required|email|max:255|' . Rule::unique('partner')->ignore($request->partner_id, 'partner_id'),
                'photo' => 'nullable|image|max:2048',
                'villages' => 'required|string|max:255',
                'trans_number' => 'required|string|max:255',
                'trans_info' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'kk' => 'required|image|max:2048',
                'ktp' => 'required|image|max:2048',
                'sim' => 'required|image|max:2048',
                'kendaraan' => 'required|image|max:2048',
                'gudang' => 'required|image|max:2048',
                'checkbox' => 'required',
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $validated->errors(),
                ], 422);
            }

            $photo_name = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo_name = 'partner_' . time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('upload'), $photo_name);
            }

            if ($request->hasFile('kk')) {
                $kk = $request->file('kk');
                $kk_name = 'partner_kk_' . time() . '_' . $kk->getClientOriginalName();
                $kk->move(public_path('upload'), $kk_name);
            }

            if ($request->hasFile('ktp')) {
                $ktp = $request->file('ktp');
                $ktp_name = 'partner_ktp_' . time() . '_' . $ktp->getClientOriginalName();
                $ktp->move(public_path('upload'), $ktp_name);
            }

            if ($request->hasFile('sim')) {
                $sim = $request->file('sim');
                $sim_name = 'partner_sim_' . time() . '_' . $sim->getClientOriginalName();
                $sim->move(public_path('upload'), $sim_name);
            }

            if ($request->hasFile('kendaraan')) {
                $kendaraan = $request->file('kendaraan');
                $kendaraan_name = 'partner_kendaraan_' . time() . '_' . $kendaraan->getClientOriginalName();
                $kendaraan->move(public_path('upload'), $kendaraan_name);
            }

            if ($request->hasFile('gudang')) {
                $gudang = $request->file('gudang');
                $gudang_name = 'partner_gudang_' . time() . '_' . $gudang->getClientOriginalName();
                $gudang->move(public_path('upload'), $gudang_name);
            }

            $password = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);

            $villages = explode(',', $request->villages);

            $request->merge([
                'password' => bcrypt($password),
                'point' => 0,
                'kk' => $kk_name ?? '',
                'ktp' => $ktp_name ?? '',
                'sim' => $sim_name ?? '',
                'kendaraan' => $kendaraan_name ?? '',
                'gudang' => $gudang_name ?? '',
                'address' => $request->address,
                'provinces' => $villages[0],
                'regencies' => $villages[1],
                'districts' => $villages[2],
                'villages' => $villages[3],
            ]);

            //remove g-recaptcha-response
            $request->offsetUnset('g-recaptcha-response');
            //remove checkbox
            $request->offsetUnset('checkbox');
            $request->merge(['photo' => $photo_name ?? 'user.png']);
            $partner = Partner::create($request->all());
            Mail::to($partner->email)->send(new PartnerSendRegistration($partner, $password));

            return response()->json(['message' => 'Partner created successfully']);
        });
    }

    public function profile()
    {
        $about = AboutSite::first();

        return view('frontend.profile', compact('about'));
    }

    public function getVillage()
    {
        $villages = DB::table('region_subdistricts')
            ->join('region_cities', 'region_cities.id', '=', 'region_subdistricts.city_id')
            ->join('region_districts', 'region_districts.id', '=', 'region_subdistricts.district_id')
            ->join('region_provinces', 'region_provinces.id', '=', 'region_subdistricts.province_id')
            ->select(
                'region_subdistricts.name as village_name',
                'region_cities.name as city_name',
                'region_districts.name as district_name',
                'region_provinces.name as province_name',
                'region_subdistricts.id as village_id'
            )
            ->where('region_subdistricts.name', "like", "%" . request('name') . "%")
            ->orWhere('region_cities.name', "like", "%" . request('name') . "%")
            ->orWhere('region_districts.name', "like", "%" . request('name') . "%")
            ->get();


        return response()->json($villages);
    }
}
