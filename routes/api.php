<?php

use App\Http\Controllers\Mobile\PartnerController;
use App\Http\Controllers\Mobile\UserController;
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

// Register User
Route::post('regis_user_api', [UserController::class, 'regis_user_api']);
Route::post('auth_user_api', [UserController::class, 'auth_user_api_post']);
Route::post('req_pass_user_api', [UserController::class, 'req_pass_user_api']);
Route::get('get_user_profile_api', [UserController::class, 'get_user_profile_api']);
Route::post('up_user_profile_api', [UserController::class, 'up_user_profile_api']);
Route::post('up_user_name_api', [UserController::class, 'up_user_name_api_post']);
Route::post('up_user_phone_api', [UserController::class, 'up_user_phone_api_post']);
Route::post('up_user_email_api', [UserController::class, 'up_user_email_api_post']);
Route::post('up_user_pass_api', [UserController::class, 'up_user_pass_api_post']);
Route::post('up_user_address_api', [UserController::class, 'up_user_address_api']);
Route::post('pickup_order_api', [UserController::class, 'pickup_order_api_post']);
Route::post('drop_off_order_api', [UserController::class, 'drop_off_order_api_post']);
Route::post('company_order_api', [UserController::class, 'company_order_api_post']);
Route::post('event_order_api', [UserController::class, 'event_order_api_post']);
Route::get('cancel_order_api', [UserController::class, 'cancel_order_api_get']);
Route::get('delete_order_api', [UserController::class, 'delete_order_api_get']);
Route::get('get_user_order_api', [UserController::class, 'get_user_order_api_get']);
Route::get('get_user_history_order_api', [UserController::class, 'get_user_history_order_api_get']);
Route::post('input_rating_api', [UserController::class, 'input_rating_api_post']);
Route::post('user_widraw_api', [UserController::class, 'user_widraw_api_post']);
Route::get('get_user_widraw_api', [UserController::class, 'get_user_widraw_api_get']);

/* -----------------------------------------------------------------------
                       MOBILE DATA API ROUTE
 ----------------------------------------------------------------------- */
Route::get('get_guide_api', [UserController::class, 'get_guide_api']);
Route::get('get_terms_condition_api', [UserController::class, 'get_terms_condition_api_get']);
Route::get('get_privacy_api', [UserController::class, 'get_privacy_api_get']);
Route::get('get_question_api', [UserController::class, 'get_question_api_get']);
Route::get('get_version_api', [UserController::class, 'get_version_api_get']);
Route::get('get_advertisment_api', [UserController::class, 'get_advertisment_api_get']);
Route::get('get_trash_category_api', [UserController::class, 'get_trash_category_api_get']);
