<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Models\Batch;
use App\Models\HeldOrder;
use App\Models\Payment;
use App\Models\PosDevice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Services\BarcodeService;
use App\Services\OfflineDataService;
use App\Services\OfflineSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Locks in the fixes from the offline POS bug hunt. Each test names the defect
 * it prevents from coming back.
 */
class OfflineSyncRegressionTest extends TestCase
{
    use RefreshDatabase;

    private function salesman(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Salesman->value);

        return $user;
    }

    private function device(User $user, int $lastSeq = 0): PosDevice
    {
        return PosDevice::query()->create([
            'shop_id' => $user->shop_id,
            'user_id' => $user->id,
            'last_invoice_seq' => $lastSeq,
        ]);
    }

    private function makeBatch(User $user, string $quantity = '50', string $price = '333.33'): Batch
    {
        $product = Product::factory()->create([
            'shop_id' => $user->shop_id,
            'default_sale_price' => $price,
        ]);

        return app(BarcodeService::class)->createBatchWithBarcode([
            'shop_id' => $user->shop_id,
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '100.00',
            'quantity_received' => $quantity,
            'quantity_remaining' => $quantity,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function queuedSale(Batch $batch, string $quantity, string $unitPrice, string $amount, int $seq, ?string $occurredAt = null): array
    {
        return [
            'client_uuid' => (string) Str::uuid(),
            'occurred_at' => $occurredAt ?? Carbon::now()->toIso8601String(),
            'invoice_seq' => $seq,
            'customer_id' => null,
            'items' => [['batch_id' => $batch->id, 'quantity' => $quantity, 'unit_price' => $unitPrice]],
            'payment_lines' => [['method' => 'cash', 'amount' => $amount, 'bank_id' => null]],
        ];
    }

    /**
     * The client used to round where bcmul truncates, so a fractional quantity
     * produced a total one paisa above the server's and the sale was rejected
     * as unbalanced after the customer had paid.
     */
    public function test_a_fractional_quantity_sale_balances_and_is_accepted(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch($user, '50', '333.33');

        // 333.33 x 1.5 truncates to 499.99 — the value the fixed client sends.
        $results = app(OfflineSyncService::class)->syncSales(
            [$this->queuedSale($batch, '1.5', '333.33', '499.99', 1)],
            $user,
            $device,
        );

        $this->assertSame('synced', $results[0]['status'], $results[0]['message'] ?? '');
        $this->assertSame('499.99', Sale::query()->firstOrFail()->total_amount);
    }

    /**
     * A till that replays a stale sequence must be renumbered rather than
     * colliding on the unique invoice index.
     */
    public function test_a_stale_sequence_is_renumbered_and_the_device_counter_advances(): void
    {
        $user = $this->salesman();
        $device = $this->device($user, lastSeq: 9);
        $batch = $this->makeBatch($user);

        $results = app(OfflineSyncService::class)->syncSales(
            [$this->queuedSale($batch, '1', '333.33', '333.33', 3)],
            $user,
            $device,
        );

        $this->assertSame("SL-OFF{$device->id}-0010", $results[0]['invoice_number']);
        $this->assertSame(10, $device->fresh()->last_invoice_seq);
    }

    /**
     * The idempotency check now sits inside the transaction, and a lost race
     * reports 'duplicate' rather than leaking a raw SQL constraint message.
     */
    public function test_replaying_the_same_sale_reports_duplicate_without_leaking_sql(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch($user);
        $queued = [$this->queuedSale($batch, '2', '333.33', '666.66', 1)];

        app(OfflineSyncService::class)->syncSales($queued, $user, $device);
        $second = app(OfflineSyncService::class)->syncSales($queued, $user, $device->fresh());

        $this->assertSame('duplicate', $second[0]['status']);
        $this->assertSame(1, Sale::query()->count());
        $this->assertArrayNotHasKey('message', $second[0]);
    }

    /**
     * An unexpected failure must not hand the cashier a raw exception string.
     */
    public function test_an_unexpected_failure_returns_a_human_message(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);

        // Batch id that doesn't exist — findOrFail inside SaleService throws a
        // ModelNotFoundException, which is not one of our domain exceptions.
        $queued = [[
            'client_uuid' => (string) Str::uuid(),
            'occurred_at' => Carbon::now()->toIso8601String(),
            'invoice_seq' => 1,
            'customer_id' => null,
            'items' => [['batch_id' => 999999, 'quantity' => '1', 'unit_price' => '10.00']],
            'payment_lines' => [['method' => 'cash', 'amount' => '10.00', 'bank_id' => null]],
        ]];

        $results = app(OfflineSyncService::class)->syncSales($queued, $user, $device);

        $this->assertSame('rejected', $results[0]['status']);
        $this->assertSame(__('sync.replay_failed'), $results[0]['message']);
        $this->assertStringNotContainsString('SQLSTATE', $results[0]['message']);
    }

    /**
     * Payments and line items used to keep the sync timestamp, so a week of
     * offline cash landed on the wrong day of the dashboard.
     */
    public function test_payments_and_items_carry_the_original_sale_date(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch($user);
        $occurredAt = Carbon::now()->subDays(3)->startOfHour();

        app(OfflineSyncService::class)->syncSales(
            [$this->queuedSale($batch, '1', '333.33', '333.33', 1, $occurredAt->toIso8601String())],
            $user,
            $device,
        );

        $sale = Sale::query()->firstOrFail();

        $this->assertSame($occurredAt->toDateTimeString(), $sale->created_at->toDateTimeString());
        $this->assertSame(
            $occurredAt->toDateTimeString(),
            SaleItem::query()->firstOrFail()->created_at->toDateTimeString(),
        );
        $this->assertSame(
            $occurredAt->toDateTimeString(),
            Payment::query()->firstOrFail()->created_at->toDateTimeString(),
        );
    }

    /**
     * A held order resumed or discarded offline must not come back from the
     * server on the next sync, or it could be sold a second time.
     */
    public function test_held_orders_missing_from_the_till_are_deleted_not_resurrected(): void
    {
        $user = $this->salesman();

        HeldOrder::query()->create([
            'shop_id' => $user->shop_id,
            'user_id' => $user->id,
            'client_uuid' => (string) Str::uuid(),
            'label' => 'Sold offline already',
            'payload' => ['cart' => [], 'customer_id' => null],
        ]);

        $keptUuid = (string) Str::uuid();

        $returned = app(OfflineSyncService::class)->syncHeldOrders([
            ['client_uuid' => $keptUuid, 'label' => 'Still parked', 'payload' => ['cart' => [], 'customer_id' => null]],
        ], $user);

        $this->assertCount(1, $returned);
        $this->assertSame($keptUuid, $returned[0]['client_uuid']);
        $this->assertSame(1, HeldOrder::query()->count());
    }

    /**
     * Another cashier's held orders are never touched by this user's sync.
     */
    public function test_syncing_held_orders_does_not_delete_another_cashiers(): void
    {
        $user = $this->salesman();
        $other = $this->salesman();

        HeldOrder::query()->create([
            'shop_id' => $other->shop_id,
            'user_id' => $other->id,
            'client_uuid' => (string) Str::uuid(),
            'payload' => ['cart' => [], 'customer_id' => null],
        ]);

        app(OfflineSyncService::class)->syncHeldOrders([], $user);

        $this->assertSame(1, HeldOrder::query()->where('user_id', $other->id)->count());
    }

    /**
     * The snapshot must carry the shop's branding, since the offline page
     * can't include the shared head partial that normally injects it.
     */
    public function test_the_snapshot_includes_theme_colours_and_font_size(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);

        $theme = \App\Models\ThemeSetting::current();
        $theme->forceFill(['navbar_primary_color' => '#1e5f8c', 'font_size_percent' => 130])->save();

        $snapshot = app(OfflineDataService::class)->snapshotFor($user, $device);

        $this->assertSame('#1e5f8c', $snapshot['settings']['theme']['navbar_primary_color']);
        $this->assertSame(130, $snapshot['settings']['theme']['font_size_percent']);
    }

    /**
     * Customer balances are now one query, not one per customer.
     */
    public function test_customer_balances_do_not_issue_a_query_per_customer(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);

        \App\Models\Customer::factory()->count(12)->create(['shop_id' => $user->shop_id]);

        DB::enableQueryLog();
        app(OfflineDataService::class)->snapshotFor($user, $device);
        $queries = count(DB::getQueryLog());
        DB::disableQueryLog();

        // Comfortably under 12; the old N+1 alone would have added 12 more.
        $this->assertLessThan(12, $queries, "Snapshot ran {$queries} queries — the N+1 may be back.");
    }
}
