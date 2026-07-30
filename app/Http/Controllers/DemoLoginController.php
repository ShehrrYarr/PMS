<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * The landing page's "See Demo" button — one click into a shared, always-on
 * demo tenant as its Admin, no credentials shown or typed. There is
 * intentionally no password/CSRF gate here: this is the public entry point,
 * equivalent in spirit to a signed emailed link. The demo shop's data is
 * expected to be reset on a schedule (see DemoShopResetService) rather than
 * protected from writes, so this controller doesn't need to care what a
 * visitor does with the session.
 */
class DemoLoginController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $shop = Shop::query()->where('is_demo', true)->where('is_active', true)->first();

        if ($shop === null) {
            abort(404);
        }

        $admin = User::query()
            ->where('shop_id', $shop->id)
            ->role(UserRole::Admin->value)
            ->oldest('id')
            ->firstOrFail();

        Auth::guard('web')->login($admin);

        return redirect()->route('dashboard', ['shop' => $shop->slug]);
    }
}
