<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use Modules\Settings\Http\Controllers\SettingsController;

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
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::get('/general', [SettingsController::class, 'general'])->name('general');
        Route::post('/general', [SettingsController::class, 'updateGeneralSettings'])->name('update-general');
        Route::get('/configuration', [SettingsController::class, 'configuration'])->name('configuration');
        Route::post('/update-force-https', [SettingsController::class, 'updateForceHttps'])->name('update-force-https');
        Route::post('/update-allow-user-registration', [SettingsController::class, 'updateAllowUserRegistration'])->name('update-allow-user-registration');
        Route::post('/update-auth-forms', [SettingsController::class, 'updateAuthForms'])->name('update-auth-forms');
        Route::post('/update-require-email-confirmation', [SettingsController::class, 'updateRequireEmailConfirmation'])->name('update-require-email-confirmation');
        Route::post('/update-admin-login-notifications', [SettingsController::class, 'updateAdminLoginNotifications'])->name('update-admin-login-notifications');
        Route::post('/update-allow-email-notifications', [SettingsController::class, 'updateAllowEmailNotifications'])->name('update-allow-email-notifications');
        Route::post('/clear-cache', [SettingsController::class, 'clearCache'])->name('clear-cache');

        Route::get('/logo-favicon', [SettingsController::class, 'logoFavicon'])->name('logo-favicon');
        Route::post('/logo-favicon/upload', [SettingsController::class, 'uploadLogoFavicon'])->name('logo-favicon.upload');
        Route::post('/logo-favicon/update', [SettingsController::class, 'updateLogoFavicon'])->name('logo-favicon.update');

        Route::get('social-logins', [SettingsController::class, 'Soindex'])->name('social-logins');
        Route::post('social-logins/update', [SettingsController::class, 'Soupdate'])->name('social-logins.update');


        Route::get('custom-code', [SettingsController::class, 'customCode'])->name('custom-code');
        Route::post('update-custom-code', [SettingsController::class, 'updateCustomCode'])->name('update-custom-code');

        Route::get('sitemap-xml', [SettingsController::class, 'sitemapXML'])->name('sitemap-xml');
        Route::post('update-sitemap-xml', [SettingsController::class, 'updateSitemapXML'])->name('update-sitemap-xml');

        Route::get('/robots-txt', [SettingsController::class, 'robotsTxt'])->name('robots-txt');
        Route::post('/update-robots-txt', [SettingsController::class, 'updateRobotsTxt'])->name('update-robots-txt');

        Route::get('/maintenance-mode', [SettingsController::class, 'maintenanceMode'])->name('maintenance-mode');
        Route::post('/update-maintenance-mode', [SettingsController::class, 'updateMaintenanceMode'])->name('update-maintenance-mode');









    });
    Route::prefix('/backups')->name('backups.')->group(function () {
        Route::get('/', [SettingsController::class, 'indexBackup'])->name('index');
        Route::post('/create', [SettingsController::class, 'createBackup'])->name('create');
        Route::get('/download/{fileName}', [SettingsController::class, 'downloadBackup'])->name('download');
        Route::post('/delete/{fileName}', [SettingsController::class, 'deleteBackup'])->name('delete');
        Route::get('/restore/{fileName}', [SettingsController::class, 'restoreBackup'])->name('restore');

    });

});
