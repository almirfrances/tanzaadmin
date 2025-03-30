<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use Modules\Users\Http\Controllers\AuthController;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Middleware\EnsureEmailIsVerified;
use Modules\Users\Http\Middleware\RedirectIfAuthenticated;
use Modules\Users\Http\Middleware\EnsureUserIsAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('/social-login/{provider}/redirect', [AuthController::class, 'redirectToProvider'])->name('social.redirect');
    Route::get('/social-login/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('social.callback');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::prefix('user')->name('user.')->group(function () {
        // Forgot Password
        Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
        Route::post('forgot-password', [AuthController::class, 'sendResetCode'])->name('send-reset-code');
        // Verify Reset Code
        Route::get('verify-reset-code', [AuthController::class, 'showVerifyCodeForm'])->name('verify-reset-code');
        Route::post('verify-reset-code', [AuthController::class, 'verifyResetCode']);
        // Reset Password
        Route::get('reset-password', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');
        Route::post('update-password', [AuthController::class, 'updatePassword'])->name('update-password');
    });

});


Route::prefix('user')->name('user.')->group(function () {
    Route::get('verify-email', [AuthController::class, 'showEmailVerificationForm'])->name('verify-email');
    Route::post('verify-email', [AuthController::class, 'verifyEmailCode'])->name('verify-email.post');
    Route::post('resend-email-code', [AuthController::class, 'resendEmailCode'])->name('resend-email-code');

    Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {

        Route::middleware([EnsureEmailIsVerified::class])->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('dashboard');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::prefix('/profile')->name('profile.')->group(function () {
                Route::get('/account', [AuthController::class, 'view'])->name('account.view');
                Route::put('/account', [AuthController::class, 'update'])->name('account.update');
                Route::get('/security', [AuthController::class, 'security'])->name('security.index');
                Route::put('/security', [AuthController::class, 'changePassword'])->name('security.update');
            });
        });

    });
});


$adminPrefix = config('admin.route_prefix', 'admin');
Route::prefix($adminPrefix)->name('admin.')->group(function () {
    Route::middleware([AuthenticateAdmin::class])->group(function () {
        Route::get('users', [UsersController::class, 'AdminIndex'])->name('users.index'); // Display users
        Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update'); // Update user details
        Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy'); // Delete user


    });
});
