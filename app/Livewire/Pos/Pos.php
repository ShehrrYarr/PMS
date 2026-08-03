<?php

declare(strict_types=1);

namespace App\Livewire\Pos;

use App\Enums\PaymentMethod;
use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidSaleItemException;
use App\Exceptions\InvalidSalePaymentException;
use App\Exceptions\UnbalancedPaymentSplitException;
use App\Models\Bank;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * @property-read string $cartTotal Livewire computed property backed by getCartTotalProperty().
 */
#[Layout('layouts.app')]
class Pos extends Component
{
    use WithFileUploads;

    public string $barcodeInput = '';

    public ?string $scanError = null;

    /** @var list<array{batch_id: int, barcode: string, product_name: string, unit_price: string, quantity: string, available: string}> */
    public array $cart = [];

    public ?int $customer_id = null;

    public bool $showCheckoutModal = false;

    /** @var list<array{method: string, amount: string, bank_id: ?int}> */
    public array $paymentLines = [];

    public ?TemporaryUploadedFile $capturedPhoto = null;

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

        if (bccomp($newQuantity, '0.01', 2) < 0) {
            return;
        }

        $this->cart[$index]['quantity'] = $newQuantity;
    }

    public function getCartTotalProperty(): string
    {
        return array_reduce(
            $this->cart,
            fn (string $carry, array $line) => bcadd($carry, bcmul($line['unit_price'] ?: '0', $line['quantity'] ?: '0', 2), 2),
            '0.00',
        );
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
            'cart.*.quantity' => 'required|numeric|min:0.01',
            'cart.*.unit_price' => 'required|numeric|min:0',
            'paymentLines' => 'required|array|min:1',
            'paymentLines.*.method' => 'required|in:cash,bank,ledger',
            'paymentLines.*.amount' => 'required|numeric|min:0.01',
            'paymentLines.*.bank_id' => 'nullable|exists:banks,id',
            'capturedPhoto' => 'nullable|image|max:5120',
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
        ], $this->cart);

        try {
            $sale = $saleService->create(
                customer: $customer,
                items: $items,
                paymentLines: $this->paymentLines,
                user: auth()->user(),
                photo: $this->capturedPhoto,
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

        $this->dispatch('sale-completed', receiptUrl: route('sales.receipt', $sale));
        session()->flash('success', __('pos.sale_completed', ['invoice' => $sale->invoice_number]));
    }

    public function render(): View
    {
        return view('livewire.pos.pos', [
            'customers' => Customer::query()->where('is_active', true)->orderBy('name')->get(),
            'banks' => Bank::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
