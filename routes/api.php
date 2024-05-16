<?php

use App\Http\Controllers\Mobile\PartnerController;
use Illuminate\Support\Facades\Route;

Route::post('auth_partner_api', [PartnerController::class, 'auth_partner_api_post']);
Route::post('req_pass_partner_api', [PartnerController::class, 'req_pass_partner_api_post']);
Route::get('get_partner_profile_api', [PartnerController::class, 'get_partner_profile_api_get']);
Route::post('up_partner_profile_api', [PartnerController::class, 'up_partner_profile_api']);
Route::post('up_partner_name_api', [PartnerController::class, 'up_partner_name_api_post']);
Route::post('up_partner_phone_api', [PartnerController::class, 'up_partner_phone_api_post']);
Route::post('up_partner_email_api', [PartnerController::class, 'up_partner_email_api_post']);
Route::post('up_partner_pass_api', [PartnerController::class, 'up_partner_pass_api_post']);
Route::post('up_partner_address_api', [PartnerController::class, 'up_partner_address_api']);
Route::get('get_version_partner_api', [PartnerController::class, 'get_version_partner_api']);
Route::get('take_pickup_api', [PartnerController::class, 'take_pickup_api_get']);
Route::post('approve_pickup_api', [PartnerController::class, 'approve_pickup_api_post']);
Route::post('approve_company_api', [PartnerController::class, 'approve_company_api_post']);
Route::post('approve_event_api', [PartnerController::class, 'approve_event_api_post']);
Route::get('cancel_partner_order_api', [PartnerController::class, 'cancel_partner_order_api_get']);
Route::get('get_partner_order_api', [PartnerController::class, 'get_partner_order_api_get']);
Route::get('get_partner_history_order_api', [PartnerController::class, 'get_partner_history_order_api_get']);
Route::post('partner_widraw_api', [PartnerController::class, 'partner_widraw_api_post']);
Route::get('get_partner_widraw_api', [PartnerController::class, 'get_partner_widraw_api_get']);
Route::post('partner_change_branch', [PartnerController::class, 'partner_change_branch_post']);

//
Route::get('get_branch', [PartnerController::class, 'get_branch']);


