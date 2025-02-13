<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // Route::middleware('api')->prefix('api')->group(base_path('routes/auth.php')); // register auth routes
            // Route::middleware('api')->prefix('api/freelancer')->group(base_path('routes/api_freelancer.php')); // register freelancer routes
            // Route::middleware('api')->prefix('customer')->group(base_path('routes/customer.php')); // register user routes
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\LanguageMiddleware::class,
        ]);
        // $middleware->trustHosts(at: ['https//artee.io']);
        $middleware->alias([
            'role' => RoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
