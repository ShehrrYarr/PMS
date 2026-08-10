<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Suspending a shop from the Super Admin panel should take effect
 * immediately, not just block the next login — this middleware kicks an
 * already-logged-in user out mid-session the moment their shop is inactive.
 */
class EnsureShopIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user();

        if ($user !== null && ! $user->shop->is_active) {
            $shopSlug = $user->shop->slug;

            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // A redirect is right for a browser, but wrong for the offline
            // POS's JSON calls: fetch() follows redirects transparently, so a
            // 302 would reach the till as a 200 and could be mistaken for a
            // successful sync — clearing real queued sales. Answer those with
            // a status code that can't be misread.
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => __('auth.shop_suspended'),
                ], Response::HTTP_FORBIDDEN);
            }

            return redirect()->route('login', ['shop' => $shopSlug])->withErrors([
                'form.email' => __('auth.shop_suspended'),
            ]);
        }

        return $next($request);
    }
}
