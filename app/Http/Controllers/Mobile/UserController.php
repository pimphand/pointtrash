<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Mail\UserChangeEmail;
use App\Mail\UserResetPassword;
use App\Mail\UserSendRegister;
use App\Models\DetailOrder;
use App\Models\OrderData;
use App\Models\Partner;
use App\Models\Rating;
use App\Models\User;
use App\Models\WidrawUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $client_service = 'frontend-client';

    public function regis_user_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => [
                'required',
                'regex:/^(62|08|\+62)/',
            ],
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        return DB::transaction(function () use ($request) {
            $user = new User();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 0;
            $user->save();

            Mail::to($request->email)->send(new UserSendRegister($user, 'user'));

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Registrasi berhasil!';

            return $this->response($response);
        });
    }

    public function auth_user_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:user',
            'password' => 'required',
            'device_token' => 'required',
        ]);

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        return DB::transaction(function () use ($request) {
            $user = User::where('email', $request->email)->first();

            if (!password_verify($request->password, $user->password)) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Password salah!';

                return $this->response($response);
            }

            $token = bcrypt($user->email . time());
            $data['user_id'] = $user->user_id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['token'] = $token;
            $data['photo'] = $user->photo;
            $data['device_id'] = $request->device_token;

            DB::table('user_auth')->insert([
                'user_auth_id' => Str::random(10),
                'user_id' => $user->user_id,
                'token' => $token,
            ]);

            $user->last_sign_in = date('Y-m-d H:i:s');
            $user->device_token = $request->device_token;
            $user->save();

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Log In berhasil';
            $response['result'] = $data;

            return $this->response($response);
        });
    }

    public function req_pass_user_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make(request()->all(), [
            'email' => 'required|email|exists:user',
        ]);

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Email tidak ditemukan!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $user = User::where('email', $request->email)->first();
        $user->request_status = 1;
        $user->save();

        Mail::to($request->email)->send(new UserResetPassword($user));

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Pesan dikirim ke email anda';

        return $this->response($response);
    }

    public function get_user_profile_api()
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $get_data = DB::table('user')
                ->where('user.user_id', $data_id)
                ->first();

            $get_contribution = DB::table('detail_order')
                ->select('trash_category.category', 'trash_category.background', DB::raw('SUM(detail_order.quantity) as total_quantity'))
                ->join('order_data', 'order_data.order_id', '=', 'detail_order.order_id')
                ->join('sub_trash_category', 'sub_trash_category.sub_category_id', '=', 'detail_order.sub_category_id')
                ->join('trash_category', 'trash_category.category_id', '=', 'sub_trash_category.category_id')
                ->where('order_data.user_id', $data_id)
                ->groupBy('sub_trash_category.category_id')
                ->get();

            $detail_contribution = [];
            foreach ($get_contribution as $key) {
                $quantity = number_format($key->total_quantity, 2);
                $detail = [
                    'category' => $key->category,
                    'background' => $key->background,
                    'quantity' => $quantity,
                ];
                array_push($detail_contribution, $detail);
            }

            $get_contribution_num = count($get_contribution);

            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Data berhasil ditemukan',
                'data' => [
                    'name' => $get_data->name,
                    'gender' => $get_data->gender,
                    'birth' => $get_data->birth,
                    'phone' => $get_data->phone,
                    'email' => $get_data->email,
                    'photo_name' => $get_data->photo,
                    'address' => $get_data->address,
                    'provinces' => $get_data->provinces,
                    'regencies' => $get_data->regencies,
                    'districts' => $get_data->districts,
                    'villages' => $get_data->villages,
                    'latitude' => $get_data->latitude,
                    'longitude' => $get_data->longitude,
                    'point' => $get_data->point,
                ],
                'contribution' => ($get_contribution_num != 0) ? $detail_contribution : null,
            ];

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function up_user_profile_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'gender' => 'required',
            'birth' => 'required',
            'photo_name' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $partner = User::where('user_id', $data_id)
                ->first();

            if ($request->hasFile('photo_name')) {
                $thumbnail = $request->file('photo_name');
                $photo_name = 'photo_user' . time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('upload'), $photo_name);
            } else {
                $photo_name = $partner->photo;
            }

            $data_partner = [
                'gender' => $request->gender,
                'photo' => $photo_name,
                'birth' => $request->birth,
                'date_update' => now(),
            ];

            $partner->update($data_partner);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function up_user_name_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $partner = User::where('user_id', $data_id)
                ->first();

            $data_partner = [
                'name' => $request->name,
                'date_update' => now(),
            ];

            $partner->update($data_partner);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function up_user_email_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|unique:user,email,' . $data_id . ',user_id',
        ]);

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $user = User::where('user_id', $data_id)
                ->first();

            if ($user->email != $request->email) {
                Mail::to($user->email)->send(new UserChangeEmail($user));
                Mail::to($request->email)->send(new UserSendRegister($user, 'user'));
            }
            $data_user = [
                'email' => $request->email,
                'date_update' => now(),
                'status' => $user->email == $request->email ? 1 : 0,
            ];

            $user->update($data_user);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function up_user_phone_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'phone' => [
                'required',
                'regex:/^(62|08|\+62)/', // Regular expression for phone numbers starting with 62, 081, or +62
            ],
        ]);

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $partner = User::where('user_id', $data_id)
                ->first();

            $phone = $request->phone;

            // Menghapus karakter non-digit dari nomor telepon
            $phoneDigits = preg_replace('/\D/', '', $phone);

            // Mengecek panjang nomor telepon
            if (strlen($phoneDigits) > 0) {
                // Menghilangkan angka awalan jika ada
                if (substr($phoneDigits, 0, 1) == '0') {
                    $phoneDigits = substr($phoneDigits, 1);
                }

                // Mengatur ulang format nomor telepon menjadi +62
                if (substr($phoneDigits, 0, 1) == '6' || substr($phoneDigits, 0, 1) == '+') {
                    $phoneDigits = '62' . substr($phoneDigits, 1);
                }

                // Mengonversi nomor telepon ke format internasional
                $fix_phone = '+62' . $phoneDigits;
            } else {
                // Handle jika nomor telepon kosong
                $fix_phone = null;
            }

            $data_partner = [
                'phone' => $fix_phone,
                'date_update' => now(),
            ];

            $partner->update($data_partner);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function up_user_pass_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'password' => [
                'required',
            ],
        ]);

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $user = User::where('user_id', $data_id)
                ->first();
            $data_partner = [
                'password' => $request->password,
                'date_update' => now(),
            ];

            $user->update($data_partner);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Kata sandi berhasil diupdate';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function up_user_address_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'address' => 'required',
            'provinces' => 'required',
            'regencies' => 'required',
            'districts' => 'required',
            'villages' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Inputan tidak boleh kosong!';
            $response['errors'] = $validate->errors();

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $user = User::where('user_id', $data_id)
                ->first();
            $data_user = [
                'address' => $request->address,
                'provinces' => ucwords(strtolower($request->provinces)),
                'regencies' => ucwords(strtolower($request->regencies)),
                'districts' => ucwords(strtolower($request->districts)),
                'villages' => ucwords(strtolower($request->villages)),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date_update' => $request->date_update,
            ];

            $user->update($data_user);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Kata sandi berhasil diupdate';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function get_guide_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $result = DB::table('guide')
                ->get();

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data berhasil ditemukan';
            $response['data'] = $result;

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function get_terms_condition_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $result = DB::table('terms_of_service')
            ->get();

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data'] = $result;

        return $this->response($response);
    }

    public function get_privacy_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $result = DB::table('privacy_policy')
            ->get();

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data'] = $result;

        return $this->response($response);
    }

    public function get_question_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $result = DB::table('privacy_policy')
            ->get();

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data'] = $result;

        return $this->response($response);
    }

    public function get_version_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $result = DB::table('version')
            ->get();

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data'] = $result;

        return $this->response($response);
    }

    public function get_advertisment_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $result = DB::table('advertisment')
            ->get();

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data'] = $result;

        return $this->response($response);
    }

    public function get_trash_category_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');

        if (!$data_id && !$auht_key) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $trash_category = DB::table('trash_category')->get();
            $sub_trash_category = DB::table('sub_trash_category')->get();

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data berhasil ditemukan';
            $response['trash_category'] = $trash_category;
            $response['sub_trash_category'] = $sub_trash_category;

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Otentikasi gagal!';

        return $this->response($response);
    }

    public function pickup_order_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        FacadesLog::alert('Request: ' . json_encode($request->all()));

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $validate = Validator::make($request->all(), [
                'sub_category' => 'required',
                'address' => 'required',
                'provinces' => 'required',
                'regencies' => 'required',
                'districts' => 'required',
                'villages' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'weight' => 'required',
                'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:8192',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => 502,
                    'error' => true,
                    'message' => 'Inputan tidak boleh kosong!',
                    'errors' => $validate->errors(),
                ]);
            }

            if ($request->hasFile('photo')) {
                $thumbnail = $request->file('photo');
                $photo_name = 'photo_order' . time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('upload'), $photo_name);
            }

            $orderData = new OrderData();
            $orderData->order_id = Str::random(10);
            $orderData->photo = $photo_name ?? null;
            $orderData->address = $request->input('address');
            $orderData->provinces = $request->input('provinces');
            $orderData->regencies = $request->input('regencies');
            $orderData->districts = $request->input('districts');
            $orderData->villages = $request->input('villages');
            $orderData->latitude = $request->input('latitude');
            $orderData->longitude = $request->input('longitude');
            $orderData->information = $request->input('information', '');
            $orderData->weight = $request->input('weight');
            $orderData->date_create = now()->setTimezone('Asia/Jakarta');
            $orderData->status = 0;
            $orderData->user_id = $data_id;
            $orderData->type = 'Pickup';
            $orderData->status_rating = 0;
            $orderData->save();

            $subCategories = explode(' ', $request->input('sub_category'));
            $records = [];
            foreach ($subCategories as $subCategory) {
                if (!empty($subCategory)) {
                    $records[] = [
                        'detail_order_id' => Str::random(10),
                        'order_id' => $orderData->order_id,
                        'sub_category_id' => $subCategory,
                    ];
                }
            }
            DetailOrder::insert($records);

            // Send notification to partners
            $partners = Partner::where('provinces', $orderData->provinces)
                ->where('regencies', $orderData->regencies)
                ->where('districts', $orderData->districts)
                ->where('villages', $orderData->villages)
                ->get();

            foreach ($partners as $partner) {
                $token = [$partner->device_token];
                $notification = [
                    'title' => 'Pickup Order Masuk',
                    'body' => "Hai Mitra, ada order masuk nih! Cek sekarang juga! Total Berat: {$orderData->weight}kg",
                    'sound' => 'default',
                    'badge' => '1',
                ];
                self::sendNotification($token, $notification);
            }

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Pickup Order berhasil',
            ]);
        } else {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }
    }

    public function sendNotification($tokens, $notification)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = config('services.firebase.server_key');

        $arrayToSend = [
            'registration_ids' => $tokens,
            'notification' => $notification,
            'priority' => 'high',
        ];
        $json = json_encode($arrayToSend);

        $headers = [
            'Content-Type: application/json',
            'Authorization: key=' . $serverKey,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function drop_off_order_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'sub_category' => 'required',
            'address' => 'required',
            'provinces' => 'required',
            'regencies' => 'required',
            'districts' => 'required',
            'villages' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'information' => 'nullable',
            'weight' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'errors' => $validate->errors(),
                'message' => 'Field tidak boleh kosong!',
            ]);
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $sub_category = $request->input('sub_category');
        $address = $request->input('address');
        $provinces = $request->input('provinces');
        $regencies = $request->input('regencies');
        $districts = $request->input('districts');
        $villages = $request->input('villages');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $information = $request->input('information');
        $weight = $request->input('weight');
        $order_id = Str::random(10);
        $date_create = now()->setTimezone('Asia/Jakarta');

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $thumbnail_name = 'photo_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);
        } else {
            $thumbnail_name = null;
        }

        $data = [
            'order_id' => $order_id,
            'photo' => $thumbnail_name,
            'address' => $address,
            'provinces' => $provinces,
            'regencies' => $regencies,
            'districts' => $districts,
            'villages' => $villages,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'information' => $information,
            'weight' => $weight,
            'date_create' => $date_create,
            'status' => 0,
            'user_id' => $data_id,
            'type' => 'Drop Off',
            'status_rating' => 0,
        ];

        DB::table('order_data')->insert($data);

        $sub_cat_arr = preg_split("/[\s,]+/", $sub_category, -1, PREG_SPLIT_NO_EMPTY);
        $records = [];

        foreach ($sub_cat_arr as $sub_cat_id) {
            $detail_order_id = Str::random(10);
            $records[] = [
                'detail_order_id' => $detail_order_id,
                'order_id' => $order_id,
                'sub_category_id' => $sub_cat_id,
            ];
        }

        DB::table('detail_order')->insert($records);

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Drop Off Order berhasil',
        ]);
    }

    public function company_order_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'sub_category' => 'required',
            'address' => 'required',
            'provinces' => 'required',
            'regencies' => 'required',
            'districts' => 'required',
            'villages' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'information' => 'nullable',
            'weight' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'errors' => $validate->errors(),
                'message' => 'Field tidak boleh kosong!',
            ]);
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $sub_category = $request->input('sub_category');
        $address = $request->input('address');
        $provinces = $request->input('provinces');
        $regencies = $request->input('regencies');
        $districts = $request->input('districts');
        $villages = $request->input('villages');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $information = $request->input('information');
        $weight = $request->input('weight');
        $order_id = Str::random(10);
        $date_create = now()->setTimezone('Asia/Jakarta');

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $thumbnail_name = 'photo_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);
        } else {
            $thumbnail_name = null;
        }

        $data = [
            'order_id' => $order_id,
            'photo' => $thumbnail_name,
            'address' => $address,
            'provinces' => $provinces,
            'regencies' => $regencies,
            'districts' => $districts,
            'villages' => $villages,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'information' => $information,
            'weight' => $weight,
            'date_create' => $date_create,
            'status' => 0,
            'user_id' => $data_id,
            'type' => 'Company',
            'status_rating' => 0,
        ];

        DB::table('order_data')->insert($data);

        $sub_cat_arr = preg_split("/[\s,]+/", $sub_category, -1, PREG_SPLIT_NO_EMPTY);
        $records = [];

        foreach ($sub_cat_arr as $sub_cat_id) {
            $detail_order_id = Str::random(10);
            $records[] = [
                'detail_order_id' => $detail_order_id,
                'order_id' => $order_id,
                'sub_category_id' => $sub_cat_id,
            ];
        }

        DB::table('detail_order')->insert($records);

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Company Order berhasil',
        ]);
    }

    public function event_order_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'sub_category' => 'required',
            'address' => 'required',
            'provinces' => 'required',
            'regencies' => 'required',
            'districts' => 'required',
            'villages' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'information' => 'nullable',
            'weight' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'errors' => $validate->errors(),
                'message' => 'Field tidak boleh kosong!',
            ]);
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $sub_category = $request->input('sub_category');
        $address = $request->input('address');
        $provinces = $request->input('provinces');
        $regencies = $request->input('regencies');
        $districts = $request->input('districts');
        $villages = $request->input('villages');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $information = $request->input('information');
        $weight = $request->input('weight');
        $order_id = Str::random(10);
        $date_create = now()->setTimezone('Asia/Jakarta');

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $thumbnail_name = 'photo_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);
        } else {
            $thumbnail_name = null;
        }

        $data = [
            'order_id' => $order_id,
            'photo' => $thumbnail_name,
            'address' => $address,
            'provinces' => $provinces,
            'regencies' => $regencies,
            'districts' => $districts,
            'villages' => $villages,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'information' => $information,
            'weight' => $weight,
            'date_create' => $date_create,
            'status' => 0,
            'user_id' => $data_id,
            'type' => 'Event',
            'status_rating' => 0,
        ];

        DB::table('order_data')->insert($data);

        $sub_cat_arr = preg_split("/[\s,]+/", $sub_category, -1, PREG_SPLIT_NO_EMPTY);
        $records = [];

        foreach ($sub_cat_arr as $sub_cat_id) {
            $detail_order_id = Str::random(10);
            $records[] = [
                'detail_order_id' => $detail_order_id,
                'order_id' => $order_id,
                'sub_category_id' => $sub_cat_id,
            ];
        }

        DB::table('detail_order')->insert($records);

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Event Order berhasil',
        ]);
    }

    public function cancel_order_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $order_id = request()->header('Order-ID');
        $photo_name = request()->header('Order-Photo');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $order = OrderData::where('user_id', $data_id)->where('order_id', $order_id)->first();
        if (!$order) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Order gagal dibatalkan!';

            return $this->response($response);
        }

        if ($order->status != 1) {
            if ($order->photo) {
                $path = public_path('upload/' . $order->photo);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $order->details()->delete();
            $order->delete();
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Order dibatalkan!';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Order gagal dibatalkan!';

        return $this->response($response);
    }

    public function delete_order_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $order_id = request()->header('Order-ID');
        $photo_name = request()->header('Order-Photo');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $order = OrderData::where('user_id', $data_id)->where('order_id', $order_id)->first();
        if (!$order) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Order gagal dihapus!';

            return $this->response($response);
        }

        if ($order->status != 1) {
            if ($order->photo) {
                $path = public_path('upload/' . $order->photo);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $order->details()->delete();
            $order->delete();
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Order dihapus!';

            return $this->response($response);
        }

        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Order gagal dihapus!';

        return $this->response($response);
    }

    public function get_user_order_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $client_service = $request->header('Client-Service');
        $data_id = $request->header('Data-ID');
        $auth_key = $request->header('Auth-Key');

        $user_key = DB::table('user_auth')
            ->select('user_auth.token')
            ->join('user', 'user.user_id', '=', 'user_auth.user_id')
            ->where('user.user_id', $data_id)
            ->first();

        $key = $user_key->token;

        if ($client_service == $this->client_service || $auth_key == $key) {

            $check_data = DB::table('order_data')
                ->where('order_data.user_id', $data_id)
                ->where('order_data.status', '!=', 1)
                ->count();

            if ($check_data == 0) {
                return response()->json([
                    'status' => 502,
                    'error' => true,
                    'message' => 'Tidak ada order saat ini!',
                ]);
            } else {
                $arrayRes = [];

                $get_data = DB::table('order_data')
                    ->select(
                        'order_data.order_id',
                        'order_data.status',
                        'order_data.date_create',
                        'order_data.weight',
                        'order_data.total_point',
                        'order_data.photo AS order_photo',
                        'order_data.status_rating',
                        'order_data.address AS user_address',
                        'order_data.provinces AS user_provinces',
                        'order_data.regencies AS user_regencies',
                        'order_data.districts AS user_districts',
                        'order_data.villages AS user_villages',
                        'order_data.user_id',
                        'order_data.partner_id',
                        'order_data.type'
                    )
                    ->where('order_data.user_id', $data_id)
                    ->where('order_data.status', '!=', 1)
                    ->orderBy('order_data.date_create', 'DESC')
                    ->get();

                foreach ($get_data as $item) {
                    $month_create = substr($item->date_create, 0, 7);
                    $month_now = now()->setTimezone('Asia/Jakarta')->format('Y-m');

                    if ($month_create == $month_now) {
                        $date_create = substr($item->date_create, 0, 10);
                        $date_now = now()->setTimezone('Asia/Jakarta')->format('Y-m-d');

                        if ($date_create == $date_now) {
                            $result = [
                                'order_type' => $item->type,
                                'order_id' => $item->order_id,
                                'status' => $item->status,
                                'date_create' => $item->date_create,
                                'weight' => $item->weight,
                                'total_point' => $item->total_point,
                                'order_photo' => $item->order_photo,
                                'partner_id' => $item->partner_id,
                                'partner_phone' => null,
                                'partner_name' => null,
                                'partner_photo' => null,
                                'partner_trans_number' => null,
                                'partner_trans_info' => null,
                                'partner_address' => null,
                                'partner_provinces' => null,
                                'partner_regencies' => null,
                                'partner_districts' => null,
                                'partner_villages' => null,
                                'partner_device' => null,
                                'status_rating' => 0,
                                'rating' => null,
                                'user_id' => $item->user_id,
                                'user_address' => $item->user_address,
                                'user_provinces' => $item->user_provinces,
                                'user_regencies' => $item->user_regencies,
                                'user_districts' => $item->user_districts,
                                'user_villages' => $item->user_villages,
                                'user_device' => null,
                                'detail_pickup' => [],
                            ];
                            array_push($arrayRes, $result);
                        }
                    }
                }

                if (count($arrayRes) != 0) {
                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'message' => 'Data berhasil ditemukan',
                        'data_order' => $arrayRes,
                    ]);
                } else {
                    return response()->json([
                        'status' => 502,
                        'error' => true,
                        'message' => 'Tidak ada order saat ini!',
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }
    }

    public function get_user_history_order_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $authKey = $request->header('Auth-Key');

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $authKey)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $check_data = OrderData::with(['details.category', 'user', 'partner']) //select('order_id, status, date_create, weight, total_point, photo AS order_photo, status_rating, address AS user_address, provinces AS user_provinces, regencies AS user_regencies, districts AS user_districts, villages AS user_villages, user_id, partner_id, type')
            ->where('user_id', $data_id)
            ->where('status', '=', 1)
            ->orderBy('date_create', 'DESC')
            ->get();

        if ($check_data->count() < 0) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Tidak ada order saat ini!';

            return $this->response($response);
        }

        foreach ($check_data as $item) {
            $month_create = substr($item->date_create, 0, 7);
            $month_now = date('Y-m');

            if ($month_create == $month_now) {
                if ($item->type == 'Drop Off') {
                    $profit = DB::table('share_profit_drop_off')->first();
                    $for_user = $item->total_point * $profit->for_user / 100;
                    $for_company = $item->total_point * $profit->for_company / 100;

                    $detail_order = [];
                    foreach ($item->details as $key) {
                        $sub_price = $key->sub_price * $profit->for_user / 100;

                        $detail = [
                            'sub_category' => $key->sub_category,
                            'price' => $key->price,
                            'quantity' => $key->quantity,
                            'sub_price' => "$sub_price",
                        ];
                        array_push($detail_order, $detail);
                    }
                    $get_total_weight = $item->details->sum('quantity');
                    $total_weight = number_format($get_total_weight, 2);
                    $result[] = [
                        'order_type' => $item->type,
                        'order_id' => $item->order_id,
                        'status' => $item->status,
                        'date_create' => $item->date_create,
                        'weight' => $total_weight,
                        'total_point' => $item->total_point,
                        'for_user' => "$for_user",
                        'for_company' => "$for_company",
                        'for_partner' => null,
                        'persentase_user' => "$profit->for_user",
                        'persentase_company' => "$profit->for_company",
                        'persentase_partner' => null,
                        'order_photo' => $item->order_photo,
                        'partner_id' => $item->partner_id,
                        'partner_phone' => null,
                        'partner_name' => null,
                        'partner_photo' => null,
                        'partner_trans_number' => null,
                        'partner_trans_info' => null,
                        'partner_address' => null,
                        'partner_provinces' => null,
                        'partner_regencies' => null,
                        'partner_districts' => null,
                        'partner_villages' => null,
                        'partner_device' => null,
                        'status_rating' => 0,
                        'rating' => null,
                        'user_id' => $item->user_id,
                        'user_address' => $item->user->address,
                        'user_provinces' => $item->user->provinces,
                        'user_regencies' => $item->user->regencies,
                        'user_districts' => $item->user->districts,
                        'user_villages' => $item->user->villages,
                        'user_device' => $item->user->device,
                        'detail_pickup' => $detail_order,
                    ];
                } else {
                    if ($item->type == 'Pickup') {
                        $profit = DB::table('share_profit_pickup')->first();
                    } elseif ($item->type == 'Company') {
                        $profit = DB::table('share_profit_company')->first();
                    } elseif ($item->type == 'Event') {
                        $profit = DB::table('share_profit_event')->first();
                    }

                    $for_user = $item->total_point * $profit->for_user / 100;
                    $for_company = $item->total_point * $profit->for_company / 100;
                    $for_partner = $item->total_point * $profit->for_partner / 100;

                    $detail_order = [];
                    foreach ($item->details as $key) {
                        $sub_price = $key->sub_price * $profit->for_user / 100;

                        $detail = [
                            'sub_category' => $key->sub_category,
                            'price' => $key->price,
                            'quantity' => $key->quantity,
                            'sub_price' => "$sub_price",
                        ];
                        array_push($detail_order, $detail);
                    }

                    $get_total_weight = $item->details->sum('quantity');
                    $get_rating = DB::table('rating')
                        ->where('partner_id', $item->partner_id)
                        ->avg('rating');

                    $total_weight = number_format($get_total_weight, 2);

                    $result[] = [
                        'order_type' => $item->type,
                        'order_id' => $item->order_id,
                        'status' => $item->status,
                        'date_create' => $item->date_create,
                        'weight' => $total_weight,
                        'total_point' => $item->total_point,
                        'for_user' => "$for_user",
                        'for_company' => "$for_company",
                        'for_partner' => "$for_partner",
                        'persentase_user' => "$profit->for_user",
                        'persentase_company' => "$profit->for_company",
                        'persentase_partner' => "$profit->for_partner",
                        'order_photo' => $item->order_photo,
                        'partner_id' => $item->partner_id,
                        'partner_phone' => $item->partner->partner_phone,
                        'partner_name' => $item->partner->partner_name,
                        'partner_photo' => $item->partner->partner_photo,
                        'partner_trans_number' => $item->partner->partner_trans_number,
                        'partner_trans_info' => $item->partner->partner_trans_info,
                        'partner_address' => $item->partner->partner_address,
                        'partner_provinces' => $item->partner->partner_provinces,
                        'partner_regencies' => $item->partner->partner_regencies,
                        'partner_districts' => $item->partner->partner_districts,
                        'partner_villages' => $item->partner->partner_villages,
                        'partner_device' => $item->partner->partner_device,
                        'status_rating' => intval($item->status_rating),
                        'rating' => substr($get_rating, 0, 3),
                        'user_id' => $item->user_id,
                        'user_address' => $item->user->address,
                        'user_provinces' => $item->user->provinces,
                        'user_regencies' => $item->user->regencies,
                        'user_districts' => $item->user->districts,
                        'user_villages' => $item->user->villages,
                        'user_device' => $item->user->device,
                        'detail_pickup' => $detail_order,
                    ];
                }
            } else {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Tidak ada order saat ini!';

                return $this->response($response);
            }
        }

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data_order'] = $result;

        return $this->response($response);
    }

    public function input_rating_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'rating' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'errors' => $validate->errors(),
                'message' => 'Field tidak boleh kosong!',
            ]);
        }

        $data_id = request()->header('Data-ID');
        $auht_key = request()->header('Auth-Key');
        $order_id = request()->header('Order-ID');
        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        $order = OrderData::where('user_id', $data_id)->where('order_id', $order_id)->first();
        if (!$order) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Order tidak ditemukan!',
            ]);
        }

        if ($order->status_rating == 1) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Anda sudah memberikan rating!',
            ]);
        }

        $rating = new Rating();

        $rating->rating_id = Str::random(10);
        $rating->rating = $request->input('rating');
        $rating->partner_id = $order->partner_id;
        $rating->save();

        $order->status_rating = 1;
        $order->save();

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Rating berhasil!',
        ]);
    }

    public function user_widraw_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validate = Validator::make($request->all(), [
            'nominal' => 'required',
            'phone' => 'required',
            'type' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'errors' => $validate->errors(),
                'message' => 'Field tidak boleh kosong!',
            ]);
        }

        $data_id = request()->header('Data-ID');
        $auth_key = request()->header('Auth-Key');
        $check = DB::table('user_auth')
            ->where('user_auth.user_id', $data_id)
            ->where('token', $auth_key)
            ->join('user', 'user.user_id', '=', 'user_auth.user_id')
            ->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }

        if ($request->nominal > $check->point) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Point tidak mencukupi!';

            return $this->response($response);
        }

        if ($request->nominal < 49999) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Minimal penarikan Rp.50.000!';

            return $this->response($response);
        }

        $cal = $check->point - $request->nominal;

        $data = [
            'widraw_id' => Str::random(10),
            'nominal' => $request->nominal,
            'phone' => $request->phone,
            'user_id' => $data_id,
            'date_request' => now(),
            'status' => 0,
            'type' => $request->type,
        ];

        WidrawUser::create($data);
        User::find($data_id)->update(['point' => $cal]);

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Permintaan dikirim';

        return $this->response($response);
    }

    public function get_user_widraw_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = request()->header('Data-ID');
        $auth_key = request()->header('Auth-Key');
        $check = DB::table('user_auth')
            ->where('user_id', $data_id)
            ->where('token', $auth_key)
            ->first();

        if (!$check) {
            return response()->json([
                'status' => 502,
                'error' => true,
                'message' => 'Otentikasi gagal!',
            ]);
        }
        $check_data = DB::table('widraw_user')
            ->where('user_id', $data_id)
            ->get();

        if ($check_data->count() == 0) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Tidak ada widraw saat ini!';
            $response['widraw_pending'] = '0';
            $response['widraw_success'] = '0';

            return response()->json($response);
        } else {
            $get_data = WidrawUser::with('user')
                ->where('user_id', $data_id)
                ->whereBetween('date_request', [now()->firstOfMonth(), now()])
                ->orderBy('date_request', 'DESC')
                ->get();

            if ($get_data->count() == 0) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Tidak ada widraw saat ini!';
                $response['widraw_pending'] = '0';
                $response['widraw_success'] = '0';

                return response()->json($response);
            }

            $check_widraw_pending = DB::table('widraw_user')
                ->where('user_id', $data_id)
                ->where('status', 0)
                ->count();

            $check_widraw_success = DB::table('widraw_user')
                ->where('user_id', $data_id)
                ->where('status', 1)
                ->count();

            $result = [];

            foreach ($get_data as $item) {
                $result[] = [
                    'widraw_type' => trim($item->type),
                    'widraw_id' => $item->widraw_id,
                    'status' => $item->status,
                    'nominal' => $item->nominal,
                    'phone' => $item->phone,
                    'date_request' => $item->date_request,
                    'user_id' => $item->user_id,
                    'user_device' => $item->user->device_token,
                ];
            }

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data berhasil ditemukan';

            $response['widraw_pending'] = $check_widraw_pending > 0 ? DB::table('widraw_user')
                ->where('user_id', $data_id)
                ->where('status', 0)
                ->sum('nominal') : '0';

            $response['widraw_success'] = $check_widraw_success > 0 ? DB::table('widraw_user')
                ->where('user_id', $data_id)
                ->where('status', 1)
                ->sum('nominal') : '0';

            $response['data_widraw'] = $result;

            return response()->json($response);
        }
    }
}
