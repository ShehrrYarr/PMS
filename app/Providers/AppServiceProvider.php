<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Batch;
use App\Models\User;
use App\Observers\BatchObserver;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Batch::observe(BatchObserver::class);

        // Laravel's route()/@vite-generated URLs already detect a subdirectory
        // install (e.g. APP_URL=http://host/pms) from the request automatically,
        // but a handful of framework/package URLs — notably Livewire's own
        // script tag — are built with a root-relative url('/path') call, which
        // Laravel treats as absolute from the true domain root and does NOT
        // subdirectory-prefix. Forcing the root URL from config keeps every URL
        // generator consistent regardless of which one a given package uses.
        // A no-op for a domain-root install where APP_URL has no path segment.
        URL::forceRootUrl(config('app.url'));

        // Livewire's own script tag carries a `data-update-uri` attribute its
        // JS runtime uses for every AJAX call — every wire:click, wire:submit,
        // wire:model.live. It's built via toRoute($route, [], absolute: false),
        // which (unlike the absolute form just above) does NOT include a
        // subdirectory install's base path: it's bare "/livewire/update",
        // which the browser then resolves against the domain root, missing
        // "/pms" entirely and 404ing. Livewire injects this by listening for
        // RequestHandled itself (not via an overridable Blade directive or
        // middleware — the response body doesn't have it yet by the time any
        // middleware's post-$next() code runs), so registering our own
        // RequestHandled listener — which Laravel calls after Livewire's,
        // since packages' service providers boot before the app's own — is
        // the only point the fully-assembled HTML is available to correct. A
        // no-op wherever APP_URL has no path segment (domain-root installs).
        Event::listen(function (RequestHandled $event) {
            $base = rtrim((string) parse_url((string) config('app.url'), PHP_URL_PATH), '/');

            if ($base === '' || ! str($event->response->headers->get('content-type'))->contains('text/html')) {
                return;
            }

            $content = $event->response->getContent();

            if ($content !== false && str_contains($content, 'data-update-uri="/livewire/')) {
                $event->response->setContent(str_replace(
                    'data-update-uri="/livewire/',
                    'data-update-uri="'.$base.'/livewire/',
                    $content,
                ));
            }
        });

        // Every shop-side route now carries a {shop} URL segment (see
        // routes/web.php). This keeps every existing route('vendors.index')-
        // style call throughout the app generating a correctly-prefixed URL
        // without touching each call site individually. Covers both real
        // requests (the 'web' guard resolving a session user) and tests,
        // since SessionGuard::setUser() — used by $this->actingAs() and
        // Livewire::actingAs() — fires this same event.
        Event::listen(function (Authenticated $event) {
            if ($event->guard === 'web' && $event->user instanceof User) {
                URL::defaults(['shop' => $event->user->shop->slug]);
            }
        });

        // The password-reset email link is generated for a specific user who
        // isn't authenticated (they've forgotten their password) and may not
        // be within an active shop-resolved request at all (e.g. queued) —
        // 'password.reset' deliberately stays outside the {shop} URL prefix,
        // so no shop parameter is needed here regardless.
        ResetPassword::createUrlUsing(fn ($notifiable, string $token) => URL::route('password.reset', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));
    }
}
