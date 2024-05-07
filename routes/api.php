<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Mobile\Partner\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth_partner_api', [AuthController::class, 'auth_partner_api_post']);
Route::post('req_pass_partner_api', [AuthController::class, 'req_pass_partner_api_post']);
Route::get('get_partner_profile_api', [AuthController::class, 'get_partner_profile_api_get']);
Route::post('up_partner_profile_api', [AuthController::class, 'up_partner_profile_api']);
Route::post('up_partner_name_api', [AuthController::class, 'up_partner_name_api_post']);
Route::post('up_partner_phone_api', [AuthController::class, 'up_partner_phone_api_post']);
Route::post('up_partner_email_api', [AuthController::class, 'up_partner_email_api_post']);
Route::post('up_partner_pass_api', [AuthController::class, 'up_partner_pass_api_post']);
Route::post('up_partner_address_api', [AuthController::class, 'up_partner_address_api']);
Route::get('get_version_partner_api', [AuthController::class, 'get_version_partner_api']);
Route::get('take_pickup_api', [AuthController::class, 'take_pickup_api_get']);
Route::post('approve_pickup_api', [AuthController::class, 'approve_pickup_api_post']);
Route::post('approve_company_api', [AuthController::class, 'approve_company_api_post']);
Route::post('approve_event_api', [AuthController::class, 'approve_event_api_post']);
Route::get('cancel_partner_order_api', [AuthController::class, 'cancel_partner_order_api_get']);
Route::get('get_partner_order_api', [AuthController::class, 'get_partner_order_api_get']);
Route::get('get_partner_history_order_api', [AuthController::class, 'get_partner_history_order_api_get']);
Route::post('partner_widraw_api', [AuthController::class, 'partner_widraw_api_post']);
Route::get('get_partner_widraw_api', [AuthController::class, 'get_partner_widraw_api_get']);


Route::post('/login', [LoginController::class, 'store'])->name('login');
