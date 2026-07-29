<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Enums\LedgerEntryType;
use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Enums\TransactionReferenceType;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\Vendor;
use App\Services\LedgerService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class VendorLedger extends Component
{
    use WithPagination;

    public Vendor $vendor;

    public string $dateFrom = '';

    public string $dateTo = '';

    #[Validate('required|numeric|min:0.01')]
    public string $paymentAmount = '';

    #[Validate('required|in:cash,bank')]
    public string $paymentMethod = 'cash';

    #[Validate('nullable|exists:banks,id')]
    public ?int $bankId = null;

    public bool $showPaymentModal = false;

    public function mount(Vendor $vendor): void
    {
        $this->authorize('vendor-ledger.view');

        $this->vendor = $vendor;
    }

    public function openPaymentForm(): void
    {
        $this->authorize('payments.manage');

        $this->reset(['paymentAmount', 'paymentMethod', 'bankId']);
        $this->paymentMethod = PaymentMethod::Cash->value;
        $this->showPaymentModal = true;
    }

    public function recordPayment(LedgerService $ledgerService): void
    {
        $this->authorize('payments.manage');

        $this->validate();

        if ($this->paymentMethod === PaymentMethod::Bank->value && $this->bankId === null) {
            $this->addError('bankId', __('ledger.bank_required'));

            return;
        }

        DB::transaction(function () use ($ledgerService) {
            $payment = Payment::query()->create([
                'payable_type' => PayableType::Vendor->value,
                'payable_id' => $this->vendor->id,
                'method' => $this->paymentMethod,
                'bank_id' => $this->paymentMethod === PaymentMethod::Bank->value ? $this->bankId : null,
                'amount' => $this->paymentAmount,
                'user_id' => auth()->id(),
            ]);

            $ledgerService->postVendorEntry(
                vendor: $this->vendor,
                type: LedgerEntryType::Debit,
                amount: $this->paymentAmount,
                referenceType: TransactionReferenceType::Payment,
                referenceId: $payment->id,
                description: __('ledger.payment_made'),
                user: auth()->user(),
            );
        });

        $this->showPaymentModal = false;
        $this->reset(['paymentAmount', 'paymentMethod', 'bankId']);
    }

    public function render(): View
    {
        $entries = $this->vendor->ledgerEntries()
            ->when($this->dateFrom !== '', fn ($query) => $query->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo !== '', fn ($query) => $query->whereDate('created_at', '<=', $this->dateTo))
            ->latest('id')
            ->paginate(20);

        return view('livewire.vendors.vendor-ledger', [
            'entries' => $entries,
            'banks' => Bank::query()->where('is_active', true)->orderBy('name')->get(),
            'currentBalance' => $this->vendor->currentBalance(),
        ]);
    }
}
