<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\PosDevice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleSyncConflict;
use App\Models\User;
use App\Services\BarcodeService;
use App\Services\OfflineSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class OfflineSyncServiceTest extends TestCase
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

    private function makeBatch(string $quantity = '20'): Batch
    {
        $product = Product::factory()->create(['default_sale_price' => '800.00']);

        return app(BarcodeService::class)->createBatchWithBarcode([
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '400.00',
            'quantity_received' => $quantity,
            'quantity_remaining' => $quantity,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function queuedSale(Batch $batch, string $uuid, int $seq, string $occurredAt, string $quantity = '2', ?int $customerId = null, string $method = 'cash'): array
    {
        $amount = bcmul('800.00', $quantity, 2);

        return [
            'client_uuid' => $uuid,
            'occurred_at' => $occurredAt,
            'invoice_seq' => $seq,
            'customer_id' => $customerId,
            'items' => [
                ['batch_id' => $batch->id, 'quantity' => $quantity, 'unit_price' => '800.00'],
            ],
            'payment_lines' => [
                ['method' => $method, 'amount' => $amount, 'bank_id' => null],
            ],
        ];
    }

    public function test_a_queued_sale_replays_with_its_offline_invoice_number_and_original_date(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch('20');
        $occurredAt = Carbon::now()->subDays(2)->startOfHour();

        $results = app(OfflineSyncService::class)->syncSales(
            [$this->queuedSale($batch, (string) Str::uuid(), 1, $occurredAt->toIso8601String())],
            $user,
            $device,
        );

        $this->assertSame('synced', $results[0]['status']);

        $sale = Sale::query()->firstOrFail();
        $this->assertSame("SL-OFF{$device->id}-0001", $sale->invoice_number);
        $this->assertSame('1600.00', $sale->total_amount);
        $this->assertSame('18.00', $batch->fresh()->quantity_remaining);

        // The sale must carry the date it was actually rung up, not the date
        // it happened to sync — otherwise a whole offline day lands on the
        // wrong day's cash reconciliation.
        $this->assertSame($occurredAt->toDateTimeString(), $sale->created_at->toDateTimeString());
        $this->assertNotNull($sale->synced_at);
    }

    public function test_replaying_the_same_client_uuid_twice_does_not_duplicate_the_sale(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch('20');
        $uuid = (string) Str::uuid();
        $queued = [$this->queuedSale($batch, $uuid, 1, Carbon::now()->toIso8601String())];

        app(OfflineSyncService::class)->syncSales($queued, $user, $device);
        $second = app(OfflineSyncService::class)->syncSales($queued, $user, $device->fresh());

        $this->assertSame('duplicate', $second[0]['status']);
        $this->assertSame(1, Sale::query()->count());
        // Stock must only be decremented once.
        $this->assertSame('18.00', $batch->fresh()->quantity_remaining);
    }

    public function test_an_overdrawn_sale_is_still_created_and_raises_a_conflict(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch('3');

        // The till thought it had stock; someone else sold it meanwhile.
        $results = app(OfflineSyncService::class)->syncSales(
            [$this->queuedSale($batch, (string) Str::uuid(), 1, Carbon::now()->toIso8601String(), '5')],
            $user,
            $device,
        );

        $this->assertSame('synced', $results[0]['status']);
        $this->assertTrue($results[0]['had_conflict']);

        $this->assertSame(1, Sale::query()->count());
        $this->assertSame('-2.00', $batch->fresh()->quantity_remaining);

        $conflict = SaleSyncConflict::query()->firstOrFail();
        $this->assertSame('5.00', $conflict->requested_quantity);
        $this->assertSame('3.00', $conflict->available_quantity);
        $this->assertSame('2.00', $conflict->shortfall);
        $this->assertNull($conflict->resolved_at);
    }

    public function test_a_stale_invoice_sequence_is_renumbered_instead_of_colliding(): void
    {
        $user = $this->salesman();
        // Device has already used sequence 5 — e.g. the browser's storage was
        // cleared and its local counter restarted at 1.
        $device = $this->device($user, lastSeq: 5);
        $batch = $this->makeBatch('20');

        $results = app(OfflineSyncService::class)->syncSales(
            [$this->queuedSale($batch, (string) Str::uuid(), 1, Carbon::now()->toIso8601String())],
            $user,
            $device,
        );

        $this->assertSame('synced', $results[0]['status']);
        $this->assertSame("SL-OFF{$device->id}-0006", $results[0]['invoice_number']);
        $this->assertSame(6, $device->fresh()->last_invoice_seq);
    }

    public function test_several_offline_credit_sales_chain_the_running_balance_correctly(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $customer = Customer::factory()->create();
        $batch = $this->makeBatch('20');
        $now = Carbon::now();

        // Deliberately queued out of order — the service must replay them by
        // occurred_at so the statement reads chronologically.
        $results = app(OfflineSyncService::class)->syncSales([
            $this->queuedSale($batch, (string) Str::uuid(), 2, $now->copy()->subHour()->toIso8601String(), '2', $customer->id, 'ledger'),
            $this->queuedSale($batch, (string) Str::uuid(), 1, $now->copy()->subHours(3)->toIso8601String(), '1', $customer->id, 'ledger'),
            $this->queuedSale($batch, (string) Str::uuid(), 3, $now->copy()->subMinutes(10)->toIso8601String(), '3', $customer->id, 'ledger'),
        ], $user, $device);

        foreach ($results as $result) {
            $this->assertSame('synced', $result['status']);
        }

        // 1*800 then 2*800 then 3*800 = 800, 2400, 4800 cumulative.
        $balances = CustomerLedger::query()
            ->where('customer_id', $customer->id)
            ->orderBy('id')
            ->pluck('running_balance')
            ->all();

        $this->assertSame(['800.00', '2400.00', '4800.00'], $balances);
        $this->assertSame('4800.00', $customer->currentBalance());
    }

    public function test_a_rejected_sale_does_not_strand_the_rest_of_the_queue(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch('20');

        $bad = $this->queuedSale($batch, (string) Str::uuid(), 1, Carbon::now()->toIso8601String());
        // Payment no longer matches the line total — unbalanced split.
        $bad['payment_lines'][0]['amount'] = '10.00';

        $results = app(OfflineSyncService::class)->syncSales([
            $bad,
            $this->queuedSale($batch, (string) Str::uuid(), 2, Carbon::now()->toIso8601String()),
        ], $user, $device);

        $statuses = array_column($results, 'status');
        sort($statuses);

        $this->assertSame(['rejected', 'synced'], $statuses);
        $this->assertSame(1, Sale::query()->count());
    }

    public function test_the_online_sale_path_still_rejects_overselling(): void
    {
        // Guards against allowOverdraw ever leaking into normal checkout.
        $user = $this->salesman();
        $batch = $this->makeBatch('3');

        $this->expectException(\App\Exceptions\InsufficientStockException::class);

        app(\App\Services\SaleService::class)->create(
            customer: null,
            items: [['batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '800.00']],
            paymentLines: [['method' => 'cash', 'amount' => '4000.00', 'bank_id' => null]],
            user: $user,
        );
    }

    public function test_overdraw_does_not_disable_the_quantity_and_price_guards(): void
    {
        // allowOverdraw must skip ONLY the stock check — a tampered offline
        // queue still cannot write a negative quantity.
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch('20');

        $tampered = $this->queuedSale($batch, (string) Str::uuid(), 1, Carbon::now()->toIso8601String());
        $tampered['items'][0]['quantity'] = '-5';
        $tampered['payment_lines'][0]['amount'] = '4000.00';

        $results = app(OfflineSyncService::class)->syncSales([$tampered], $user, $device);

        $this->assertSame('rejected', $results[0]['status']);
        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_a_queued_sale_carrying_a_per_item_and_sale_level_discount_replays_correctly(): void
    {
        $user = $this->salesman();
        $device = $this->device($user);
        $batch = $this->makeBatch('20');

        // Line: 2 x 800.00 = 1600.00, minus a flat 100.00 item discount = 1500.00.
        // Sale-level 10% then takes 150.00 off, leaving 1350.00.
        $queued = [[
            'client_uuid' => (string) Str::uuid(),
            'occurred_at' => Carbon::now()->toIso8601String(),
            'invoice_seq' => 1,
            'customer_id' => null,
            'items' => [[
                'batch_id' => $batch->id,
                'quantity' => '2',
                'unit_price' => '800.00',
                'discount_type' => 'flat',
                'discount_value' => '100.00',
            ]],
            'payment_lines' => [['method' => 'cash', 'amount' => '1350.00', 'bank_id' => null]],
            'discount_type' => 'percentage',
            'discount_value' => '10',
        ]];

        $results = app(OfflineSyncService::class)->syncSales($queued, $user, $device);

        $this->assertSame('synced', $results[0]['status'], $results[0]['message'] ?? '');
        $sale = Sale::query()->firstOrFail();
        $this->assertSame('1350.00', $sale->total_amount);
        $this->assertSame('150.00', $sale->discount_amount);
    }
}
