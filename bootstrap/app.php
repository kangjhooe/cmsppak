<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
        // Register global middleware
        $middleware->append(\App\Http\Middleware\AdminActivityLogger::class);
        $middleware->append(\App\Http\Middleware\HandleNullCollections::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Shared hosting flatten: document root = project root (isi public/ dipindah ke root)
if (! is_file($app->basePath('public/index.php'))) {
    $app->usePublicPath($app->basePath());
}

return $app;
