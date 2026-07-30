<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Exceptions\UnbalancedPaymentSplitException;
use App\Models\Bank;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\User;
use App\Models\Vendor;
use App\Services\PurchaseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_writes_items_batches_payments_and_a_ledger_entry_atomically(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $bank = Bank::query()->create(['name' => 'Test Bank', 'is_active' => true]);

        $purchase = app(PurchaseService::class)->create(
            vendor: $vendor,
            items: [[
                'product_id' => $product->id,
                'manufacturing_date' => '2026-01-01',
                'expiry_date' => '2027-01-01',
                'cost_price' => '400.00',
                'quantity' => '10',
            ]],
            paymentLines: [
                ['method' => 'cash', 'amount' => '1500.00', 'bank_id' => null],
                ['method' => 'bank', 'amount' => '1000.00', 'bank_id' => $bank->id],
                ['method' => 'ledger', 'amount' => '1500.00', 'bank_id' => null],
            ],
            user: $user,
        );

        $this->assertSame('4000.00', $purchase->total_amount);
        $this->assertSame(1, PurchaseItem::query()->count());
        $this->assertSame(1, Batch::query()->count());
        $this->assertSame(3, Payment::query()->where('payable_id', $purchase->id)->count());

        // Only the ledger-method portion should be posted to the vendor's ledger.
        $this->assertSame('1500.00', $vendor->currentBalance());

        $batch = Batch::query()->first();
        $this->assertSame('10.00', $batch->quantity_remaining);
        $this->assertNotEmpty($batch->barcode);
    }

    public function test_a_manually_entered_barcode_is_used_for_the_batch(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $product = Product::factory()->create();

        app(PurchaseService::class)->create(
            vendor: $vendor,
            items: [[
                'product_id' => $product->id,
                'manufacturing_date' => '2026-01-01',
                'expiry_date' => '2027-01-01',
                'cost_price' => '400.00',
                'quantity' => '10',
                'barcode' => 'MFR-CODE-9999',
            ]],
            paymentLines: [
                ['method' => 'cash', 'amount' => '4000.00', 'bank_id' => null],
            ],
            user: $user,
        );

        $this->assertSame('MFR-CODE-9999', Batch::query()->first()->barcode);
    }

    public function test_an_unbalanced_split_writes_nothing(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $product = Product::factory()->create();

        try {
            app(PurchaseService::class)->create(
                vendor: $vendor,
                items: [[
                    'product_id' => $product->id,
                    'manufacturing_date' => '2026-01-01',
                    'expiry_date' => '2027-01-01',
                    'cost_price' => '400.00',
                    'quantity' => '10',
                ]],
                paymentLines: [
                    ['method' => 'cash', 'amount' => '1000.00', 'bank_id' => null],
                ],
                user: $user,
            );

            $this->fail('Expected UnbalancedPaymentSplitException was not thrown.');
        } catch (UnbalancedPaymentSplitException) {
            // expected
        }

        $this->assertSame(0, Purchase::query()->count());
        $this->assertSame(0, PurchaseItem::query()->count());
        $this->assertSame(0, Batch::query()->count());
        $this->assertSame(0, Payment::query()->count());
    }
}
