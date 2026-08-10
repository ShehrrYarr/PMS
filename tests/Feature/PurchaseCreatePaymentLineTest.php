<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Purchases\PurchaseCreate;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PurchaseCreatePaymentLineTest extends TestCase
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
    private function baseItem(Product $product): array
    {
        return [
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '100.00',
            'quantity' => '10',
            'barcode' => '',
        ];
    }

    /**
     * removePaymentLine() unsets the array index then reindexes with
     * array_values() — mirrors removeItem(), which is already covered
     * elsewhere. Confirms the component-level state change itself is
     * correct, independent of the DOM re-rendering it (Livewire's morph
     * needs `wire:key` on the loop to reflect this reliably in the browser).
     */
    public function test_removing_a_payment_line_shrinks_the_array_and_reindexes(): void
    {
        $test = Livewire::actingAs($this->admin())->test(PurchaseCreate::class);

        $test->set('paymentLines.0.amount', '500')
            ->call('addPaymentLine')
            ->assertSet('paymentLines', [
                ['method' => 'cash', 'amount' => '500', 'bank_id' => null],
                ['method' => 'cash', 'amount' => '', 'bank_id' => null],
            ])
            ->call('removePaymentLine', 1)
            ->assertSet('paymentLines', [
                ['method' => 'cash', 'amount' => '500', 'bank_id' => null],
            ]);
    }

    /**
     * The template used to check only the bare `paymentLines` error key,
     * which Laravel's MessageBag never populates for `paymentLines.*.amount`
     * rule failures (those live under `paymentLines.0.amount`, an exact,
     * different key). The purchase correctly failed to save, but the
     * cashier saw no error anywhere on the page — the button just appeared
     * to do nothing. Fixed by binding per-line error output in the blade;
     * this test locks in that the validation error is actually addressable
     * by the index-qualified key the blade now reads.
     */
    public function test_an_invalid_payment_line_amount_is_reported_under_its_indexed_key(): void
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->create();

        Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [$this->baseItem($product)])
            ->set('paymentLines', [
                ['method' => 'cash', 'amount' => '1000.00', 'bank_id' => null],
                // Left blank — the state a cashier reaches either by adding
                // a line and not filling it in, or by trying (and failing,
                // pre-fix) to remove it.
                ['method' => 'cash', 'amount' => '', 'bank_id' => null],
            ])
            ->call('save')
            ->assertHasErrors(['paymentLines.1.amount' => 'required']);

        $this->assertSame(0, Purchase::query()->count());
    }

    /**
     * Same blind-spot for the bank line: picking "Bank Transfer" without
     * choosing a bank fails `paymentLines.*.bank_id` silently for the same
     * reason as the amount case above.
     */
    public function test_a_bank_payment_line_missing_its_bank_is_reported_under_its_indexed_key(): void
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->create();

        Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [$this->baseItem($product)])
            ->set('paymentLines', [
                ['method' => 'bank', 'amount' => '1000.00', 'bank_id' => null],
            ])
            ->call('save')
            ->assertHasErrors('paymentLines')
            ->assertSee(__('ledger.bank_required'));
    }

    /**
     * The component itself must stay fully usable after a failed save() —
     * confirms addItem()/removeItem() aren't left in some broken state by a
     * validation failure, which is the server-side half of the reported "Add
     * Item stopped working afterwards" symptom. (The DOM-visible half is the
     * missing wire:key, which this PHP-level test can't exercise directly.)
     */
    public function test_the_component_still_accepts_new_items_after_a_failed_save(): void
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->create();

        $test = Livewire::actingAs($this->admin())
            ->test(PurchaseCreate::class)
            ->set('vendor_id', $vendor->id)
            ->set('items', [$this->baseItem($product)])
            ->set('paymentLines', [
                ['method' => 'cash', 'amount' => '1000.00', 'bank_id' => null],
                ['method' => 'cash', 'amount' => '', 'bank_id' => null],
            ])
            ->call('save')
            ->assertHasErrors();

        $test->call('addItem')
            ->assertCount('items', 2);
    }
}
