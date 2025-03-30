<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use Modules\Ticket\Http\Controllers\TicketController;
use Modules\Users\Http\Middleware\EnsureEmailIsVerified;
use Modules\Ticket\Http\Controllers\AdminTicketController;
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


Route::prefix('user')->name('user.')->group(function () {
    Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {
        Route::middleware([EnsureEmailIsVerified::class])->group(function () {
                 // Ticket routes
                Route::prefix('tickets')->name('tickets.')->group(function () {
                    // View list of tickets
                    Route::get('/', [TicketController::class, 'index'])->name('index');
                    // Create a new ticket
                    Route::get('/create', [TicketController::class, 'create'])->name('create');
                    // Store a new ticket
                    Route::post('/', [TicketController::class, 'store'])->name('store');
                    // View a specific ticket
                    Route::get('/{id}', [TicketController::class, 'show'])->name('show');
                    // Add a reply to a ticket
                    Route::post('/{id}/reply', [TicketController::class, 'reply'])->name('reply');
                    // Close a ticket
                    Route::post('/{id}/close', [TicketController::class, 'close'])->name('close');
                    // Reopen a ticket
                    Route::post('/{id}/reopen', [TicketController::class, 'reopen'])->name('reopen');
                });

        });

    });
});


$adminPrefix = config('admin.route_prefix', 'admin');
Route::prefix($adminPrefix)->name('admin.')->group(function () {
    Route::middleware([AuthenticateAdmin::class])->group(function () {

        Route::prefix('/tickets')->name('tickets.')->group(function () {
            Route::get('/settings', [AdminTicketController::class, 'settings'])->name('settings');
            Route::post('/settings/update', [AdminTicketController::class, 'updateSettings'])->name('settings.update');

    // List all tickets
            Route::get('/', [AdminTicketController::class, 'index'])->name('index');

            // View a specific ticket
            Route::get('/{id}', [AdminTicketController::class, 'show'])->name('show');

            // Add a reply to a ticket
            Route::post('/{id}/reply', [AdminTicketController::class, 'reply'])->name('reply');

            // Close a ticket
            Route::post('/{id}/close', [AdminTicketController::class, 'close'])->name('close');

            // Reopen a ticket
            Route::post('/{id}/reopen', [AdminTicketController::class, 'reopen'])->name('reopen');

            // Mark a ticket as answered
            Route::post('/{id}/mark-as-answered', [AdminTicketController::class, 'markAsAnswered'])->name('mark-as-answered');
        });
    });
});
