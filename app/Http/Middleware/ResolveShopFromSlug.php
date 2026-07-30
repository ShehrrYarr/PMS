<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resolves the {shop} URL segment (e.g. /shop1/dashboard) into a Shop —
 * manually, not via Eloquent route-model binding, since most routes in this
 * group target Livewire component classes rather than closures/controllers
 * with a typed Shop $shop parameter.
 *
 * Sets URL::defaults(['shop' => ...]) so every existing route('vendors.index')-
 * style call across the app's sidebar/nav/redirects keeps generating a
 * correctly-prefixed URL without being touched individually (see the
 * Authenticated event listener in AppServiceProvider for the equivalent
 * mechanism covering requests that never go through this middleware, e.g.
 * Livewire::test()).
 *
 * A logged-in user hitting a URL for a DIFFERENT shop than their own is a
 * hard 403 — never silently redirected, since that would blur the boundary
 * this whole feature exists to draw.
 */
class ResolveShopFromSlug
{
    public function handle(Request $request, Closure $next): Response
    {
        $shop = Shop::query()->where('slug', $request->route('shop'))->first();

        if ($shop === null) {
            abort(404);
        }

        $request->attributes->set('currentShop', $shop);
        URL::defaults(['shop' => $shop->slug]);

        $user = Auth::guard('web')->user();

        if ($user !== null && $user->shop_id !== $shop->id) {
            abort(403);
        }

        return $next($request);
    }
}
