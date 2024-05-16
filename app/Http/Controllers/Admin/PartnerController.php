<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PartnerSendRegistration;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(Partner::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                    AllowedFilter::exact('status'),
                ]);

            if (Auth::guard('admin')->user()->roles == 'cabang') {
                $data->where('account_id', Auth::guard('admin')->user()->account_id);
            }

            $result = $data->orderBy('date_create', 'desc')->paginate($request->per_page ?? 15);

            $total = Partner::groupBy('status')->selectRaw('count(*) as total, status')
                ->where(function ($query) {
                    if (Auth::guard('admin')->user()->roles == 'cabang') {
                        $query->where('account_id', Auth::guard('admin')->user()->account_id);
                    }
                })
                ->get();

            return response()->json([
                'data' => $result,
                'filter' => $total,
            ]);
        }

        return view('admin.partners.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'partner_id' => 'nullable|string|max:255',
            'gender' => 'required|in:Laki - Laki,Perempuan',
            'phone' => 'required|between:10,15|'.Rule::unique('partner')->ignore($request->partner_id, 'partner_id'),
            'email' => 'required|email|max:255|'.Rule::unique('partner')->ignore($request->partner_id, 'partner_id'),
            //            'password' => function ($attribute, $value, $fail) use ($request) {
            //
            //                if (empty($value) && empty($request->partner_id)) {
            //                    $fail('The '.$attribute.' field is required.');
            //                }
            //                if (strlen($value) < 8 && empty($request->partner_id)) {
            //                    $fail('The '.$attribute.' must be at least 8 characters.');
            //                }
            //            },
            'photo' => 'nullable|image|max:2048',
            'address' => 'required|string|max:255',
            'provinces' => 'required|string|max:255',
            'regencies' => 'required|string|max:255',
            'districts' => 'required|string|max:255',
            'villages' => 'required|string|max:255',
            'trans_number' => 'nullable|string|max:255',
            'trans_info' => 'nullable|string|max:255',
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
            $photo_name = 'partner_'.time().'_'.$photo->getClientOriginalName();
            $photo->move(public_path('upload'), $photo_name);
        }

        return DB::transaction(function () use ($request, $photo_name) {
            if ($request->partner_id) {
                $partner = Partner::wherePartnerId($request->partner_id)->first();
                //if password is empty, then don't update password
                if (empty($request->password)) {
                    $request->offsetUnset('password');
                } else {
                    $request->merge(['password' => bcrypt($request->password)]);
                }
                //$photo_name
                $request->merge(['photo' => $photo_name ?? $partner->photo]);
                $partner->update($request->all());
            } else {
                $password = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
                $request->merge(['password' => bcrypt($password), 'point' => 0]);

                if (Auth::guard('admin')->user()->roles == 'cabang') {
                    $request->merge(['account_id' => Auth::guard('admin')->user()->account_id]);
                }
                $request->merge(['photo' => $photo_name ?? 'user.png']);
                $partner = Partner::create($request->all());
                Mail::to($partner->email)->send(new PartnerSendRegistration($partner, $password));
            }
        });

        return response()->json(['message' => 'Partner created successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.form');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $partner = Partner::wherePartnerId($id)->first();
        //        dd($partner);

        return view('admin.partners.form', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partner = Partner::wherePartnerId($id)->first();

        return view('admin.partners.form', compact('partner'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partner = Partner::wherePartnerId($id)->first();
        $partner->delete();

        return response()->json(['message' => 'Partner deleted successfully']);
    }
}
