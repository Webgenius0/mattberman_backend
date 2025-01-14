<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::prefix('')
                ->middleware(['web'])
                ->name('')
                ->group(base_path('routes/frontend.php'));


            Route::prefix('')
                ->middleware(['web'])
                ->name('')
                ->group(base_path('routes/backend.php'));



            //admin-Dashboard
            // Route::prefix('admin')
            //     ->middleware(['web','auth', 'admin'])
            //     ->name('')
            //     ->group(base_path('routes/backend.php'));



            //User-Profile

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
