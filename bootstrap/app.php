<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Demo showcase: langsung masuk akun demo bila DEMO_AUTO_LOGIN=true.
        $middleware->appendToGroup('web', \App\Http\Middleware\AutoLoginDemo::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
