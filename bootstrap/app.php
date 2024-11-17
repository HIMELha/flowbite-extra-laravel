<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['role', Role::class]);
        $middleware->alias(['permission', Permission::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
