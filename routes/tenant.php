<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenant\Auth\LoginController;
use App\Http\Controllers\Tenant\LandingController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\ProductController;
use App\Http\Middleware\TenantAuth;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| These routes are available to each tenant with their own subdomain.
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Public routes (landing page)
    Route::get('/', [LandingController::class, 'index'])->name('tenant.home');

    // Guest routes (not authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('tenant.login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    // Authenticated tenant admin routes
    Route::middleware(TenantAuth::class)->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('tenant.logout');

        // Admin dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('tenant.dashboard');

        // Products management
        Route::resource('products', ProductController::class)->names('tenant.products');
    });
});
