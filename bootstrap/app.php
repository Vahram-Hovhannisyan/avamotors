<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Регистрируем алиасы для middleware
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'setlocale' => \App\Http\Middleware\SetLocale::class, // Добавляем алиас
        ]);

        // Добавляем SetLocale в группу web middleware (в конец массива)
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // Исключения для CSRF
        $middleware->validateCsrfTokens(except: [
            '/register',
            '/login',
            '/forgot-password',
            '/reset-password',
            '/email/verification-notification',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
