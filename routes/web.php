<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Controllers\PageController as FrontPageController;


Route::middleware([CheckMaintenanceMode::class])->group(function () {

        // Homepage route: show the page that is flagged as the homepage
        Route::get('/', [FrontPageController::class, 'home'])->name('home');
    
        // Dynamic route: show page by its slug
        $adminPrefix = config('admin.route_prefix', 'admin');

        $regex = '^(?!login$|register$|forgot-password$|user.*$|'.$adminPrefix.'.*$|almir.*$).*';

        // Catch-all dynamic route for frontend pages.
        Route::get('/{slug}', [FrontPageController::class, 'show'])
             ->where('slug', $regex)
             ->name('page.show');

});
