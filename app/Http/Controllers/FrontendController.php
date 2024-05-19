<?php

namespace App\Http\Controllers;

use App\Mail\PartnerSendRegistration;
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
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'partner_id' => 'nullable|string|max:255',
            'gender' => 'required|in:Laki - Laki,Perempuan',
            'phone' => 'required|between:10,15|' . Rule::unique('partner')->ignore($request->partner_id, 'partner_id'),
            'email' => 'required|email|max:255|' . Rule::unique('partner')->ignore($request->partner_id, 'partner_id'),
            'photo' => 'nullable|image|max:2048',
            'address' => 'required|string|max:255',
            'provinces' => 'required|string|max:255',
            'regencies' => 'required|string|max:255',
            'districts' => 'required|string|max:255',
            'villages' => 'required|string|max:255',
            'trans_number' => 'required|string|max:255',
            'trans_info' => 'required|string|max:255',
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


        $password = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
        $request->merge(['password' => bcrypt($password), 'point' => 0]);

        $request->merge(['photo' => $photo_name ?? 'user.png']);
        $partner = Partner::create($request->all());
        Mail::to($partner->email)->send(new PartnerSendRegistration($partner, $password));

        return response()->json(['message' => 'Partner created successfully']);
    }
}
