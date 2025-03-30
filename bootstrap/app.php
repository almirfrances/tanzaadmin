<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            $adminPrefix = config('admin.route_prefix', 'admin');
            Route::middleware(['web'])

                ->prefix($adminPrefix)

                ->name('admin.')

                ->group(base_path('routes/admin.php'));

        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
