<?php

use App\Http\Controllers\Admin\AboutSiteController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdvertismentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralQuestionController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\OrderDatumController;
use App\Http\Controllers\Admin\OurTeamController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteContactController;
use App\Http\Controllers\Admin\SiteInformationController;
use App\Http\Controllers\Admin\SiteLogoController;
use App\Http\Controllers\Admin\SiteSocialMediaController;
use App\Http\Controllers\Admin\SubTrashCategoryController;
use App\Http\Controllers\Admin\TermsOfServiceController;
use App\Http\Controllers\Admin\TrashCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VersionController;
use App\Http\Controllers\Admin\WidrawUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::middleware(['auth:admin', 'isActive'])->prefix('dashboard')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/data', [DashboardController::class, 'data'])->name('dashboard.data');
    Route::middleware('role')->group(function () {
        Route::resource('information', SiteInformationController::class)->only(['index', 'update']);
        Route::resource('logo', SiteLogoController::class)->only(['index', 'update']);
        Route::resource('social-media', SiteSocialMediaController::class)->only(['index', 'update']);
        Route::resource('site-contact', SiteContactController::class)->only(['index', 'update']);
        Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('portfolio', PortofolioController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('about-site', AboutSiteController::class)->only(['index', 'update']);
        Route::resource('blogs', BlogController::class);
        Route::resource('our-team', OurTeamController::class);
        Route::resource('advertisment', AdvertismentController::class);
        Route::resource('terms-of-service', TermsOfServiceController::class);
        Route::resource('privacy-policy', PrivacyPolicyController::class);
        Route::resource('mobile-version', VersionController::class);
        Route::resource('mobile-guide', GuideController::class);
        Route::resource('general-question', GeneralQuestionController::class);

        Route::resource('accounts', AccountController::class);


        Route::get('widraws/{type}/{id}', [WidrawUserController::class, 'show'])->name('widraws.show');
        Route::get('widraws/{id}', [WidrawUserController::class, 'index'])->name('widraws.index');
        Route::get('widraws-partner/{id}', [WidrawUserController::class, 'index'])->name('widraws.partner');
        Route::get('widraws-partner/history/{id}', [WidrawUserController::class, 'index'])->name('widraws.partner.history');

        Route::delete('widraw/{id}', [WidrawUserController::class, 'destroy'])->name('widraws.destroy');
        Route::get('widraws/create/{id}', [WidrawUserController::class, 'create'])->name('widraws.create');
        Route::get('widraws/export/{id}', [WidrawUserController::class, 'export'])->name('widraws.export');
        Route::get('widraw/history/{id}', [WidrawUserController::class, 'index'])->name('widraws.history');
        Route::post('widraws/{type}/{id}/{status}', [WidrawUserController::class, 'approve'])->name('widraws.approve');
    });

    Route::resource('users', UserController::class);
    Route::get('users-data/{user_id}', [UserController::class, 'getData'])->name('users.data');

    Route::resource('partners', PartnerController::class);
    Route::get('users-export/{export}', [UserController::class, 'export'])->name('users.export');

    Route::get('orders/{type}/{id}', [OrderDatumController::class, 'show'])->name('orders.show');
    Route::get('orders/{id}', [OrderDatumController::class, 'index'])->name('orders.index');
    Route::get('orders/create/{id}', [OrderDatumController::class, 'create'])->name('orders.create');
    Route::get('orders/export/{id}', [OrderDatumController::class, 'export'])->name('orders.export');
    Route::get('order/history/{id}', [OrderDatumController::class, 'index'])->name('orders.history');

    Route::resource('trash-categories', SubTrashCategoryController::class);
    Route::resource('trash', TrashCategoryController::class);

    Route::post('orders/update-share-profit/{id}', [OrderDatumController::class, 'updateShareProfit'])->name('orders.updateShareProfit');
});

//Partners
require __DIR__ . '/auth.php';
