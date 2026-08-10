<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Derived explicitly from the authenticated user rather than relying
        // on ambient URL::defaults(['shop' => ...]) (set via the Authenticated
        // event in AppServiceProvider) — that mechanism doesn't fire under
        // Event::fake(), which this flow is commonly tested with.
        $dashboardUrl = route('dashboard', ['shop' => $request->user()->shop->slug]);

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($dashboardUrl.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended($dashboardUrl.'?verified=1');
    }
}
