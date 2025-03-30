<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use Modules\Blog\Http\Controllers\BlogController;

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

// Group routes with middleware for authentication and prefix for admin area
$adminPrefix = config('admin.route_prefix', 'admin');
Route::prefix($adminPrefix)->name('admin.')->group(function () {
    Route::middleware([AuthenticateAdmin::class])->group(function () {
        Route::prefix('/blog')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::get('/edit/{post}', [BlogController::class, 'edit'])->name('edit');
            Route::put('/update/{post}', [BlogController::class, 'update'])->name('update');
            Route::delete('/destroy/{post}', [BlogController::class, 'destroy'])->name('destroy');

            // Routes for category management
            Route::get('/categories', [BlogController::class, 'indexCategory'])->name('categories.index');
            Route::post('/category/store', [BlogController::class, 'storeCategory'])->name('category.store');
            Route::put('/category/update/{category}', [BlogController::class, 'updateCategory'])->name('category.update');
            Route::delete('/category/destroy/{category}', [BlogController::class, 'destroyCategory'])->name('category.destroy');
        });
    });
});
