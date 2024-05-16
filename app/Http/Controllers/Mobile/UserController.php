<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Mail\UserChangeEmail;
use App\Mail\UserResetPassword;
use App\Mail\UserSendRegister;
use App\Models\DetailOrder;
use App\Models\OrderData;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
                'regex:/^(62|08|\+62)/'
            ],
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validate->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = "Inputan tidak boleh kosong!";
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

            Mail::to($request->email)->send(new UserSendRegister($user, "user"));

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = "Registrasi berhasil!";

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
            $response['message'] = "Inputan tidak boleh kosong!";
            $response['errors'] = $validate->errors();
            return $this->response($response);
        }

        return DB::transaction(function () use ($request) {
            $user = User::where('email', $request->email)->first();

            if (!password_verify($request->password, $user->password)) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = "Password salah!";
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
                    'quantity' => $quantity
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
                'contribution' => ($get_contribution_num != 0) ? $detail_contribution : null
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
            "gender" => "required",
            "birth" => "required",
            "photo_name" => "required|file|mimes:jpg,jpeg,png|max:2048",
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
            $response['message'] = "Inputan tidak boleh kosong!";
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
            "name" => "required",
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
            $response['message'] = "Inputan tidak boleh kosong!";
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
            $response['message'] = "Inputan tidak boleh kosong!";
            $response['errors'] = $validate->errors();
            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $user = User::where('user_id', $data_id)
                ->first();

            if ($user->email != $request->email) {
                Mail::to($user->email)->send(new UserChangeEmail($user));
                Mail::to($request->email)->send(new UserSendRegister($user, "user"));
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
                'regex:/^(62|08|\+62)/' // Regular expression for phone numbers starting with 62, 081, or +62
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
            $response['message'] = "Inputan tidak boleh kosong!";
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
            $response['message'] = "Inputan tidak boleh kosong!";
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
            "address" => "required",
            "provinces" => "required",
            "regencies" => "required",
            "districts" => "required",
            "villages" => "required",
            "latitude" => "required",
            "longitude" => "required",
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
            $response['message'] = "Inputan tidak boleh kosong!";
            $response['errors'] = $validate->errors();
            return $this->response($response);
        }

        $check = DB::table('user_auth')->where('user_id', $data_id)->where('token', $auht_key)->first();

        if ($check) {
            $user = User::where('user_id', $data_id)
                ->first();
            $data_user = array(
                'address' => $request->address,
                'provinces' => ucwords(strtolower($request->provinces)),
                'regencies' => ucwords(strtolower($request->regencies)),
                'districts' => ucwords(strtolower($request->districts)),
                'villages' => ucwords(strtolower($request->villages)),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date_update' => $request->date_update
            );

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
                'photo' => 'required|image|mimes:jpg,png,jpeg|max:8192',
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
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = config('services.firebase.server_key');

        $arrayToSend = [
            'registration_ids' => $tokens,
            'notification' => $notification,
            'priority' => 'high'
        ];
        $json = json_encode($arrayToSend);

        $headers = [
            'Content-Type: application/json',
            'Authorization: key=' . $serverKey
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
