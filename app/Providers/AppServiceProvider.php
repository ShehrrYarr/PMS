<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Batch;
use App\Models\User;
use App\Observers\BatchObserver;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Notifications\ResetPassword;
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
