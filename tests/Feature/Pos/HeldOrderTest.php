<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Livewire\Pos\Pos;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\HeldOrder;
use App\Models\Product;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HeldOrderTest extends TestCase
{
    use RefreshDatabase;

    private function salesman(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Salesman->value);

        return $user;
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
     * @return list<array<string, string|int>>
     */
    private function cartFor(Batch $batch, string $quantity = '3'): array
    {
        return [[
            'batch_id' => $batch->id,
            'barcode' => $batch->barcode,
            'product_name' => 'Test Product',
            'unit_price' => '800.00',
            'quantity' => $quantity,
            'available' => '20.00',
        ]];
    }

    public function test_holding_an_order_parks_the_cart_and_empties_the_screen(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch();
        $customer = Customer::factory()->create();

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', $this->cartFor($batch))
            ->set('customer_id', $customer->id)
            ->call('holdOrder')
            ->assertSet('cart', [])
            ->assertSet('customer_id', null);

        $held = HeldOrder::query()->firstOrFail();
        $this->assertSame($customer->name, $held->label);
        $this->assertSame($customer->id, $held->payload['customer_id']);
        $this->assertSame(1, $held->itemCount());
    }

    public function test_holding_an_empty_cart_does_nothing(): void
    {
        $user = $this->salesman();

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->call('holdOrder');

        $this->assertSame(0, HeldOrder::query()->count());
    }

    public function test_resuming_restores_the_cart_and_removes_the_held_order(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch();
        $customer = Customer::factory()->create();

        $component = Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', $this->cartFor($batch))
            ->set('customer_id', $customer->id)
            ->call('holdOrder');

        $heldId = HeldOrder::query()->value('id');

        $component->call('resumeHeldOrder', $heldId)
            ->assertSet('customer_id', $customer->id);

        $cart = $component->get('cart');
        $this->assertCount(1, $cart);
        $this->assertSame($batch->id, $cart[0]['batch_id']);
        $this->assertSame('3', $cart[0]['quantity']);

        // The parked copy is consumed once it's live on screen again.
        $this->assertSame(0, HeldOrder::query()->count());
    }

    public function test_resuming_is_refused_while_the_cart_still_has_items(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch();

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', $this->cartFor($batch))
            ->call('holdOrder')
            ->set('cart', $this->cartFor($batch, '2'))
            ->call('resumeHeldOrder', HeldOrder::query()->value('id'))
            ->assertHasErrors(['cart']);

        // Nothing was consumed or overwritten.
        $this->assertSame(1, HeldOrder::query()->count());
    }

    public function test_resuming_clamps_a_quantity_that_no_longer_fits_current_stock(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch('20');

        $component = Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', $this->cartFor($batch, '10'))
            ->call('holdOrder');

        // Someone else sells most of it while the order sits parked.
        $batch->forceFill(['quantity_remaining' => '4'])->save();

        $component->call('resumeHeldOrder', HeldOrder::query()->value('id'));

        $cart = $component->get('cart');
        // Clamped down to live stock, carrying the batch's decimal:2 cast.
        $this->assertSame('4.00', $cart[0]['quantity']);
        $this->assertSame('4.00', $cart[0]['available']);
    }

    public function test_resuming_drops_a_line_whose_batch_sold_out_entirely(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch('20');

        $component = Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', $this->cartFor($batch))
            ->call('holdOrder');

        $batch->forceFill(['quantity_remaining' => '0'])->save();

        $component->call('resumeHeldOrder', HeldOrder::query()->value('id'))
            ->assertSet('cart', [])
            ->assertHasErrors(['cart']);
    }

    public function test_discarding_removes_the_held_order(): void
    {
        $user = $this->salesman();
        $batch = $this->makeBatch();

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->set('cart', $this->cartFor($batch))
            ->call('holdOrder')
            ->call('discardHeldOrder', HeldOrder::query()->value('id'));

        $this->assertSame(0, HeldOrder::query()->count());
    }

    public function test_a_user_without_sales_manage_cannot_hold_an_order(): void
    {
        $accountant = User::factory()->create();
        $accountant->assignRole(UserRole::Accountant->value);

        Livewire::actingAs($accountant)
            ->test(Pos::class)
            ->assertForbidden();
    }
}
