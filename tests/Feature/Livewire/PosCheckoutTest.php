<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\UserRole;
use App\Livewire\Pos\Pos;
use App\Models\Batch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PosCheckoutTest extends TestCase
{
    use RefreshDatabase;

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

    private function salesman(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Salesman->value);

        return $user;
    }

    public function test_checkout_rejects_a_negative_cart_quantity(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch('20');

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', [[
                'batch_id' => $batch->id,
                'barcode' => $batch->barcode,
                'product_name' => 'Test Product',
                'unit_price' => '800.00',
                'quantity' => '-9',
                'available' => '20.00',
            ]])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '-7200.00', 'bank_id' => null]])
            ->call('checkout')
            ->assertHasErrors(['cart.0.quantity']);

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_checkout_rejects_a_zero_cart_quantity(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch('20');

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', [[
                'batch_id' => $batch->id,
                'barcode' => $batch->barcode,
                'product_name' => 'Test Product',
                'unit_price' => '800.00',
                'quantity' => '0',
                'available' => '20.00',
            ]])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '0.00', 'bank_id' => null]])
            ->call('checkout')
            ->assertHasErrors(['cart.0.quantity']);

        $this->assertSame(0, Sale::query()->count());
    }

    public function test_checkout_rejects_a_negative_unit_price(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch('20');

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', [[
                'batch_id' => $batch->id,
                'barcode' => $batch->barcode,
                'product_name' => 'Test Product',
                'unit_price' => '-800.00',
                'quantity' => '5',
                'available' => '20.00',
            ]])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '-4000.00', 'bank_id' => null]])
            ->call('checkout')
            ->assertHasErrors(['cart.0.unit_price']);

        $this->assertSame(0, Sale::query()->count());
    }

    public function test_checkout_completes_a_valid_cash_sale(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch('20');

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', [[
                'batch_id' => $batch->id,
                'barcode' => $batch->barcode,
                'product_name' => 'Test Product',
                'unit_price' => '800.00',
                'quantity' => '5',
                'available' => '20.00',
            ]])
            ->set('paymentLines', [['method' => 'cash', 'amount' => '4000.00', 'bank_id' => null]])
            ->call('checkout')
            ->assertHasNoErrors();

        $this->assertSame(1, Sale::query()->count());
        $this->assertSame('15.00', $batch->fresh()->quantity_remaining);
    }
}
