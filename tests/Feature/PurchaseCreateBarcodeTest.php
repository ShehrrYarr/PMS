<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Purchases\PurchaseCreate;
use App\Models\Batch;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PurchaseCreateBarcodeTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        return $admin;
    }

    /**
     * @return array<string, mixed>
     */
    private function baseItem(Product $product, string $barcode = ''): array
    {
        return [
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '400.00',
            'quantity' => '10',
            'barcode' => $barcode,
        ];
    }

    public function test_a_manual_barcode_is_accepted_and_used(): void
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->create();

        Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [$this->baseItem($product, 'MFR-001')])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '4000.00', 'bank_id' => null]])
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('MFR-001', Batch::query()->first()->barcode);
    }

    public function test_reusing_an_existing_batchs_barcode_is_rejected(): void
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->create();

        app(BarcodeService::class)->createBatchWithBarcode([
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '100.00',
            'quantity_received' => '5',
            'quantity_remaining' => '5',
            'barcode' => 'ALREADY-TAKEN',
        ]);

        Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [$this->baseItem($product, 'ALREADY-TAKEN')])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '4000.00', 'bank_id' => null]])
            ->call('save')
            ->assertHasErrors(['items.0.barcode']);

        $this->assertSame(1, Batch::query()->count());
    }

    public function test_two_items_with_the_same_manual_barcode_are_rejected(): void
    {
        $vendor = Vendor::factory()->create();
        $productA = Product::factory()->create();
        $productB = Product::factory()->create();

        Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [
                $this->baseItem($productA, 'DUPE-CODE'),
                $this->baseItem($productB, 'DUPE-CODE'),
            ])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '8000.00', 'bank_id' => null]])
            ->call('save')
            ->assertHasErrors(['items']);

        $this->assertSame(0, Batch::query()->count());
    }

    public function test_leaving_multiple_barcodes_blank_does_not_trigger_a_false_duplicate_error(): void
    {
        $vendor = Vendor::factory()->create();
        $productA = Product::factory()->create();
        $productB = Product::factory()->create();

        Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [
                $this->baseItem($productA),
                $this->baseItem($productB),
            ])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '8000.00', 'bank_id' => null]])
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame(2, Batch::query()->count());
        $this->assertSame(2, Batch::query()->distinct()->count('barcode'));
    }
}
