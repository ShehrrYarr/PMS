<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserRole;
use App\Models\ReceiptSetting;
use App\Models\Shop;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Only the Super Admin panel calls this — a brand-new shop has no logged-in
 * web-guard user yet, so every row below sets shop_id explicitly rather than
 * relying on BelongsToShop's auth-based auto-fill.
 */
class ShopService
{
    /**
     * @return array{shop: Shop, admin: User, temporaryPassword: string}
     */
    public function createShop(string $name, string $adminName, string $adminEmail): array
    {
        return DB::transaction(function () use ($name, $adminName, $adminEmail) {
            $shop = Shop::query()->create([
                'name' => $name,
                'slug' => Shop::uniqueSlug($name),
                'is_active' => true,
            ]);

            ThemeSetting::query()->create([
                'shop_id' => $shop->id,
                'logo_path' => null,
                'shop_name' => null,
                'navbar_primary_color' => '#2f6f4f',
                'navbar_accent_color' => '#e8f5ee',
                'sidebar_primary_color' => '#1f4d38',
                'sidebar_accent_color' => '#eaf6f0',
                'sidebar_gradient_from' => '#1f4d38',
                'sidebar_gradient_to' => '#1f4d38',
                'default_locale' => 'en',
                'font_size_percent' => 100,
            ]);

            ReceiptSetting::query()->create([
                'shop_id' => $shop->id,
                'header_text' => null,
                'footer_text' => 'Thank you for your business!',
                'show_logo' => true,
                'paper_width' => '80mm',
            ]);

            $temporaryPassword = Str::password(12);

            $admin = User::query()->create([
                'shop_id' => $shop->id,
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => $temporaryPassword,
                'is_active' => true,
            ]);

            // Not in User::$fillable (email_verified_at is otherwise system-
            // managed) — there's no mailer configured for this app, so a
            // Super-Admin-created shop's first login must not be blocked on
            // verifying an email nothing was ever sent to.
            $admin->forceFill(['email_verified_at' => now()])->save();

            $admin->assignRole(UserRole::Admin->value);

            return [
                'shop' => $shop,
                'admin' => $admin,
                'temporaryPassword' => $temporaryPassword,
            ];
        });
    }

    public function updateShop(Shop $shop, string $name, string $slug): Shop
    {
        $shop->update([
            'name' => $name,
            'slug' => $slug,
        ]);

        return $shop;
    }

    /**
     * Resets the password for a shop's Admin-role user (the oldest one, if
     * there happens to be more than one) — the secure equivalent of "Super
     * Admin can see a shop's password": passwords are one-way hashed and
     * genuinely unrecoverable, so the only legitimate way to help a locked-
     * out shop back in is to issue a fresh one, shown once, exactly like at
     * shop-creation time.
     *
     * @return array{admin: User, temporaryPassword: string}
     */
    public function resetAdminPassword(Shop $shop): array
    {
        $admin = User::query()
            ->withoutGlobalScope('shop')
            ->where('shop_id', $shop->id)
            ->role(UserRole::Admin->value)
            ->oldest('id')
            ->firstOrFail();

        $temporaryPassword = Str::password(12);

        $admin->update(['password' => $temporaryPassword]);

        return [
            'admin' => $admin,
            'temporaryPassword' => $temporaryPassword,
        ];
    }
}
