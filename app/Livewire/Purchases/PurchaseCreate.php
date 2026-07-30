<?php

declare(strict_types=1);

namespace App\Livewire\Purchases;

use App\Enums\PaymentMethod;
use App\Exceptions\UnbalancedPaymentSplitException;
use App\Models\Bank;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Vendor;
use App\Services\PurchaseService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PurchaseCreate extends Component
{
    public ?int $vendor_id = null;

    /** @var list<array{product_id: ?int, manufacturing_date: string, expiry_date: string, cost_price: string, quantity: string, barcode: string}> */
    public array $items = [];

    /** @var list<array{method: string, amount: string, bank_id: ?int}> */
    public array $paymentLines = [];

    public function mount(): void
    {
        $this->authorize('create', Purchase::class);

        $this->addItem();
        $this->addPaymentLine();
    }

    public function addItem(): void
    {
        $this->items[] = [
            'product_id' => null,
            'manufacturing_date' => '',
            'expiry_date' => '',
            'cost_price' => '',
            'quantity' => '',
            'barcode' => '',
        ];
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
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

    public function getTotalProperty(): string
    {
        return array_reduce(
            $this->items,
            fn (string $carry, array $item) => bcadd($carry, bcmul($item['cost_price'] ?: '0', $item['quantity'] ?: '0', 2), 2),
            '0.00',
        );
    }

    /**
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'vendor_id' => 'required|exists:vendors,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.manufacturing_date' => 'required|date',
            'items.*.expiry_date' => 'required|date|after:items.*.manufacturing_date',
            'items.*.cost_price' => 'required|numeric|min:0.01',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.barcode' => ['nullable', 'string', 'max:100', 'unique:batches,barcode'],
            'paymentLines' => 'required|array|min:1',
            'paymentLines.*.method' => 'required|in:cash,bank,ledger',
            'paymentLines.*.amount' => 'required|numeric|min:0.01',
            'paymentLines.*.bank_id' => 'nullable|exists:banks,id',
        ];
    }

    public function save(PurchaseService $purchaseService): void
    {
        $this->authorize('create', Purchase::class);

        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                $barcodes = collect($this->items)->pluck('barcode')->filter(fn ($barcode) => $barcode !== null && $barcode !== '');

                if ($barcodes->duplicates()->isNotEmpty()) {
                    $validator->errors()->add('items', __('purchases.duplicate_barcode'));
                }
            });
        });

        $validated = $this->validate();

        foreach ($validated['paymentLines'] as $line) {
            if ($line['method'] === PaymentMethod::Bank->value && $line['bank_id'] === null) {
                $this->addError('paymentLines', __('ledger.bank_required'));

                return;
            }
        }

        $vendor = Vendor::query()->findOrFail($this->vendor_id);

        try {
            $purchase = $purchaseService->create(
                vendor: $vendor,
                items: $validated['items'],
                paymentLines: $validated['paymentLines'],
                user: auth()->user(),
            );
        } catch (UnbalancedPaymentSplitException $e) {
            $this->addError('paymentLines', $e->getMessage());

            return;
        }

        session()->flash('success', __('purchases.created', ['invoice' => $purchase->invoice_number]));

        $this->redirect(route('purchases.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.purchases.purchase-create', [
            'vendors' => Vendor::query()->where('is_active', true)->orderBy('name')->get(),
            'products' => Product::query()->where('is_active', true)->orderBy('name')->get(),
            'banks' => Bank::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
