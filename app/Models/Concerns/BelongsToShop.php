<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Applied to every tenant-scoped model. Two effects:
 *
 * 1. A global scope that narrows every query to the logged-in shop user's
 *    own shop_id. Only ever applies when there IS a logged-in web-guard
 *    user with a shop_id — it's a deliberate no-op for artisan commands,
 *    seeders, and tests that aren't acting as a user, since those need to
 *    see/create rows across shops explicitly rather than have data silently
 *    hidden from them.
 * 2. Auto-fills shop_id on create from that same user, unless the caller
 *    already set it explicitly (e.g. ShopService seeding a brand-new shop's
 *    settings rows before that shop has any logged-in user at all).
 *
 * The query-builder side is the real security boundary here: table-qualify
 * the column so this doesn't break on any query that joins another
 * shop-scoped table (which would otherwise throw an ambiguous-column error).
 */
trait BelongsToShop
{
    /**
     * Guards against infinite recursion: resolving the session's user
     * (Auth::guard('web')->user()) re-queries the User model, which carries
     * this very trait — so its own global scope would call back into
     * currentShopId() while the outer call is still resolving who the user
     * is. Real browser requests hit this on every session-based lookup;
     * Livewire::actingAs()/$this->actingAs() in tests inject the user
     * directly and never exercise this path, which is why it only surfaces
     * in live/manual verification, not the automated suite.
     */
    private static bool $resolvingShopId = false;

    protected static function bootBelongsToShop(): void
    {
        static::addGlobalScope('shop', function (Builder $builder) {
            $shopId = static::currentShopId();

            if ($shopId !== null) {
                $builder->where($builder->getModel()->getTable().'.shop_id', $shopId);
            }
        });

        static::creating(function (Model $model) {
            if ($model->shop_id === null) {
                $model->shop_id = static::currentShopId();
            }
        });
    }

    private static function currentShopId(): ?int
    {
        if (static::$resolvingShopId) {
            return null;
        }

        static::$resolvingShopId = true;

        try {
            $user = Auth::guard('web')->user();

            if ($user instanceof User) {
                return $user->shop_id;
            }

            // No logged-in user (e.g. a guest viewing their shop's own
            // /{shop}/login page) — fall back to whichever shop
            // ResolveShopFromSlug resolved from the URL, so guest-facing
            // pages still show the correct shop's own branding rather than
            // an arbitrary one.
            $shop = request()?->attributes->get('currentShop');

            return $shop instanceof Shop ? $shop->id : null;
        } finally {
            static::$resolvingShopId = false;
        }
    }
}
