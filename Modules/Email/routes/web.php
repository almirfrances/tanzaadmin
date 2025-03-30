<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use Modules\Email\Http\Controllers\EmailController;

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
Route::middleware([AuthenticateAdmin::class])->group(function () {
    Route::prefix('settings/email')->name('email.')->group(function () {
        Route::get('/queue-status', [EmailController::class, 'checkQueueStatus'])->name('queue-status');

        // Email Settings
        Route::get('/email-settings', [EmailController::class, 'emailSettings'])->name('settings');
        Route::post('/email-settings/update', [EmailController::class, 'updateEmailSettings'])->name('settings.update');

        Route::post('/test', [EmailController::class, 'testEmail'])->name('test');


        // Global Template
        Route::get('/global-template', [EmailController::class, 'globalTemplate'])->name('global-template');
        Route::post('/global-template/update', [EmailController::class, 'updateGlobalTemplate'])->name('global-template.update');

        // Notification Templates
        Route::get('/notification-templates', [EmailController::class, 'notificationTemplates'])->name('notification-templates');
        Route::get('/notification-templates/manage/{id?}', [EmailController::class, 'manageNotificationTemplate'])->name('notification-templates.manage');
        Route::put('/notification-templates/save/{id?}', [EmailController::class, 'saveNotificationTemplate'])->name('notification-templates.save');
        Route::post('/notification-templates/store', [EmailController::class, 'store'])->name('notification-templates.store');

        Route::delete('/notification-templates/delete/{id}', [EmailController::class, 'deleteNotificationTemplate'])->name('notification-templates.delete');
    });
});
