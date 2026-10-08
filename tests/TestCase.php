<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * DatabaseSeeder flags its "Demo Shop" as the public demo, where shop
     * setup is read-only (LocksDemoShopSetup) — and factory users land in
     * that first shop. Tests run in an ordinary shop unless they opt in by
     * flagging one themselves, as the demo tests do.
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (isset(class_uses_recursive(static::class)[RefreshDatabase::class])) {
            Shop::query()->where('is_demo', true)->update(['is_demo' => false]);
        }
    }

    /**
     * Every layout in this app reads theme_settings/receipt_settings (see
     * ThemeSetting::current()), which throws ModelNotFoundException — and
     * therefore renders as a 404 — if the row doesn't exist. Auto-seed so
     * RefreshDatabase tests get a working app, not just an empty schema.
     */
    protected $seed = true;

    /**
     * Every shop route now lives under /{shop-slug}/... — build a path
     * within the given user's own shop instead of hardcoding a bare path.
     */
    protected function shopPath(User $user, string $path = ''): string
    {
        return '/'.$user->shop->slug.($path !== '' ? '/'.ltrim($path, '/') : '');
    }
}
