<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ])->validate();

        $user = Account::where('username', $validate['username'])->first();
        //cek password hash
        if (!$user && !$this->hash_verified($validate['password'], $user->password)) {
            return response()->json(['message' => 'Password Salah'], 401);
        }

        $auth = Auth::guard('admin')->attempt($validate);

        if (!$auth) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json(['message' => 'Login berhasil', 'status' => 'success'], 200);
    }

    public function hash_verified($PlainPassword, $HashPassword)
    {

        return $this->password_verify($PlainPassword, $HashPassword) ? true : false;
    }

    public function password_verify($password, $hash)
    {
        if (strlen($hash) !== 60 or strlen($password = crypt($password, $hash)) !== 60) {
            return false;
        }

        $compare = 0;
        for ($i = 0; $i < 60; $i++) {
            $compare |= (ord($password[$i]) ^ ord($hash[$i]));
        }

        return $compare === 0;
    }

    public function verify($type, $id)
    {
        dd(decrypt($type), decrypt($id));
    }
}
