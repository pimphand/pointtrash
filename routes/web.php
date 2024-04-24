<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard-data', [\App\Http\Controllers\Admin\DashboardController::class, 'data'])->name('dashboard.data');

Route::resource('information', \App\Http\Controllers\Admin\SiteInformationController::class)->only(['index', 'update']);
Route::resource('logo', \App\Http\Controllers\Admin\SiteLogoController::class)->only(['index', 'update']);
Route::resource('social-media', \App\Http\Controllers\Admin\SiteSocialMediaController::class)->only(['index', 'update']);
Route::resource('site-contact', \App\Http\Controllers\Admin\SiteContactController::class)->only(['index', 'update']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
