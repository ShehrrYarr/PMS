<?php

declare(strict_types=1);

namespace App\Livewire\Pos;

use App\Enums\DiscountType;
use App\Enums\PaymentMethod;
use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidSaleItemException;
use App\Exceptions\InvalidSalePaymentException;
use App\Exceptions\UnbalancedPaymentSplitException;
use App\Models\Bank;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\HeldOrder;
use App\Models\Sale;
use App\Services\DiscountCalculator;
use App\Services\SaleService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * @property-read string $cartTotal Livewire computed property backed by getCartTotalProperty().
 * @property-read string $cartSubtotal Livewire computed property backed by getCartSubtotalProperty().
 * @property-read string $cartItemDiscountTotal Livewire computed property backed by getCartItemDiscountTotalProperty().
 * @property-read string $saleDiscountAmount Livewire computed property backed by getSaleDiscountAmountProperty().
 */
#[Layout('layouts.app')]
class Pos extends Component
{
    use WithFileUploads;

    public string $barcodeInput = '';

    public ?string $scanError = null;

    /** @var list<array{batch_id: int, barcode: string, product_name: string, unit_price: string, quantity: string, available: string, discount_type: ?string, discount_value: string}> */
    public array $cart = [];

    public ?int $customer_id = null;

    public bool $showCheckoutModal = false;

    /** @var list<array{method: string, amount: string, bank_id: ?int}> */
    public array $paymentLines = [];

    public ?TemporaryUploadedFile $capturedPhoto = null;

    /** Whole-sale discount, applied on top of any per-item discounts already folded into each line. */
    public ?string $discountType = null;

    public string $discountValue = '0';

    public function mount(): void
    {
        $this->authorize('create', Sale::class);
    }

    public function scanBarcode(): void
    {
        $this->scanError = null;
        $barcode = trim($this->barcodeInput);
        $this->barcodeInput = '';

        if ($barcode === '') {
            return;
        }

        $batch = Batch::query()->where('barcode', $barcode)->first();

        if ($batch === null) {
            $this->scanError = __('pos.barcode_not_found', ['barcode' => $barcode]);

            return;
        }

        if (bccomp((string) $batch->quantity_remaining, '0', 2) <= 0) {
            $this->scanError = __('pos.out_of_stock', ['barcode' => $barcode]);

            return;
        }

        $existingIndex = collect($this->cart)->search(fn (array $line) => $line['batch_id'] === $batch->id);

        if ($existingIndex !== false) {
            $newQuantity = bcadd($this->cart[$existingIndex]['quantity'], '1', 2);

            if (bccomp($newQuantity, (string) $batch->quantity_remaining, 2) > 0) {
                $this->scanError = __('pos.out_of_stock', ['barcode' => $barcode]);

                return;
            }

            $this->cart[$existingIndex]['quantity'] = $newQuantity;

            return;
        }

        $batch->loadMissing('product');

        $this->cart[] = [
            'batch_id' => $batch->id,
            'barcode' => $batch->barcode,
            'product_name' => $batch->product->name,
            'unit_price' => (string) $batch->product->default_sale_price,
            'quantity' => '1',
            'available' => (string) $batch->quantity_remaining,
            'discount_type' => null,
            'discount_value' => '0',
        ];
    }

