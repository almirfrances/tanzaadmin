<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateAdmin;
use Modules\Page\Http\Controllers\PageController;

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

$adminPrefix = config('admin.route_prefix', 'admin');
Route::prefix($adminPrefix)->name('admin.')->group(function () {
    Route::middleware([AuthenticateAdmin::class])->group(function () {
    
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('index');
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::delete('/destroy/{page}', [PageController::class, 'destroy'])->name('destroy');

            // Manage sections for a specific page
            Route::get('{pageId}/sections/manage', [PageController::class, 'manageSections'])->name('manage');
            // Update the order of sections via AJAX
            Route::put('{pageId}/sections/update-order', [PageController::class, 'updateSections'])->name('sections.updateOrder');

        });

        Route::prefix('seo')->name('seo.')->group(function () {

        });

        Route::prefix('sections')->name('sections.')->group(function () {
            Route::get('/', [PageController::class, 'sectionsIndex'])->name('index');
    
            // Route for editing a section (CRUD or simple)
            Route::get('{sectionKey}/edit', [PageController::class, 'editSection'])->name('edit');

            Route::put('{sectionKey}', [PageController::class, 'updateSection'])->name('update');
   
            // CRUD Section Item routes:
            Route::post('{sectionKey}/items', [PageController::class, 'storeSectionItem'])->name('item.store');
        
            Route::put('{sectionKey}/items/{itemId}', [PageController::class, 'updateSectionItem'])->name('item.update');
        
            Route::delete('{sectionKey}/items/{itemId}', [PageController::class, 'destroySectionItem'])->name('item.destroy');
        });

    });

        
});
