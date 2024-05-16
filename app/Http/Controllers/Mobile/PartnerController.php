<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Mail\EmailChanged;
use App\Mail\PartnerResetPassword;
use App\Mail\PartnerSendVerification;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public $client_service = 'frontend-client';

    public function auth_partner_api_post(Request $request)
    {
        $check = Partner::where('partner.email', $request->email)
            ->first();

        if ($check) {
            if (password_verify($request->password, $check->password)) {
                $token = Hash::make($request->email . $request->password);
                DB::table('partner_auth')->insert([
                    'partner_auth_id' => Str::random(10),
                    'partner_id' => $check->partner_id,
                    'token' => $token,
                ]);
                $device_token = $request->device_token;
                if (!empty($device_token)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $dateNow = date('Y-m-d H:i:s');
                    $check->update(['last_sign_in' => $dateNow, 'device_token' => $device_token]);
                }

                $response['status'] = 200;
                $response['error'] = false;
                $response['message'] = 'Log In berhasil';
                $response['result'] = [
                    'partner_id' => $check->partner_id,
                    'name' => $check->name,
                    'email' => $check->email,
                    'token' => $token,
                    'photo' => $check->photo,
                    'device_id' => $check->device_token,
                ];

                return $this->response($response);
            } else {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Password anda salah!';

                return $this->response($response);
            }
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $this->response($response);
        }
    }

    public function response($key)
    {
        return response()->json($key);
    }

    public function req_pass_partner_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $check = Partner::where('partner.email', $request->email)
            ->first();

        if ($check) {
            Mail::to($request->email)->send(new PartnerResetPassword($check));
            $check->update(['request_status' => true]);
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Pesan dikirim ke email anda';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Email tidak terdaftar!';

            return $this->response($response);
        }
    }

    public function get_branch()
    {

        $branch = DB::table('account')
            ->select('account_id', 'name')
            ->where('roles', "cabang")
            ->get();

        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Data berhasil ditemukan';
        $response['data'] = $branch;

        return $this->response($response);
    }

    public function partner_change_branch_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');

        $validated = Validator::make($request->all(), [
            'branch_id' => 'required|exists:account,account_id',
        ]);

        if ($validated->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Field tidak boleh kosong!';
            $response['errors'] = $validated->errors();

            return $this->response($response);
        }

        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();
        if ($check) {
            $partner = Partner::where('partner_id', $data_id)
                ->first();
            $partner->account_id = $request->branch_id;
            $partner->save();
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Cabang berhasil diubah';
            $response['data'] = $partner;

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function get_partner_profile_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $request->header('Data-ID'))
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $partner = Partner::where('partner_id', $data_id)
                ->first();
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data berhasil ditemukan';

            $get_contribution = DB::table('detail_order')
                ->select('trash_category.category', 'trash_category.background')
                ->selectRaw('SUM(detail_order.quantity) as quantity')
                ->join('order_data', 'order_data.order_id', '=', 'detail_order.order_id')
                ->join('sub_trash_category', 'sub_trash_category.sub_category_id', '=', 'detail_order.sub_category_id')
                ->join('trash_category', 'trash_category.category_id', '=', 'sub_trash_category.category_id')
                ->where('order_data.partner_id', $data_id)
                ->groupBy('sub_trash_category.category_id')
                ->get();

            $detail_contribution = [];
            foreach ($get_contribution as $key) {
                $quantity = number_format($key->quantity, 2);
                $detail = [
                    'category' => $key->category,
                    'background' => $key->background,
                    'quantity' => $quantity,
                ];
                array_push($detail_contribution, $detail);
            }

            $get_contribution_num = DB::table('detail_order')
                ->select('trash_category.category', 'trash_category.background')
                ->selectRaw('SUM(detail_order.quantity) as quantity')
                ->join('order_data', 'order_data.order_id', '=', 'detail_order.order_id')
                ->join('sub_trash_category', 'sub_trash_category.sub_category_id', '=', 'detail_order.sub_category_id')
                ->join('trash_category', 'trash_category.category_id', '=', 'sub_trash_category.category_id')
                ->where('order_data.partner_id', $data_id)
                ->groupBy('sub_trash_category.category_id')
                ->get()
                ->count();

            $get_rating = DB::table('rating')
                ->where('partner_id', $data_id)
                ->avg('rating');

            $contribution = DB::table('detail_order')
                ->join('order_data', 'order_data.order_id', '=', 'detail_order.order_id')
                ->where('order_data.partner_id', $data_id)
                ->sum('detail_order.quantity');

            $contri = number_format($contribution, 2);

            $data = [
                'name' => $partner->name,
                'gender' => $partner->gender,
                'phone' => $partner->phone,
                'email' => $partner->email,
                'photo_name' => $partner->photo_name,
                'address' => $partner->address,
                'provinces' => $partner->provinces,
                'regencies' => $partner->regencies,
                'districts' => $partner->districts,
                'villages' => $partner->villages,
                'trans_number' => $partner->trans_number,
                'trans_info' => $partner->trans_info,
                'point' => $partner->point,
                'rating' => number_format($get_rating, 2),
                'total_weight' => $contri,
            ];
            $response['data'] = $data;
            if ($get_contribution_num != 0) {
                $response['contribution'] = $detail_contribution;
            } else {
                $response['contribution'] = null;
            }

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function up_partner_profile_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $validated = Validator::make($request->all(), [
                'gender' => 'required',
                'photo_name' => 'required',
                'trans_number' => 'required',
                'trans_info' => 'required',
            ]);

            if ($validated->fails()) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Field tidak boleh kosong!';
                $response['errors'] = $validated->errors();

                return $this->response($response);
            }

            $partner = Partner::where('partner_id', $data_id)
                ->first();

            if ($request->hasFile('photo_name')) {
                $thumbnail = $request->file('photo_name');
                $photo_name = 'photo_partner' . time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('upload'), $photo_name);
            } else {
                $photo_name = $partner->photo;
            }

            $data_partner = [
                'gender' => $request->gender,
                'photo' => $photo_name,
                'trans_number' => $request->trans_number,
                'trans_info' => $request->trans_info,
                'date_update' => now(),
            ];

            $partner->update($data_partner);
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function up_partner_name_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $validated = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validated->fails()) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Field tidak boleh kosong!';
                $response['errors'] = $validated->errors();

                return $this->response($response);
            }

            $partner = Partner::where('partner_id', $data_id)
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
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function up_partner_phone_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();
        $phone = $request->phone;
        if ($check) {
            $validated = Validator::make($request->all(), [
                'phone' => [
                    'required',
                    'regex:/^(62|08|\+62)/' // Regular expression for phone numbers starting with 62, 081, or +62
                ],
            ]);

            if ($validated->fails()) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Field tidak boleh kosong!';
                $response['errors'] = $validated->errors();

                return $this->response($response);
            }

            $num = substr($phone, 0, 1);

            if ($num == '0') {
                $fix_phone = '+62' . substr($phone, 1);
            } elseif ($num == '6') {
                $fix_phone = '+62' . substr($phone, 2);
            } elseif ($num == '+') {
                $fix_phone = '+62' . substr($phone, 3);
            }

            $partner = Partner::where('partner_id', $data_id)
                ->first();

            $data_partner = [
                'phone' => $fix_phone,
                'date_update' => now(),
            ];

            $partner->update($data_partner);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function up_partner_email_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $validated = Validator::make($request->all(), [
                'email' => 'required|email|unique:partner,email,' . $data_id . ',partner_id',
            ]);

            if ($validated->fails()) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Field tidak boleh kosong!';
                $response['errors'] = $validated->errors();

                return $this->response($response);
            }

            $checkEmail = Partner::where('email', $request->email)
                ->where('partner_id', '!=', $data_id)
                ->exists();

            if ($checkEmail) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Email sudah terdaftar!';

                return $this->response($response);
            }

            $partner = Partner::where('partner_id', $data_id)
                ->first();
            $old_email = $partner->email;
            $data_partner = [
                'email' => $request->email,
                'date_update' => now(),
            ];

            if ($partner->email == $request->email) {
                $partner->update($data_partner);
                $partner->save();
            } else {
                $partners = Partner::where('partner_id', $data_id)
                    ->first();
                Mail::to($old_email)->send(new EmailChanged($partners));

                $data_partner = [
                    'email' => $request->email,
                    'date_update' => now(),
                    'status' => 3,
                ];
                Mail::to($request->email)->send(new PartnerSendVerification($partners));
                $partners->update($data_partner);
                $partners->save();
            }

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Akun berhasil diupdate';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function up_partner_pass_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $validated = Validator::make($request->all(), [
                'password' => 'required',
            ]);

            if ($validated->fails()) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Field tidak boleh kosong!';
                $response['errors'] = $validated->errors();

                return $this->response($response);
            }

            $partner = Partner::where('partner_id', $data_id)
                ->first();

            $data_partner = [
                'password' => Hash::make($request->new_password),
                'date_update' => now(),
            ];

            $partner->update($data_partner);
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Password berhasil diupdate';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function up_partner_address_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $validated = Validator::make($request->all(), [
                'address' => 'required',
                'provinces' => 'required',
                'regencies' => 'required',
                'districts' => 'required',
                'villages' => 'required',
            ]);

            if ($validated->fails()) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Field tidak boleh kosong!';
                $response['errors'] = $validated->errors();

                return $this->response($response);
            }

            $partner = Partner::where('partner_id', $data_id)
                ->first();

            $data_partner = [
                'address' => $request->address,
                'provinces' => ucwords(strtolower($request->provinces)),
                'regencies' => ucwords(strtolower($request->regencies)),
                'districts' => ucwords(strtolower($request->districts)),
                'villages' => ucwords(strtolower($request->villages)),
                'date_update' => now(),
            ];

            $partner->update($data_partner);
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Alamat berhasil diupdate';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function get_version_partner_api(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $data = DB::table('version_partner')
                ->get();

            foreach ($data as $item) {
                $result[] = [
                    'version_id' => $item->version_id,
                    'version' => $item->version,
                    'content' => $item->description,
                    'link' => $item->link,
                ];
            }

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data berhasil ditemukan';
            $response['data'] = $result;

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function take_pickup_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $order_id = $request->header('Order-ID');
        if ($data_id == null || $order_id == null) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $order = DB::table('order_data')
                ->where('order_id', $order_id)
                ->first();
            $partner_name = DB::table('partner')
                ->where('partner_id', $data_id)
                ->first()
                ->name;
            if ($order->status != 0) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah diambil!';

                return $this->response($response);
            }
            $date_create = substr($order->date_create, 0, 10);
            $now = date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $date_now = substr($now, 0, 10);

            if ($date_now != $date_create) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah kadaluwarsa!';

                return $this->response($response);
            }

            $order->update(['status' => 2, 'partner_id' => $data_id]);

            $user = DB::table('user')
                ->select('user.name', 'user.device_token')
                ->join('order_data', 'order_data.user_id', '=', 'user.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $token = [$user->device_token];
            $url = 'https://fcm.googleapis.com/fcm/send';
            $serverKey = 'AAAA71K9pOA:APA91bGN0YZvTj5VLu-Auqfpdl1qc7gvKYX1e5TlKYzpJkAHi5oH83gaKAquDVrq4kqx32feoxIXKpzTkFDekCUEEQhA9Cgz44ZT-xQLnsVj_0BLNakUbiu5yy8ReadzEENeIXXgzZsp';

            $title = 'Pickup Order Sudah Diambil';
            $body = 'Hai ' . $user->name . ', order sudah di ambil nih! Cek sekarang juga! Mitra yang bertugas: ' . $partner_name;
            $notification = ['title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1'];

            $arrayToSend = ['registration_ids' => $token, 'notification' => $notification, 'priority' => 'high'];
            $json = json_encode($arrayToSend);

            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=' . $serverKey,
            ];

            // $response = Http::withHeaders($headers)
            //     ->post($url, $json);
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Order diambil';

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function approve_pickup_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $validated = Validator::make($request->all(), [
            'detail_order_id' => 'required|exists:detail_order,detail_order_id',
            'quantity' => 'required',
        ]);

        if ($validated->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Field tidak boleh kosong!';
            $response['errors'] = $validated->errors();

            return $this->response($response);
        }

        $data_id = $request->header('Data-ID');
        $order_id = $request->header('Order-ID');
        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $order = DB::table('order_data')
                ->where('order_id', $order_id)
                ->first();
            $date_create = substr($order->date_create, 0, 10);
            $now = date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $date_now = substr($now, 0, 10);
            $partner_name = DB::table('partner')
                ->where('partner_id', $data_id)
                ->first()
                ->name;
            if ($order->status == 1) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah Selesai!';

                return $this->response($response);
            }
            if ($date_now != $date_create) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah kadaluwarsa!';
                $this->response($response);
            }

            $detail_order_id = $request->detail_order_id;
            $quantity = $request->quantity;
            $url = 'https://fcm.googleapis.com/fcm/send';
            $serverKey = 'AAAA71K9pOA:APA91bGN0YZvTj5VLu-Auqfpdl1qc7gvKYX1e5TlKYzpJkAHi5oH83gaKAquDVrq4kqx32feoxIXKpzTkFDekCUEEQhA9Cgz44ZT-xQLnsVj_0BLNakUbiu5yy8ReadzEENeIXXgzZsp';
            $special_char = ['\'', '"', '[', ']', ','];
            $det_or_id = str_replace($special_char, ' ', $detail_order_id);
            $qty = str_replace($special_char, ' ', $quantity);

            $det_or_id_arr = explode(' ', $det_or_id);
            $qty_arr = explode(' ', $qty);

            $records = [];
            foreach ($det_or_id_arr as $key => $value) {
                if (!empty($value) && !empty($qty_arr[$key])) {
                    $price = DB::table('sub_trash_category')
                        ->select('sub_trash_category.price')
                        ->join('detail_order', 'detail_order.sub_category_id', '=', 'sub_trash_category.sub_category_id')
                        ->where('detail_order.detail_order_id', $value)
                        ->first();

                    if ($price) {
                        $total = $price->price * $qty_arr[$key];
                        $records[] = [
                            'detail_order_id' => $value,
                            'quantity' => $qty_arr[$key],
                            'sub_price' => $total,
                        ];
                    }
                }
            }

            DB::table('detail_order')->upsert($records, 'detail_order_id');

            $order_data = DB::table('order_data')
                ->select('order_data.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $user = DB::table('user')
                ->select('user.name', 'user.point', 'user.device_token')
                ->join('order_data', 'order_data.user_id', '=', 'user.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $company = DB::table('account')->first();

            $date_pick = Carbon::now();
            $total_price = DB::table('detail_order')
                ->where('detail_order.order_id', $order_id)
                ->sum('detail_order.sub_price');

            $profit = DB::table('share_profit_pickup')->first();

            $for_user = $total_price * $profit->for_user / 100;
            $for_company = $total_price * $profit->for_company / 100;

            $user_total_point = $for_user + $user->point;
            $company_total_point = $for_company + $company->point;

            DB::table('order_data')
                ->where('order_data.order_id', $order_id)
                ->update([
                    'total_point' => $total_price,
                    'status' => 1,
                    'date_pick' => $date_pick,
                ]);

            DB::table('user')
                ->where('user.user_id', $order_data->user_id)
                ->update(['point' => $user_total_point]);

            DB::table('account')
                ->where('account.account_id', $company->account_id)
                ->update(['point' => $company_total_point]);

            $notification = [
                'title' => 'Pickup Order Sudah Diapprove',
                'body' => "Hai $user->name, order sudah selesai! Cek detailnya! Mitra yang bertugas: $partner_name",
                'sound' => 'default',
                'badge' => '1',
            ];

            $arrayToSend = [
                'registration_ids' => [$user->device_token],
                'notification' => $notification,
                'priority' => 'high',
            ];

            $headers = [
                'Content-Type: application/json',
                'Authorization: key=' . $serverKey,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_exec($ch);
            curl_close($ch);

            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Order selesai',
            ];

            return $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function approve_company_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $validated = Validator::make($request->all(), [
            'detail_order_id' => 'required|exists:detail_order,detail_order_id',
            'quantity' => 'required',
        ]);

        if ($validated->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Field tidak boleh kosong!';
            $response['errors'] = $validated->errors();

            return $this->response($response);
        }

        $data_id = $request->header('Data-ID');
        $order_id = $request->header('Order-ID');
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = 'AAAA71K9pOA:APA91bGN0YZvTj5VLu-Auqfpdl1qc7gvKYX1e5TlKYzpJkAHi5oH83gaKAquDVrq4kqx32feoxIXKpzTkFDekCUEEQhA9Cgz44ZT-xQLnsVj_0BLNakUbiu5yy8ReadzEENeIXXgzZsp';

        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();
        $detail_order_id = $request->detail_order_id;
        $quantity = $request->quantity;
        $partner = DB::table('partner')
            ->where('partner_id', $data_id)
            ->first();
        if ($check) {
            $order = DB::table('order_data')
                ->select('order_data.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $date_create = substr($order->date_create, 0, 10);
            $now = date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $date_now = substr($now, 0, 10);

            if ($order->status == 1) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah selesai!';
                $this->response($response);
            }

            if ($date_now != $date_create) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah kadaluwarsa!';
                $this->response($response);
            }

            $special_char = ['\'', '"', '[', ']', ','];
            $det_or_id = str_replace($special_char, ' ', $detail_order_id);
            $qty = str_replace($special_char, ' ', $quantity);

            $det_or_id_arr = explode(' ', $det_or_id);
            $qty_arr = explode(' ', $qty);

            $records = [];
            foreach ($det_or_id_arr as $key => $det_or_id_item) {
                if (!empty($det_or_id_item) && !empty($qty_arr[$key])) {
                    $price = DB::table('sub_trash_category')
                        ->select('sub_trash_category.price')
                        ->join('detail_order', 'detail_order.sub_category_id', '=', 'sub_trash_category.sub_category_id')
                        ->where('detail_order.detail_order_id', $det_or_id_item)
                        ->value('price');

                    if ($price !== null) {
                        $total = $price * $qty_arr[$key];

                        $records[] = [
                            'detail_order_id' => $det_or_id_item,
                            'quantity' => $qty_arr[$key],
                            'sub_price' => $total,
                        ];
                    }
                }
            }

            DB::table('detail_order')->upsert($records, ['detail_order_id'], ['quantity', 'sub_price']);

            $user = DB::table('user')
                ->select('user.name', 'user.point', 'user.device_token')
                ->join('order_data', 'order_data.user_id', '=', 'user.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $get_company = DB::table('account')->first();

            $date_pick = now()->setTimezone('Asia/Jakarta');
            $total_price = DB::table('detail_order')
                ->where('order_id', $order_id)
                ->sum('sub_price');
            $profit = DB::table('share_profit_company')->first();
            $for_user = $total_price * $profit->for_user / 100;
            $for_partner = $total_price * $profit->for_partner / 100;
            $for_company = $total_price * $profit->for_company / 100;
            $t_user = $for_user + $user->point;
            $t_partner = $for_partner + $partner->point; // Assuming $partner_point is defined elsewhere
            $t_company = $for_company + $get_company->point;

            DB::table('order_data')
                ->where('order_id', $order_id)
                ->update([
                    'total_point' => $total_price,
                    'status' => 1,
                    'date_pick' => $date_pick,
                ]);

            DB::table('partner')
                ->where('partner_id', $data_id)
                ->update(['point' => $t_partner]);

            DB::table('user')
                ->where('user_id', $user->user_id)
                ->update(['point' => $t_user]);

            DB::table('account')
                ->where('account_id', $get_company->account_id)
                ->update(['point' => $t_company]);

            $title = 'Company Order Sudah Diapprove';
            $body = 'Hai ' . $user->name . ', order sudah sudah selesai! Cek detailnya! Mitra yang bertugas: ' . $partner->name;
            $notification = ['title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1'];

            $arrayToSend = ['to' => $user->device_token, 'notification' => $notification];
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', $arrayToSend);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Order selesai';
            $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function approve_event_api_post(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }
        $validated = Validator::make($request->all(), [
            'detail_order_id' => 'required|exists:detail_order,detail_order_id',
            'quantity' => 'required',
        ]);

        if ($validated->fails()) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Field tidak boleh kosong!';
            $response['errors'] = $validated->errors();

            return $this->response($response);
        }

        $data_id = $request->header('Data-ID');
        $order_id = $request->header('Order-ID');
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = 'AAAA71K9pOA:APA91bGN0YZvTj5VLu-Auqfpdl1qc7gvKYX1e5TlKYzpJkAHi5oH83gaKAquDVrq4kqx32feoxIXKpzTkFDekCUEEQhA9Cgz44ZT-xQLnsVj_0BLNakUbiu5yy8ReadzEENeIXXgzZsp';

        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();
        $detail_order_id = $request->detail_order_id;
        $quantity = $request->quantity;
        $partner = DB::table('partner')
            ->where('partner_id', $data_id)->first();
        if ($check) {
            $order = DB::table('order_data')
                ->select('order_data.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $date_create = substr($order->date_create, 0, 10);
            $now = date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $date_now = substr($now, 0, 10);

            if ($order->status == 1) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah selesai!';
                $this->response($response);
            }

            if ($date_now != $date_create) {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Order sudah kadaluwarsa!';
                $this->response($response);
            }

            $special_char = ['\'', '"', '[', ']', ','];
            $det_or_id = str_replace($special_char, ' ', $detail_order_id);
            $qty = str_replace($special_char, ' ', $quantity);

            $det_or_id_arr = explode(' ', $det_or_id);
            $qty_arr = explode(' ', $qty);

            $records = [];
            foreach ($det_or_id_arr as $key => $det_or_id_item) {
                if (!empty($det_or_id_item) && !empty($qty_arr[$key])) {
                    $price = DB::table('sub_trash_category')
                        ->select('sub_trash_category.price')
                        ->join('detail_order', 'detail_order.sub_category_id', '=', 'sub_trash_category.sub_category_id')
                        ->where('detail_order.detail_order_id', $det_or_id_item)
                        ->value('price');

                    if ($price !== null) {
                        $total = $price * $qty_arr[$key];

                        $records[] = [
                            'detail_order_id' => $det_or_id_item,
                            'quantity' => $qty_arr[$key],
                            'sub_price' => $total,
                        ];
                    }
                }
            }

            DB::table('detail_order')->upsert($records, ['detail_order_id'], ['quantity', 'sub_price']);

            $user = DB::table('user')
                ->select('user.name', 'user.point', 'user.device_token')
                ->join('order_data', 'order_data.user_id', '=', 'user.user_id')
                ->where('order_data.order_id', $order_id)
                ->first();

            $get_company = DB::table('account')->first();

            $date_pick = now()->setTimezone('Asia/Jakarta');
            $total_price = DB::table('detail_order')
                ->where('order_id', $order_id)
                ->sum('sub_price');
            $profit = DB::table('share_profit_event')->first();
            $for_user = $total_price * $profit->for_user / 100;
            $for_partner = $total_price * $profit->for_partner / 100;
            $for_company = $total_price * $profit->for_company / 100;
            $t_user = $for_user + $user->point;
            $t_partner = $for_partner + $partner->point; // Assuming $partner_point is defined elsewhere
            $t_company = $for_company + $get_company->point;

            DB::table('order_data')
                ->where('order_id', $order_id)
                ->update([
                    'total_point' => $total_price,
                    'status' => 1,
                    'date_pick' => $date_pick,
                ]);

            DB::table('partner')
                ->where('partner_id', $data_id)
                ->update(['point' => $t_partner]);

            DB::table('user')
                ->where('user_id', $order->user_id)
                ->update(['point' => $t_user]);

            DB::table('account')
                ->where('account_id', $get_company->account_id)
                ->update(['point' => $t_company]);

            $title = 'Event Order Sudah Diapprove';
            $body = 'Hai ' . $user->name . ', order sudah sudah selesai! Cek detailnya! Mitra yang bertugas: ' . $partner->name;
            $notification = ['title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1'];

            $arrayToSend = ['to' => $user->device_token, 'notification' => $notification];
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', $arrayToSend);

            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Order selesai';
            $this->response($response);
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function cancel_partner_order_api_get(Request $request)
    {
        if ($this->headerApi()) {
            return $this->headerApi();
        }

        $data_id = $request->header('Data-ID');
        $order_id = $request->header('Order-ID');

        if ($data_id == null || $order_id == null) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }

        $check = DB::table('partner_auth')
            ->where('partner_id', $data_id)
            ->where('token', $request->header('Auth-Key'))
            ->exists();

        if ($check) {
            $get_order = DB::table('order_data')
                ->where('order_id', $order_id)
                ->first();

            if ($get_order->status != 1) {
                DB::table('order_data')
                    ->where('order_id', $order_id)
                    ->update(['status' => 0, 'partner_id' => null]);

                return response()->json(['status' => 200, 'error' => false, 'message' => 'Order dibatalkan']);
            } else {
                return response()->json(['status' => 502, 'error' => true, 'message' => 'Order gagal dibatalkan!']);
            }
        } else {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }
    }

    public function get_partner_order_api_get(Request $request)
    {
        $client_service = $request->header('Client-Service');
        $data_id = $request->header('Data-ID');
        $auth_key = $request->header('Auth-Key');

        if ($data_id == null) {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Data tidak ditemukan!';

            return $this->response($response);
        }

        $partner_key = DB::table('partner_auth')
            ->select('partner_auth.token', 'partner.address', 'partner.provinces', 'partner.regencies', 'partner.districts', 'partner.villages', 'partner.device_token')
            ->join('partner', 'partner.partner_id', '=', 'partner_auth.partner_id')
            ->where('partner.partner_id', $data_id)
            ->first();

        if ($client_service == $this->client_service && $auth_key == $partner_key->token) {
            $check_data = DB::table('order_data')
                ->where('order_data.villages', $partner_key->villages)
                ->where('order_data.status', 0)
                ->where('order_data.type', 'Pickup')
                ->count();

            if ($check_data > 0) {
                $arrayRes = [];

                $get_data = DB::table('order_data')
                    ->select('order_data.order_id', 'order_data.status', 'order_data.date_create', 'order_data.weight', 'order_data.total_point', 'order_data.photo AS order_photo', 'order_data.address AS user_address', 'order_data.provinces AS user_provinces', 'order_data.regencies AS user_regencies', 'order_data.districts AS user_districts', 'order_data.villages AS user_villages', 'order_data.latitude', 'order_data.longitude', 'order_data.user_id', 'order_data.partner_id', 'order_data.type')
                    ->where('order_data.provinces', $partner_key->provinces)
                    ->where('order_data.regencies', $partner_key->regencies)
                    ->where('order_data.districts', $partner_key->districts)
                    ->where('order_data.villages', $partner_key->villages)
                    ->where('order_data.status', 0)
                    ->where('order_data.type', 'Pickup')
                    ->orderBy('order_data.date_create', 'DESC')
                    ->get();

                foreach ($get_data as $item) {
                    $month_create = substr($item->date_create, 0, 7);
                    $month_now = now()->setTimezone('Asia/Jakarta')->format('Y-m');

                    if ($month_create == $month_now) {
                        $date_create = substr($item->date_create, 0, 10);
                        $date_now = now()->setTimezone('Asia/Jakarta')->format('Y-m-d');

                        if ($date_create == $date_now) {
                            $get_user = DB::table('user')
                                ->select('user.phone AS user_phone', 'user.name AS user_name', 'user.photo AS user_photo', 'user.device_token AS user_device')
                                ->where('user.user_id', $item->user_id)
                                ->first();

                            $get_detail = DB::table('detail_order')
                                ->select('detail_order.detail_order_id', 'sub_trash_category.sub_category', 'sub_trash_category.price', 'detail_order.quantity', 'detail_order.sub_price')
                                ->join('sub_trash_category', 'detail_order.sub_category_id', '=', 'sub_trash_category.sub_category_id')
                                ->where('detail_order.order_id', $item->order_id)
                                ->get();

                            $result = [
                                'order_type' => $item->type,
                                'order_id' => $item->order_id,
                                'status' => $item->status,
                                'date_create' => $item->date_create,
                                'weight' => $item->weight,
                                'total_point' => $item->total_point,
                                'order_photo' => $item->order_photo,
                                'user_id' => $item->user_id,
                                'user_phone' => $get_user->user_phone,
                                'user_name' => $get_user->user_name,
                                'user_photo' => $get_user->user_photo,
                                'partner_id' => $item->partner_id,
                                'partner_address' => $partner_key->address,
                                'partner_provinces' => $partner_key->provinces,
                                'partner_regencies' => $partner_key->regencies,
                                'partner_districts' => $partner_key->districts,
                                'partner_villages' => $partner_key->villages,
                                'partner_device' => $partner_key->device_token,
                                'user_address' => $item->user_address,
                                'user_provinces' => $item->user_provinces,
                                'user_regencies' => $item->user_regencies,
                                'user_districts' => $item->user_districts,
                                'user_villages' => $item->user_villages,
                                'user_device' => $get_user->user_device,
                                'latitude' => $item->latitude,
                                'longitude' => $item->longitude,
                                'detail_category' => $get_detail,
                            ];

                            $arrayRes[] = $result;
                        }
                    }
                }

                if (!empty($arrayRes)) {
                    return response()->json(['status' => 200, 'error' => false, 'message' => 'Data berhasil ditemukan', 'data_order' => $arrayRes]);
                } else {
                    return response()->json(['status' => 502, 'error' => true, 'message' => 'Tidak ada order saat ini!']);
                }
            } else {
                return response()->json(['status' => 502, 'error' => true, 'message' => 'Tidak ada order saat ini!']);
            }
        } else {
            return response()->json(['status' => 502, 'error' => true, 'message' => 'Otentikasi gagal!']);
        }
    }

    public function get_partner_history_order_api_get(Request $request)
    {
        $client_service = request()->header('Client-Service');
        $data_id = request()->header('Data-ID');
        $auth_key = request()->header('Auth-Key');

        $partner_data = DB::table('partner_auth')
            ->select('partner_auth.token', 'partner.address', 'partner.provinces', 'partner.regencies', 'partner.districts', 'partner.villages', 'partner.device_token')
            ->join('partner', 'partner.partner_id', '=', 'partner_auth.partner_id')
            ->where('partner.partner_id', $data_id)
            ->first();

        if ($partner_data) {
            $key = $partner_data->token;
            $address = $partner_data->address;
            $provinces = $partner_data->provinces;
            $regencies = $partner_data->regencies;
            $districts = $partner_data->districts;
            $villages = $partner_data->villages;
            $partner_device = $partner_data->device_token;

            if ($client_service == $this->client_service && $auth_key == $key) {
                $check_data = DB::table('order_data')
                    ->where('partner_id', $data_id)
                    ->where('status', 1)
                    ->count();

                if ($check_data > 0) {
                    $result = [];

                    $get_data = DB::table('order_data')
                        ->select('order_id', 'status', 'date_create', 'weight', 'total_point', 'photo AS order_photo', 'address AS user_address', 'provinces AS user_provinces', 'regencies AS user_regencies', 'districts AS user_districts', 'villages AS user_villages', 'user_id', 'partner_id', 'type')
                        ->where('partner_id', $data_id)
                        ->where('status', 1)
                        ->orderBy('date_create', 'DESC')
                        ->get();

                    foreach ($get_data as $item) {
                        $month_create = substr($item->date_create, 0, 7);
                        $month_now = date('Y-m');

                        if ($month_create == $month_now) {
                            $get_user = DB::table('user')
                                ->select('phone AS user_phone', 'name AS user_name', 'photo AS user_photo', 'device_token AS user_device')
                                ->where('user_id', $item->user_id)
                                ->first();

                            $get_detail = DB::table('sub_trash_category')
                                ->select('detail_order.detail_order_id', 'sub_trash_category.sub_category', 'sub_trash_category.price', 'detail_order.quantity', DB::raw('detail_order.sub_price * share_profit_pickup.for_partner / 100 AS sub_price'))
                                ->join('detail_order', 'detail_order.sub_category_id', '=', 'sub_trash_category.sub_category_id')
                                ->where('detail_order.order_id', $item->order_id)
                                ->get()->toArray();

                            $profit = DB::table('share_profit_pickup')->first(); // Adjust this according to your logic

                            $detail_order = [];
                            foreach ($get_detail as $key) {
                                $detail = [
                                    'sub_category' => $key->sub_category,
                                    'price' => $key->price,
                                    'quantity' => $key->quantity,
                                    'sub_price' => $key->sub_price,
                                ];
                                $detail_order[] = $detail;
                            }

                            // Calculation for user, company, and partner shares
                            $for_user = $item->total_point * $profit->for_user / 100;
                            $for_company = $item->total_point * $profit->for_company / 100;
                            $for_partner = $item->total_point * $profit->for_partner / 100;

                            $result[] = [
                                'order_type' => $item->type,
                                'order_id' => $item->order_id,
                                'status' => $item->status,
                                'date_create' => $item->date_create,
                                'weight' => $item->weight,
                                'total_point' => $item->total_point,
                                'for_user' => $for_user,
                                'for_company' => $for_company,
                                'for_partner' => $for_partner,
                                'order_photo' => $item->order_photo,
                                'user_id' => $item->user_id,
                                'user_phone' => $get_user->user_phone,
                                'user_name' => $get_user->user_name,
                                'user_photo' => $get_user->user_photo,
                                'partner_id' => $item->partner_id,
                                'partner_address' => $address,
                                'partner_provinces' => $provinces,
                                'partner_regencies' => $regencies,
                                'partner_districts' => $districts,
                                'partner_villages' => $villages,
                                'partner_device' => $partner_device,
                                'user_address' => $item->user_address,
                                'user_provinces' => $item->user_provinces,
                                'user_regencies' => $item->user_regencies,
                                'user_districts' => $item->user_districts,
                                'user_villages' => $item->user_villages,
                                'user_device' => $get_user->user_device,
                                'detail_category' => $detail_order,
                            ];
                        } else {
                            return response()->json(['status' => 502, 'error' => true, 'message' => 'Tidak ada order saat ini!']);
                        }
                    }

                    return response()->json(['status' => 200, 'error' => false, 'message' => 'Data berhasil ditemukan', 'data_order' => $result]);
                } else {
                    return response()->json(['status' => 502, 'error' => true, 'message' => 'Tidak ada order saat ini!']);
                }
            } else {
                return response()->json(['status' => 502, 'error' => true, 'message' => 'Otentikasi gagal!']);
            }
        } else {
            return response()->json(['status' => 502, 'error' => true, 'message' => 'Partner tidak ditemukan!']);
        }
    }

    public function partner_widraw_api_post(Request $request)
    {
        $client_service = request()->header('Client-Service');
        $data_id = request()->header('Data-ID');
        $auth_key = request()->header('Auth-Key');

        $partner_key = DB::table('partner_auth')
            ->select('partner_auth.token')
            ->join('partner', 'partner.partner_id', '=', 'partner_auth.partner_id')
            ->where('partner.partner_id', $data_id)
            ->first();

        if ($partner_key) {
            $key = $partner_key->token;

            if ($client_service == $this->client_service && $auth_key == $key) {
                $nominal = request()->input('nominal');
                $phone = request()->input('phone');
                $type = request()->input('type');
                $date_request = now();
                $withdraw_id = Str::random(10);

                if (!empty($nominal) && !empty($phone)) {
                    $check_point = DB::table('partner')
                        ->where('partner_id', $data_id)
                        ->first();

                    if ($nominal <= $check_point->point) {
                        if ($nominal >= 50000) {
                            $calculated_point = $check_point->point - $nominal;

                            $data = [
                                'withdraw_id' => $withdraw_id,
                                'nominal' => $nominal,
                                'phone' => $phone,
                                'partner_id' => $data_id,
                                'date_request' => $date_request,
                                'status' => 0,
                                'type' => $type,
                            ];

                            DB::table('widraw_partner')->insert($data);
                            DB::table('partner')
                                ->where('partner_id', $data_id)
                                ->update(['point' => $calculated_point]);

                            return response()->json(['status' => 200, 'error' => false, 'message' => 'Permintaan dikirim']);
                        } else {
                            return response()->json(['status' => 502, 'error' => true, 'message' => 'Minimal permintaan Rp.50.000!']);
                        }
                    } else {
                        return response()->json(['status' => 502, 'error' => true, 'message' => 'Point tidak mencukupi!']);
                    }
                } else {
                    return response()->json(['status' => 502, 'error' => true, 'message' => 'Field tidak boleh kosong!']);
                }
            } else {
                return response()->json(['status' => 502, 'error' => true, 'message' => 'Otentikasi gagal!']);
            }
        } else {
            return response()->json(['status' => 502, 'error' => true, 'message' => 'Partner tidak ditemukan!']);
        }
    }

    public function get_partner_widraw_api_get(Request $request)
    {
        $client_service = request()->header('Client-Service');
        $data_id = request()->header('Data-ID');
        $auth_key = request()->header('Auth-Key');

        $partner_key = DB::table('partner_auth')
            ->select('partner_auth.token')
            ->join('partner', 'partner.partner_id', '=', 'partner_auth.partner_id')
            ->where('partner.partner_id', $data_id)
            ->first();

        if ($partner_key) {
            $key = $partner_key->token;

            if ($client_service == $this->client_service && $auth_key == $key) {
                $check_data = DB::table('widraw_partner')
                    ->where('partner_id', $data_id)
                    ->count();

                if ($check_data > 0) {
                    $result = [];
                    $widraw_pending = 0;
                    $widraw_success = 0;

                    $get_data = DB::table('widraw_partner')
                        ->where('partner_id', $data_id)
                        ->orderBy('date_request', 'DESC')
                        ->get();

                    foreach ($get_data as $item) {
                        $month_request = substr($item->date_request, 0, 7);
                        $month_now = date('Y-m');

                        if ($month_request == $month_now) {
                            $get_partner = DB::table('partner')
                                ->where('partner_id', $item->partner_id)
                                ->first();

                            $result[] = [
                                'widraw_type' => trim($item->type),
                                'widraw_id' => $item->widraw_id,
                                'status' => $item->status,
                                'nominal' => $item->nominal,
                                'phone' => $item->phone,
                                'date_request' => $item->date_request,
                                'partner_id' => $item->partner_id,
                                'partner_device' => $get_partner->device_token,
                            ];
                        } else {
                            return response()->json([
                                'status' => 502,
                                'error' => true,
                                'message' => 'Tidak ada widraw saat ini!',
                                'widraw_pending' => 0,
                                'widraw_success' => 0,
                            ]);
                        }
                    }

                    $widraw_pending = DB::table('widraw_partner')
                        ->where('partner_id', $data_id)
                        ->where('status', 0)
                        ->sum('nominal');

                    $widraw_success = DB::table('widraw_partner')
                        ->where('partner_id', $data_id)
                        ->where('status', 1)
                        ->sum('nominal');

                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'message' => 'Data berhasil ditemukan',
                        'widraw_pending' => $widraw_pending,
                        'widraw_success' => $widraw_success,
                        'data_widraw' => $result,
                    ]);
                } else {
                    return response()->json([
                        'status' => 502,
                        'error' => true,
                        'message' => 'Tidak ada widraw saat ini!',
                        'widraw_pending' => 0,
                        'widraw_success' => 0,
                    ]);
                }
            } else {
                return response()->json(['status' => 502, 'error' => true, 'message' => 'Otentikasi gagal!']);
            }
        } else {
            return response()->json(['status' => 502, 'error' => true, 'message' => 'Partner tidak ditemukan!']);
        }
    }
}
