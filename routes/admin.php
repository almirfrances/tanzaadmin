<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminProfileController;
use App\Http\Controllers\ModulesManagementController;



    // Login Routes Here
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');



    // Forgot Password
    Route::get('forgot-password', [AdminLoginController::class, 'showForgotPasswordForm'])
        ->name('forgot-password');
    Route::post('forgot-password', [AdminLoginController::class, 'sendResetCode'])
        ->name('send-reset-code');

    // Verify Reset Code
    Route::get('verify-reset-code', [AdminLoginController::class, 'showVerifyCodeForm'])
        ->name('verify-reset-code');
    Route::post('verify-reset-code', [AdminLoginController::class, 'verifyResetCode']);

    // Reset Password
    Route::get('reset-password', [AdminLoginController::class, 'showResetPasswordForm'])
        ->name('reset-password');
    Route::post('update-password', [AdminLoginController::class, 'updatePassword'])
        ->name('update-password');

Route::middleware([AuthenticateAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/account', [AdminProfileController::class, 'view'])->name('account.view');
        Route::put('/account', [AdminProfileController::class, 'update'])->name('account.update');
        Route::get('/security', [AdminProfileController::class, 'security'])->name('security.index');
        Route::put('/security', [AdminProfileController::class, 'changePassword'])->name('security.update');
    });

    Route::prefix('/modules')->name('modules.')->group(function () {
        Route::get('/', [ModulesManagementController::class, 'index'])->name('index');
        Route::post('/upload', [ModulesManagementController::class, 'upload'])->name('upload');
        Route::put('/{module}/activate', [ModulesManagementController::class, 'activate'])->name('activate');
        Route::put('/{module}/deactivate', [ModulesManagementController::class, 'deactivate'])->name('deactivate');
        Route::delete('/{module}', [ModulesManagementController::class, 'destroy'])->name('destroy');
        // Bulk Actions
        Route::post('/bulk-activate', [ModulesManagementController::class, 'bulkActivate'])->middleware('throttle:10,1')->name('bulkActivate');
        Route::post('/bulk-deactivate', [ModulesManagementController::class, 'bulkDeactivate'])->middleware('throttle:10,1')->name('bulkDeactivate');
        Route::post('/bulk-delete', [ModulesManagementController::class, 'bulkDelete'])->middleware('throttle:10,1')->name('bulkDelete');

    });





});

