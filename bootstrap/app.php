<?php

use App\Http\Middleware\CorrelationIdMiddleware;
use App\Http\Middleware\MaintenanceModeMiddleware;
use App\Services\ApiResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Middleware\ThrottleRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend([
            CorrelationIdMiddleware::class,
            MaintenanceModeMiddleware::class,
            ThrottleRequests::class.':api'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Custom Exception for Rate Limit
        $exceptions->render(function(ThrottleRequestsException $e, $request){
            return ApiResponse::error('Too many requests', 429);
        });
        
    })->create();
