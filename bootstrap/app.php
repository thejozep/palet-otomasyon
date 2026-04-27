<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Bunu ekledik

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Admin middleware tanımın burada kalsın
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // GİRİŞ YAPANLARI YÖNLENDİRME
        $middleware->redirectUsersTo(function (Request $request) {
            return '/accountant'; // Giriş yapınca 404 veren /invoice yerine buraya gidecek
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();