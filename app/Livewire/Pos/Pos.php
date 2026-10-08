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
use App\Services\PosCatalogService;
use App\Services\SaleService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * The cart, checkout and held orders live here, server-side. The product
 * grid and batch pop-up are client-side (resources/js/pos/catalog.js): the
 * grid loads its data once through catalog() and calls addBatch() /
 * scanBarcode() to put things in the cart, so typing in the search box or
 * opening a pop-up never costs a server round trip.
 *
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

    /** Non-blocking, e.g. a scanned batch that has already expired. */
    public ?string $scanWarning = null;

    /** Confirmation shown in the POS itself (a held order, a completed sale). */
    public ?string $notice = null;

    /** @var list<array{batch_id: int, product_id: int, barcode: string, product_name: string, image_url: ?string, expiry_date: string, unit_price: string, quantity: string, available: string, discount_type: ?string, discount_value: string}> */
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

    /**
     * The product grid's data — fetched by the browser once on load and again
     * after every sale (stock moves), never re-sent on ordinary re-renders.
     *
     * @return array<string, mixed>
     */
    public function catalog(PosCatalogService $catalogService): array
    {
        $this->authorize('create', Sale::class);

        return $catalogService->forUser(auth()->user());
    }

    /**
     * Adds a scanned barcode as one unit. Takes the code as an argument from
     * the grid's search box; falls back to $barcodeInput for callers that
     * bind the property instead.
     *
     * @return array{ok: bool, message: ?string, warning: ?string}
     */
    public function scanBarcode(?string $code = null): array
    {
        $this->authorize('create', Sale::class);

        $this->scanError = null;
        $this->scanWarning = null;
        $barcode = trim($code ?? $this->barcodeInput);
        $this->barcodeInput = '';

        if ($barcode === '') {
            return ['ok' => false, 'message' => null, 'warning' => null];
        }

        $batch = Batch::query()->with('product')->where('barcode', $barcode)->first();

        if ($batch === null) {
            return $this->scanFailed(__('pos.barcode_not_found', ['barcode' => $barcode]));
        }

        $error = $this->addToCart($batch, '1');

        if ($error !== null) {
            return $this->scanFailed($error);
        }

        // Sold anyway — the shop decides — but never silently.
        if ($batch->isExpired()) {
            $this->scanWarning = __('pos.batch_expired_warning', [
                'barcode' => $batch->barcode,
                'date' => $batch->expiry_date->translatedFormat('j M Y'),
            ]);
        }

        return ['ok' => true, 'message' => null, 'warning' => $this->scanWarning];
    }

    /**
     * The batch pop-up's "Add to cart": a specific batch, in a specific
     * quantity. Everything is re-checked here against the live batch —
     * the grid's copy of the stock may be minutes old.
     *
     * @return array{ok: bool, message: ?string, warning: ?string}
     */
    public function addBatch(int $batchId, mixed $quantity = '1'): array
    {
        $this->authorize('create', Sale::class);

        $quantity = trim((string) $quantity);

        if (preg_match('/^\d+$/', $quantity) !== 1 || bccomp($quantity, '1', 0) < 0) {
            return ['ok' => false, 'message' => __('pos.invalid_quantity'), 'warning' => null];
        }

        $batch = Batch::query()->with('product')->find($batchId);

        if ($batch === null) {
            return ['ok' => false, 'message' => __('pos.batch_unavailable'), 'warning' => null];
        }

        $error = $this->addToCart($batch, $quantity);

        return ['ok' => $error === null, 'message' => $error, 'warning' => null];
    }

    /**
     * @return array{ok: false, message: string, warning: null}
     */
    private function scanFailed(string $message): array
    {
        $this->scanError = $message;

        return ['ok' => false, 'message' => $message, 'warning' => null];
    }

    /**
     * Merges into an existing line for the same batch rather than adding a
     * duplicate row. Returns an error message, or null on success.
     *
     * Quantities are kept as whole-number strings ('3', not '3.00'): checkout
     * validates cart.*.quantity as an integer, and Laravel's integer rule
     * rejects '3.00'.
     */
    private function addToCart(Batch $batch, string $quantity): ?string
    {
        $remaining = (string) $batch->quantity_remaining;

        if (bccomp($remaining, '0', 2) <= 0) {
            return __('pos.out_of_stock', ['barcode' => $batch->barcode]);
        }

        $existingIndex = collect($this->cart)->search(fn (array $line) => $line['batch_id'] === $batch->id);
        $alreadyInCart = $existingIndex !== false ? $this->wholeQuantity($this->cart[$existingIndex]['quantity']) : '0';
        $newQuantity = bcadd($alreadyInCart, $quantity, 0);

        if (bccomp($newQuantity, $remaining, 2) > 0) {
            return $existingIndex !== false
                ? __('pos.quantity_exceeds_stock_in_cart', ['available' => $this->wholeQuantity($remaining), 'in_cart' => $alreadyInCart])
                : __('pos.quantity_exceeds_stock', ['available' => $this->wholeQuantity($remaining)]);
        }

        if ($existingIndex !== false) {
            $this->cart[$existingIndex]['quantity'] = $newQuantity;
            $this->cart[$existingIndex]['available'] = $remaining;

            return null;
        }

        $this->cart[] = $this->cartLine($batch, $newQuantity, (string) $batch->product->default_sale_price);

        return null;
    }

    /**
     * @return array{batch_id: int, product_id: int, barcode: string, product_name: string, image_url: ?string, expiry_date: string, unit_price: string, quantity: string, available: string, discount_type: ?string, discount_value: string}
     */
    private function cartLine(Batch $batch, string $quantity, string $unitPrice, ?string $discountType = null, string $discountValue = '0'): array
    {
        return [
            'batch_id' => $batch->id,
            'product_id' => $batch->product_id,
            'barcode' => $batch->barcode,
            'product_name' => $batch->product->name,
            'image_url' => $batch->product->imageUrl(),
            'expiry_date' => $batch->expiry_date->toDateString(),
            'unit_price' => $unitPrice,
            'quantity' => $quantity,
            'available' => (string) $batch->quantity_remaining,
            'discount_type' => $discountType,
            'discount_value' => $discountValue,
        ];
    }

    /** '20.00' → '20'. Stock and quantities are always whole units. */
    private function wholeQuantity(string $quantity): string
    {
        return bcadd($quantity !== '' ? $quantity : '0', '0', 0);
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

    public function dismissNotice(): void
    {
        $this->notice = null;
        $this->scanError = null;
        $this->scanWarning = null;
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

        $this->notice = __('pos.order_held');
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
     * @return list<array{batch_id: int, product_id: int, barcode: string, product_name: string, image_url: ?string, expiry_date: string, unit_price: string, quantity: string, available: string, discount_type: ?string, discount_value: string}>
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

            $quantity = $this->wholeQuantity((string) ($line['quantity'] ?? '1'));
            $remaining = $this->wholeQuantity((string) $batch->quantity_remaining);

            $cart[] = $this->cartLine(
                $batch,
                // Clamp to what's actually left now, not what was available
                // when the order was parked.
                bccomp($quantity, $remaining, 0) > 0 ? $remaining : $quantity,
                (string) ($line['unit_price'] ?? $batch->product->default_sale_price),
                in_array($line['discount_type'] ?? null, [DiscountType::Flat->value, DiscountType::Percentage->value], true)
                    ? $line['discount_type']
                    : null,
                (string) ($line['discount_value'] ?? '0'),
            );
        }

        return $cart;
    }

    public function incrementQuantity(int $index): void
    {
        if (! isset($this->cart[$index])) {
            return;
        }

        $newQuantity = bcadd($this->wholeQuantity($this->cart[$index]['quantity']), '1', 0);

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

        $newQuantity = bcsub($this->wholeQuantity($this->cart[$index]['quantity']), '1', 0);

        // Floor of 1, not 0 — quantities are always whole units, and a sale
        // can't carry a zero-quantity line.
        if (bccomp($newQuantity, '1', 0) < 0) {
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

    /**
     * The payment lines as checkout will post them. An On Account line left
     * blank takes whatever the other lines don't cover — the cashier's way of
     * saying "the rest goes on the customer's account". That only works for
     * a single blank On Account line, once every other amount is known and
     * something is actually left; otherwise the blank stays and validation
     * asks for an amount.
     *
     * Mirrored by resolvePaymentLines() in resources/js/offline/pos-engine.js.
     *
     * @return list<array{method: string, amount: string, bank_id: ?int}>
     */
    public function resolvedPaymentLines(): array
    {
        $lines = $this->paymentLines;
        $blank = array_keys(array_filter(
            $lines,
            fn (array $line) => $line['method'] === PaymentMethod::Ledger->value && blank($line['amount']),
        ));

        if (count($blank) !== 1) {
            return $lines;
        }

        $covered = '0.00';

        foreach ($lines as $index => $line) {
            if ($index === $blank[0]) {
                continue;
            }

            // bcmath only takes plain decimals — anything else is left for
            // validation to reject.
            if (preg_match('/^\d+(\.\d+)?$/', (string) $line['amount']) !== 1) {
                return $lines;
            }

            $covered = bcadd($covered, (string) $line['amount'], 2);
        }

        $rest = bcsub($this->cartTotal, $covered, 2);

        if (bccomp($rest, '0', 2) <= 0) {
            return $lines;
        }

        $lines[$blank[0]]['amount'] = $rest;

        return $lines;
    }

    /** Checkout validates the lines it will post, not the blanks as typed. */
    protected function prepareForValidation($attributes): array
    {
        if (array_key_exists('paymentLines', $attributes)) {
            $attributes['paymentLines'] = $this->resolvedPaymentLines();
        }

        return $attributes;
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
        ], [
            'paymentLines.*.amount.required' => __('pos.payment_amount_required'),
            'paymentLines.*.amount.numeric' => __('pos.payment_amount_invalid'),
            'paymentLines.*.amount.min' => __('pos.payment_amount_invalid'),
            'paymentLines.*.bank_id.exists' => __('ledger.bank_required'),
        ]);

        $paymentLines = $this->resolvedPaymentLines();

        foreach ($paymentLines as $line) {
            if ($line['method'] === PaymentMethod::Bank->value && blank($line['bank_id'])) {
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
                paymentLines: $paymentLines,
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
        $this->scanError = null;
        $this->scanWarning = null;

        $this->dispatch('sale-completed', receiptUrl: route('sales.receipt', $sale));
        // Stock just moved — the grid re-fetches its counts.
        $this->dispatch('pos-catalog-refresh');
        $this->notice = __('pos.sale_completed', ['invoice' => $sale->invoice_number]);
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
