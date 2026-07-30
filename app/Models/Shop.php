<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * A tenant on the platform. Every business-data table (see BelongsToShop)
 * carries a shop_id and is scoped to exactly one Shop — this is the row
 * Super Admin creates via ShopService::createShop(). The slug is this
 * shop's own URL segment (e.g. /shop1/dashboard) — see routes/web.php's
 * {shop} prefix group and App\Http\Middleware\ResolveShopFromSlug.
 */
class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_demo' => 'boolean',
        ];
    }

    /**
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Derive a URL-safe, unique slug from a shop name — 'shop' as a
     * fallback base if the name slugifies to nothing (e.g. all emoji),
     * appending -2, -3, ... on collision. $ignoreShopId excludes the shop
     * being edited from its own collision check.
     */
    public static function uniqueSlug(string $name, ?int $ignoreShopId = null): string
    {
        $base = Str::slug($name);
        $base = $base !== '' ? $base : 'shop';

        $slug = $base;
        $suffix = 2;

        while (
            DB::table('shops')
                ->where('slug', $slug)
                ->when($ignoreShopId !== null, fn ($q) => $q->where('id', '!=', $ignoreShopId))
                ->exists()
        ) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
