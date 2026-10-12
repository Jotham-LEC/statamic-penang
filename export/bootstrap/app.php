<?php

use App\Providers\PenangServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // Penang's additions to Statamic (the words of a page's sections, for search).
    ->withProviders([PenangServiceProvider::class])
    ->withMiddleware(function (Middleware $middleware): void {
        // The theme switcher's choices, written by its script in the browser
        // (resources/js/site.js) and checked before use (App\Theme\SiteTheme).
        $middleware->encryptCookies(except: ['penang_theme']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
