<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Livewire\Pos\Pos;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Checkout with an On Account (ledger) line: leaving its amount empty puts
 * whatever the other lines don't cover on the customer's account, and any
 * problem that stops the sale is shown in the checkout pop-up — never a
 * Complete Sale button that silently does nothing.
 */
class PosLedgerCheckoutTest extends TestCase
{
    use RefreshDatabase;

    private User $salesman;

    private Customer $customer;

    private Batch $batch;

    protected function setUp(): void
    {
        parent::setUp();

        $this->salesman = User::factory()->create();
        $this->salesman->assignRole(UserRole::Salesman->value);
        $this->customer = Customer::factory()->create(['shop_id' => $this->salesman->shop_id]);

        $product = Product::factory()->create(['default_sale_price' => '1000.00']);
        $this->batch = app(BarcodeService::class)->createBatchWithBarcode([
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2028-01-01',
            'cost_price' => '700.00',
            'quantity_received' => '10',
            'quantity_remaining' => '10',
        ]);
    }

    /** A Rs 1,000 cart with the checkout pop-up open (one Cash line for the full total). */
    private function checkoutFor(?Customer $customer): Testable
    {
        return Livewire::actingAs($this->salesman)
            ->test(Pos::class)
            ->set('customer_id', $customer?->id)
            ->call('addBatch', $this->batch->id, '1')
            ->call('openCheckout');
    }

    /** @return array<string, string> method => amount */
    private function paymentsOf(Sale $sale): array
    {
        return Payment::query()
            ->where('payable_type', 'sale')
            ->where('payable_id', $sale->id)
            ->pluck('amount', 'method')
            ->map(fn ($amount) => (string) $amount)
            ->all();
    }

    /** The reported bug: On Account with the amount emptied did nothing. */
    public function test_an_empty_on_account_amount_puts_the_whole_sale_on_the_customers_account(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.method', 'ledger')
            ->set('paymentLines.0.amount', '')
            ->call('checkout')
            ->assertHasNoErrors()
            ->assertSet('showCheckoutModal', false);

        $sale = Sale::query()->sole();
        $this->assertSame(['ledger' => '1000.00'], $this->paymentsOf($sale));
        $this->assertSame(0, bccomp($this->customer->fresh()->currentBalance(), '1000.00', 2));
        $this->assertSame('9.00', $this->batch->fresh()->quantity_remaining);
    }

    public function test_an_empty_on_account_amount_takes_whatever_the_other_lines_dont_cover(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.amount', '300')
            ->call('addPaymentLine')
            ->set('paymentLines.1.method', 'ledger')
            ->call('checkout')
            ->assertHasNoErrors();

        $sale = Sale::query()->sole();
        $this->assertSame(['cash' => '300.00', 'ledger' => '700.00'], $this->paymentsOf($sale));
        $this->assertSame(0, bccomp($this->customer->fresh()->currentBalance(), '700.00', 2));
    }

    public function test_the_pop_up_says_where_the_rest_goes_before_the_sale_is_completed(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.amount', '250')
            ->call('addPaymentLine')
            ->set('paymentLines.1.method', 'ledger')
            ->assertSee(__('pos.rest_on_account', ['amount' => money('750.00')]))
            ->assertSee(__('pos.fully_paid'));
    }

    /** Credit is only ever given on purpose: a short Cash payment is still an error. */
    public function test_a_short_payment_without_an_on_account_line_is_still_rejected(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.amount', '600')
            ->call('checkout')
            ->assertHasErrors(['paymentLines'])
            ->assertSet('showCheckoutModal', true);

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame(0, bccomp($this->customer->fresh()->currentBalance(), '0', 2));
    }

    /** The other half of the bug: a rejected payment line's message never rendered. */
    public function test_an_empty_cash_amount_shows_a_readable_message_in_the_pop_up(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.amount', '')
            ->call('checkout')
            ->assertHasErrors(['paymentLines.0.amount'])
            ->assertSee(__('pos.payment_amount_required'))
            ->assertSet('showCheckoutModal', true);

        $this->assertSame(0, Sale::query()->count());
    }

    public function test_an_empty_on_account_line_with_nothing_left_to_cover_asks_for_an_amount(): void
    {
        $this->checkoutFor($this->customer)
            ->call('addPaymentLine')
            ->set('paymentLines.1.method', 'ledger')
            ->call('checkout')
            ->assertHasErrors(['paymentLines.1.amount'])
            ->assertSee(__('pos.payment_amount_required'));

        $this->assertSame(0, Sale::query()->count());
    }

    /** Two blanks would be a guess about how to split the rest — ask instead. */
    public function test_two_empty_on_account_lines_are_not_guessed_at(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.method', 'ledger')
            ->set('paymentLines.0.amount', '')
            ->call('addPaymentLine')
            ->set('paymentLines.1.method', 'ledger')
            ->call('checkout')
            ->assertHasErrors(['paymentLines.0.amount', 'paymentLines.1.amount']);

        $this->assertSame(0, Sale::query()->count());
    }

    public function test_a_walk_in_sale_still_cannot_go_on_account(): void
    {
        $this->checkoutFor(null)
            ->set('paymentLines.0.method', 'ledger')
            ->set('paymentLines.0.amount', '')
            ->call('checkout')
            ->assertHasErrors(['paymentLines'])
            ->assertSee(__('pos.customer_required_for_ledger'));

        $this->assertSame(0, Sale::query()->count());
    }

    public function test_a_bank_line_without_a_bank_shows_why_in_the_pop_up(): void
    {
        $this->checkoutFor($this->customer)
            ->set('paymentLines.0.method', 'bank')
            ->set('paymentLines.0.bank_id', '')
            ->call('checkout')
            ->assertHasErrors(['paymentLines'])
            ->assertSee(__('ledger.bank_required'));

        $this->assertSame(0, Sale::query()->count());
    }
}
