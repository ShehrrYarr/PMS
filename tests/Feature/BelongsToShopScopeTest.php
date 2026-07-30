<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Verifies the core tenancy mechanism (see app/Models/Concerns/BelongsToShop.php):
 * a global scope hides other shops' rows, and creates auto-fill shop_id from
 * the acting web-guard user.
 */
class BelongsToShopScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_shops_data_is_invisible_to_another_shops_user(): void
    {
        $shopA = Shop::factory()->create();
        $shopB = Shop::factory()->create();

        $userA = User::factory()->create(['shop_id' => $shopA->id]);
        $userB = User::factory()->create(['shop_id' => $shopB->id]);

        $vendorA = Vendor::factory()->create(['shop_id' => $shopA->id, 'name' => 'Vendor A']);
        $vendorB = Vendor::factory()->create(['shop_id' => $shopB->id, 'name' => 'Vendor B']);

        $this->actingAs($userA);
        $this->assertSame(['Vendor A'], Vendor::query()->pluck('name')->all());

        $this->actingAs($userB);
        $this->assertSame(['Vendor B'], Vendor::query()->pluck('name')->all());

        $this->assertNotNull(Vendor::withoutGlobalScopes()->find($vendorA->id));
        $this->assertNotNull(Vendor::withoutGlobalScopes()->find($vendorB->id));
    }

    public function test_creating_without_an_explicit_shop_id_auto_fills_from_the_acting_user(): void
    {
        $shop = Shop::factory()->create();
        $user = User::factory()->create(['shop_id' => $shop->id]);

        $this->actingAs($user);

        $vendor = Vendor::query()->create(['name' => 'Auto Filled Vendor']);

        $this->assertSame($shop->id, $vendor->shop_id);
    }

    public function test_an_explicit_shop_id_is_not_overridden_by_the_acting_user(): void
    {
        $shopA = Shop::factory()->create();
        $shopB = Shop::factory()->create();
        $userA = User::factory()->create(['shop_id' => $shopA->id]);

        $this->actingAs($userA);

        $vendor = Vendor::query()->create(['name' => 'Explicit Shop Vendor', 'shop_id' => $shopB->id]);

        $this->assertSame($shopB->id, $vendor->shop_id);
    }

    public function test_creating_without_any_acting_user_requires_an_explicit_shop_id(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Vendor::query()->create(['name' => 'No Auth No Shop']);
    }
}
