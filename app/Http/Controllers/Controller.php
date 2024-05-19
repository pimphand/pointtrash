<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function headerApi()
    {
        if (request()->header('Client-Service') != 'frontend-client') {
            $response['status'] = 502;
            $response['error'] = true;
            $response['message'] = 'Otentikasi gagal!';

            return $response;
        }

        return null;
    }

    public function response($key)
    {
        return response()->json($key);
    }
}
