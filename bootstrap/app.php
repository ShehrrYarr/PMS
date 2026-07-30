<?php

use App\Http\Middleware\EnsureShopIsActive;
use App\Http\Middleware\ResolveShopFromSlug;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // super_admin.php and auth.php are require'd directly from inside
        // web.php (before its {shop} prefix group), not registered via a
        // separate then: callback — that callback runs strictly AFTER the
        // whole web.php file loads, and the bare /{shop} route (needed for
        // e.g. http://.../shop1 to work on its own) is a single-segment
        // wildcard that would otherwise swallow every literal single-segment
        // route registered afterwards (/control-panel, /confirm-password,
        // /forgot-password, ...), since Laravel matches routes in
        // registration order.
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [SetLocale::class]);

        $middleware->alias([
            'shop.active' => EnsureShopIsActive::class,
            'shop.context' => ResolveShopFromSlug::class,
        ]);

        // Two separate login screens live behind two separate guards — send
        // each guard's unauthenticated/already-authenticated requests to its
        // own screen instead of Laravel's single default ('login' route).
        // 'login'/'dashboard' both require a {shop} route parameter now — read
        // directly off the matched route (available as soon as routing itself
        // resolves the URI, regardless of which middleware in the stack is
        // currently running or failing) rather than a request attribute our
        // own middleware sets, which is a step less reliable here. The
        // handful of unprefixed auth-utility routes (verify-email,
        // confirm-password) have no {shop} segment at all, so this falls
        // back to the bare landing page for those instead of crashing on a
        // missing route parameter.
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->routeIs('control-panel.*')) {
                return route('control-panel.login');
            }

            $shopSlug = $request->route('shop');

            return $shopSlug !== null ? route('login', ['shop' => $shopSlug]) : url('/');
        });

        $middleware->redirectUsersTo(function ($request) {
            if ($request->routeIs('control-panel.*')) {
                return route('control-panel.index');
            }

            $shopSlug = $request->route('shop');

            return $shopSlug !== null ? route('dashboard', ['shop' => $shopSlug]) : url('/');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
