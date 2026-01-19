<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralAuth\LoginController;
use App\Http\Controllers\Central\DashboardController;
use App\Http\Controllers\Central\TenantController;
use App\Http\Controllers\Central\CentralAdminController;
use App\Http\Controllers\Central\TenantAdminController;

/*
|--------------------------------------------------------------------------
| Central Domain Routes
|--------------------------------------------------------------------------
|
| These routes are for the central admin domain.
|
*/

// Guest routes (not authenticated)
Route::middleware('guest:central')->group(function () {
    // Root redirect to login
    Route::get('/', function () {
        return redirect()->route('central.login');
    });

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('central.login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated central admin routes
Route::middleware('auth:central')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('central.logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('central.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Tenants management
    Route::post('/tenants/{tenant}/toggle-status', [TenantController::class, 'toggleStatus'])
        ->name('central.tenants.toggle-status');
    Route::resource('tenants', TenantController::class)->names('central.tenants');

    // Central admins management
    Route::resource('admins', CentralAdminController::class)->names('central.admins');

    // Tenant admins management
    Route::resource('tenant-admins', TenantAdminController::class)->names('central.tenant-admins');
});