    public function removeCartItem(int $index): void
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
    }

    public function clearCart(): void
    {
        $this->cart = [];
    }

    /**
     * Parks the current cart so the cashier can serve someone else — the
     * classic "customer forgot their wallet, next please" case.
     */
    public function holdOrder(): void
    {
        $this->authorize('create', Sale::class);

        if ($this->cart === []) {
            return;
        }

        HeldOrder::query()->create([
            'shop_id' => auth()->user()->shop_id,
            'user_id' => auth()->id(),
            'client_uuid' => (string) Str::uuid(),
            'label' => $this->customer_id !== null
                ? Customer::query()->find($this->customer_id)?->name
                : null,
            'payload' => [
                'cart' => $this->cart,
                'customer_id' => $this->customer_id,
                'discount_type' => $this->discountType,
                'discount_value' => $this->discountValue,
            ],
        ]);

        $this->cart = [];
        $this->customer_id = null;
        $this->discountType = null;
        $this->discountValue = '0';

        session()->flash('success', __('pos.order_held'));
    }

    public function resumeHeldOrder(int $heldOrderId): void
    {
        $this->authorize('create', Sale::class);

        // Refusing rather than merging or silently overwriting: quietly
        // discarding whatever is already on screen is the kind of surprise
        // that costs a shop a sale.
        if ($this->cart !== []) {
            $this->addError('cart', __('pos.cart_not_empty_to_resume'));

            return;
        }

        // Scoped to this cashier, matching how the list is built — otherwise a
        // guessed id would let one cashier take (and delete) another's parked
        // cart.
        $heldOrder = HeldOrder::query()
            ->where('user_id', auth()->id())
            ->find($heldOrderId);

        if ($heldOrder === null) {
            return;
        }

        // Rebuilt from live batches rather than trusted wholesale: stock and
        // prices move while an order sits parked, and the payload is JSON
        // that also arrives from the offline sync path.
        $this->cart = $this->rehydrateCart($heldOrder->payload['cart'] ?? []);
        $this->customer_id = $heldOrder->payload['customer_id'] ?? null;
        $this->discountType = $heldOrder->payload['discount_type'] ?? null;
        $this->discountValue = (string) ($heldOrder->payload['discount_value'] ?? '0');

        $heldOrder->delete();

        if ($this->cart === []) {
            $this->addError('cart', __('pos.held_order_items_unavailable'));
        }
    }

    public function discardHeldOrder(int $heldOrderId): void
    {
        $this->authorize('create', Sale::class);

        HeldOrder::query()
            ->where('user_id', auth()->id())
            ->find($heldOrderId)?->delete();
    }

    /**
     * @param  mixed  $lines
     * @return list<array{batch_id: int, barcode: string, product_name: string, unit_price: string, quantity: string, available: string, discount_type: ?string, discount_value: string}>
     */
    private function rehydrateCart(mixed $lines): array
    {
        if (! is_array($lines)) {
            return [];
        }

        $cart = [];

        foreach ($lines as $line) {
            if (! is_array($line) || ! isset($line['batch_id'])) {
                continue;
            }

            $batch = Batch::query()->with('product')->find($line['batch_id']);

            // A batch sold out or deleted while the order was parked simply
            // drops off, rather than resuming into a cart that can't check out.
            if ($batch === null || bccomp((string) $batch->quantity_remaining, '0', 2) <= 0) {
                continue;
            }

            $quantity = (string) ($line['quantity'] ?? '1');

            $cart[] = [
                'batch_id' => $batch->id,
                'barcode' => $batch->barcode,
                'product_name' => $batch->product->name,
                'unit_price' => (string) ($line['unit_price'] ?? $batch->product->default_sale_price),
                // Clamp to what's actually left now, not what was available
                // when the order was parked.
                'quantity' => bccomp($quantity, (string) $batch->quantity_remaining, 2) > 0
                    ? (string) $batch->quantity_remaining
                    : $quantity,
                'available' => (string) $batch->quantity_remaining,
                'discount_type' => in_array($line['discount_type'] ?? null, [DiscountType::Flat->value, DiscountType::Percentage->value], true)
                    ? $line['discount_type']
                    : null,
                'discount_value' => (string) ($line['discount_value'] ?? '0'),
            ];
        }

        return $cart;
    }

    public function incrementQuantity(int $index): void
    {
        if (! isset($this->cart[$index])) {
            return;
        }

        $newQuantity = bcadd($this->cart[$index]['quantity'] ?: '0', '1', 2);

        if (bccomp($newQuantity, $this->cart[$index]['available'], 2) > 0) {
            return;
        }

        $this->cart[$index]['quantity'] = $newQuantity;
    }

    public function decrementQuantity(int $index): void
    {
        if (! isset($this->cart[$index])) {
            return;
        }

        $newQuantity = bcsub($this->cart[$index]['quantity'] ?: '0', '1', 2);

        // Floor of 1, not 0 — quantities are always whole units, and a sale
        // can't carry a zero-quantity line.
        if (bccomp($newQuantity, '1', 2) < 0) {
            return;
        }

        $this->cart[$index]['quantity'] = $newQuantity;
    }

    public function lineSubtotal(array $line): string
    {
        return bcmul($line['unit_price'] ?: '0', $line['quantity'] ?: '0', 2);
    }

    public function lineDiscountAmount(array $line): string
    {
        return app(DiscountCalculator::class)->amount(
            $this->lineSubtotal($line),
            $line['discount_type'] ?? null,
            $line['discount_value'] ?? null,
        );
    }

    /** The line's total after its own per-item discount, before the sale-level discount. */
    public function lineTotal(array $line): string
    {
        return bcsub($this->lineSubtotal($line), $this->lineDiscountAmount($line), 2);
    }

    /** Sum of every line's pre-discount subtotal — the receipt's "Subtotal" figure. */
    public function getCartSubtotalProperty(): string
    {
        return array_reduce(
            $this->cart,
            fn (string $carry, array $line) => bcadd($carry, $this->lineSubtotal($line), 2),
            '0.00',
        );
    }

    public function getCartItemDiscountTotalProperty(): string
    {
        return array_reduce(
            $this->cart,
            fn (string $carry, array $line) => bcadd($carry, $this->lineDiscountAmount($line), 2),
            '0.00',
        );
    }

    private function subtotalAfterItemDiscounts(): string
    {
        return bcsub($this->cartSubtotal, $this->cartItemDiscountTotal, 2);
    }

    public function getSaleDiscountAmountProperty(): string
    {
        return app(DiscountCalculator::class)->amount(
            $this->subtotalAfterItemDiscounts(),
            $this->discountType,
            $this->discountValue,
        );
    }

    /** Subtotal minus every item discount minus the sale-level discount — what the customer actually owes. */
    public function getCartTotalProperty(): string
    {
        return bcsub($this->subtotalAfterItemDiscounts(), $this->saleDiscountAmount, 2);
    }

    public function openCheckout(): void
    {
        if (empty($this->cart)) {
            return;
        }

        $this->paymentLines = [[
            'method' => PaymentMethod::Cash->value,
            'amount' => $this->cartTotal,
            'bank_id' => null,
        ]];
        $this->showCheckoutModal = true;
    }

    public function addPaymentLine(): void
    {
        $this->paymentLines[] = [
            'method' => PaymentMethod::Cash->value,
            'amount' => '',
            'bank_id' => null,
        ];
    }

    public function removePaymentLine(int $index): void
    {
        unset($this->paymentLines[$index]);
        $this->paymentLines = array_values($this->paymentLines);
    }

    public function removePhoto(): void
    {
        $this->capturedPhoto = null;
    }

    public function checkout(SaleService $saleService): void
    {
        $this->authorize('create', Sale::class);

        $this->validate([
            'cart' => 'required|array|min:1',
            'cart.*.quantity' => 'required|integer|min:1',
            'cart.*.unit_price' => 'required|numeric|min:0',
            'cart.*.discount_type' => 'nullable|in:flat,percentage',
            'cart.*.discount_value' => 'nullable|required_with:cart.*.discount_type|numeric|min:0',
            'paymentLines' => 'required|array|min:1',
            'paymentLines.*.method' => 'required|in:cash,bank,ledger',
            'paymentLines.*.amount' => 'required|numeric|min:0.01',
            'paymentLines.*.bank_id' => 'nullable|exists:banks,id',
            'capturedPhoto' => 'nullable|image|max:5120',
            'discountType' => 'nullable|in:flat,percentage',
            'discountValue' => 'nullable|required_with:discountType|numeric|min:0',
        ]);

        foreach ($this->paymentLines as $line) {
            if ($line['method'] === PaymentMethod::Bank->value && $line['bank_id'] === null) {
                $this->addError('paymentLines', __('ledger.bank_required'));

                return;
            }

            if ($line['method'] === PaymentMethod::Ledger->value && $this->customer_id === null) {
                $this->addError('paymentLines', __('pos.customer_required_for_ledger'));

                return;
            }
        }

        $customer = $this->customer_id !== null ? Customer::query()->findOrFail($this->customer_id) : null;

        $items = array_map(fn (array $line) => [
            'batch_id' => $line['batch_id'],
            'quantity' => $line['quantity'],
            'unit_price' => $line['unit_price'],
            'discount_type' => $line['discount_type'] ?? null,
            'discount_value' => $line['discount_value'] ?? null,
        ], $this->cart);

        try {
            $sale = $saleService->create(
                customer: $customer,
                items: $items,
                paymentLines: $this->paymentLines,
                user: auth()->user(),
                photo: $this->capturedPhoto,
                discountType: $this->discountType,
                discountValue: $this->discountValue,
            );
        } catch (InsufficientStockException|UnbalancedPaymentSplitException|InvalidSaleItemException|InvalidSalePaymentException $e) {
            $this->addError('paymentLines', $e->getMessage());

            return;
        }

        $this->showCheckoutModal = false;
        $this->cart = [];
        $this->customer_id = null;
        $this->paymentLines = [];
        $this->capturedPhoto = null;
        $this->discountType = null;
        $this->discountValue = '0';

        $this->dispatch('sale-completed', receiptUrl: route('sales.receipt', $sale));
        session()->flash('success', __('pos.sale_completed', ['invoice' => $sale->invoice_number]));
    }

    public function render(): View
    {
        return view('livewire.pos.pos', [
            'customers' => Customer::query()->where('is_active', true)->orderBy('name')->get(),
            'banks' => Bank::query()->where('is_active', true)->orderBy('name')->get(),
            'heldOrders' => HeldOrder::query()->where('user_id', auth()->id())->latest('id')->get(),
        ]);
    }
}
