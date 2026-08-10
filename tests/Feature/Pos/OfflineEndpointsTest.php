<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Models\Batch;
use App\Models\PosDevice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class OfflineEndpointsTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole(UserRole $role): User
    {
        $user = User::factory()->create();
        $user->assignRole($role->value);

        return $user;
    }

    private function makeBatch(User $user, string $quantity = '20'): Batch
    {
        $product = Product::factory()->create([
            'shop_id' => $user->shop_id,
            'default_sale_price' => '800.00',
        ]);

        return app(BarcodeService::class)->createBatchWithBarcode([
            'shop_id' => $user->shop_id,
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '400.00',
            'quantity_received' => $quantity,
            'quantity_remaining' => $quantity,
        ]);
    }

    public function test_offline_data_registers_a_device_and_returns_the_snapshot(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);
        $batch = $this->makeBatch($user);

        $response = $this->actingAs($user)
            ->getJson($this->shopPath($user, 'pos/offline-data'));

        $response->assertOk();
        $response->assertJsonStructure([
            'generated_at',
            'device' => ['id', 'next_invoice_seq', 'invoice_prefix'],
            'user' => ['id', 'name'],
            'batches',
            'customers',
            'banks',
            'settings' => ['shop_name', 'receipt' => ['paper_width']],
        ]);

        $this->assertSame(1, PosDevice::query()->count());
        $this->assertSame(1, $response->json('device.next_invoice_seq'));
        $this->assertSame($batch->barcode, $response->json('batches.0.barcode'));
    }

    public function test_offline_data_reuses_a_known_device_rather_than_registering_a_second(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);
        $this->makeBatch($user);

        $first = $this->actingAs($user)->getJson($this->shopPath($user, 'pos/offline-data'));
        $deviceId = $first->json('device.id');

        $this->actingAs($user)
            ->getJson($this->shopPath($user, 'pos/offline-data?device_id='.$deviceId))
            ->assertOk()
            ->assertJsonPath('device.id', $deviceId);

        $this->assertSame(1, PosDevice::query()->count());
    }

    public function test_a_device_id_from_another_shop_is_not_honoured(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);
        $otherShopUser = $this->userWithRole(UserRole::Salesman);
        $otherShopUser->forceFill(['shop_id' => \App\Models\Shop::factory()->create()->id])->save();

        $foreignDevice = PosDevice::query()->create([
            'shop_id' => $otherShopUser->shop_id,
            'user_id' => $otherShopUser->id,
            'last_invoice_seq' => 40,
        ]);

        $response = $this->actingAs($user)
            ->getJson($this->shopPath($user, 'pos/offline-data?device_id='.$foreignDevice->id));

        $response->assertOk();
        // A fresh device is registered instead of handing over another
        // tenant's invoice sequence.
        $this->assertNotSame($foreignDevice->id, $response->json('device.id'));
        $this->assertSame(1, $response->json('device.next_invoice_seq'));
    }

    public function test_ping_returns_a_fresh_csrf_token(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($user)
            ->getJson($this->shopPath($user, 'pos/ping'))
            ->assertOk()
            ->assertJsonPath('ok', true)
            ->assertJsonPath('authenticated', true)
            ->assertJsonStructure(['csrf', 'server_time', 'user_id']);
    }

    public function test_sync_creates_the_queued_sale_and_acknowledges_it_by_uuid(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);
        $batch = $this->makeBatch($user);
        $device = PosDevice::query()->create(['shop_id' => $user->shop_id, 'user_id' => $user->id]);
        $uuid = (string) Str::uuid();

        $response = $this->actingAs($user)->postJson($this->shopPath($user, 'pos/sync'), [
            'device_id' => $device->id,
            'sales' => [[
                'client_uuid' => $uuid,
                'occurred_at' => Carbon::now()->subHour()->toIso8601String(),
                'invoice_seq' => 1,
                'customer_id' => null,
                'items' => [['batch_id' => $batch->id, 'quantity' => '2', 'unit_price' => '800.00']],
                'payment_lines' => [['method' => 'cash', 'amount' => '1600.00', 'bank_id' => null]],
            ]],
            'held_orders' => [],
        ]);

        $response->assertOk();
        $response->assertJsonPath('ok', true);
        $response->assertJsonPath('results.0.client_uuid', $uuid);
        $response->assertJsonPath('results.0.status', 'synced');
        $response->assertJsonPath('next_invoice_seq', 2);

        $this->assertSame(1, Sale::query()->where('client_uuid', $uuid)->count());
    }

    public function test_sync_rejects_a_device_belonging_to_another_shop(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);
        $otherShop = \App\Models\Shop::factory()->create();
        $foreignDevice = PosDevice::query()->create([
            'shop_id' => $otherShop->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)->postJson($this->shopPath($user, 'pos/sync'), [
            'device_id' => $foreignDevice->id,
            'sales' => [],
            'held_orders' => [],
        ])->assertNotFound();
    }

    public function test_an_unauthenticated_sync_returns_json_not_a_redirect_to_login(): void
    {
        // The single most important guarantee here: fetch() follows redirects
        // silently, so a 302 would reach the till looking like a successful
        // 200 and could cause it to clear a queue of real sales.
        $user = $this->userWithRole(UserRole::Salesman);

        $response = $this->postJson($this->shopPath($user, 'pos/sync'), [
            'device_id' => 1,
            'sales' => [],
            'held_orders' => [],
        ]);

        $response->assertUnauthorized();
        $this->assertStringContainsString('application/json', (string) $response->headers->get('content-type'));
    }

    public function test_a_suspended_shop_returns_json_not_a_redirect(): void
    {
        $user = $this->userWithRole(UserRole::Salesman);
        $device = PosDevice::query()->create(['shop_id' => $user->shop_id, 'user_id' => $user->id]);

        $user->shop->forceFill(['is_active' => false])->save();

        $response = $this->actingAs($user)->postJson($this->shopPath($user, 'pos/sync'), [
            'device_id' => $device->id,
            'sales' => [],
            'held_orders' => [],
        ]);

        $response->assertForbidden();
        $this->assertStringContainsString('application/json', (string) $response->headers->get('content-type'));
    }

    public function test_roles_without_sales_manage_cannot_reach_the_offline_endpoints(): void
    {
        foreach ([UserRole::InventoryManager, UserRole::Accountant] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)->getJson($this->shopPath($user, 'pos/ping'))->assertForbidden();
            $this->actingAs($user)->getJson($this->shopPath($user, 'pos/offline-data'))->assertForbidden();
            $this->actingAs($user)->postJson($this->shopPath($user, 'pos/sync'), [
                'device_id' => 1, 'sales' => [], 'held_orders' => [],
            ])->assertForbidden();
        }
    }

    public function test_admin_and_salesman_can_reach_the_offline_endpoints(): void
    {
        foreach ([UserRole::Admin, UserRole::Salesman] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)->getJson($this->shopPath($user, 'pos/ping'))->assertOk();
            $this->actingAs($user)->getJson($this->shopPath($user, 'pos/offline-data'))->assertOk();
        }
    }
}
