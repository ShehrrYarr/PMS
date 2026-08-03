<?php

declare(strict_types=1);

namespace App\Livewire\Customers;

use App\Enums\LedgerEntryType;
use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Enums\TransactionReferenceType;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\SaleReturn;
use App\Services\LedgerService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CustomerLedger extends Component
{
    use WithPagination;

    public Customer $customer;

    public string $dateFrom = '';

    public string $dateTo = '';

    #[Validate('required|numeric|min:0.01')]
    public string $paymentAmount = '';

    #[Validate('required|in:cash,bank')]
    public string $paymentMethod = 'cash';

    #[Validate('nullable|exists:banks,id')]
    public ?int $bankId = null;

    public bool $showPaymentModal = false;

    public function mount(Customer $customer): void
    {
        $this->authorize('customer-ledger.view');

        $this->customer = $customer;
    }

    public function updatingDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingDateTo(): void
    {
        $this->resetPage();
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
                'payable_type' => PayableType::Customer->value,
                'payable_id' => $this->customer->id,
                'method' => $this->paymentMethod,
                'bank_id' => $this->paymentMethod === PaymentMethod::Bank->value ? $this->bankId : null,
                'amount' => $this->paymentAmount,
                'user_id' => auth()->id(),
            ]);

            $ledgerService->postCustomerEntry(
                customer: $this->customer,
                type: LedgerEntryType::Credit,
                amount: $this->paymentAmount,
                referenceType: TransactionReferenceType::Payment,
                referenceId: $payment->id,
                description: __('ledger.payment_received'),
                user: auth()->user(),
            );
        });

        $this->showPaymentModal = false;
        $this->reset(['paymentAmount', 'paymentMethod', 'bankId']);
    }

    public function render(): View
    {
        $entries = $this->customer->ledgerEntries()
            ->when($this->dateFrom !== '', fn ($query) => $query->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo !== '', fn ($query) => $query->whereDate('created_at', '<=', $this->dateTo))
            ->latest('id')
            ->paginate(20);

        return view('livewire.customers.customer-ledger', [
            'entries' => $entries,
            'banks' => Bank::query()->where('is_active', true)->orderBy('name')->get(),
            'currentBalance' => $this->customer->currentBalance(),
            'saleIdsByReturnId' => $this->resolveSaleIdsByReturnId($entries),
        ]);
    }

    /**
     * Batch-resolves sale_return reference_ids to their parent sale_id in a
     * single query, so the ledger table can link straight back to the sale
     * without an N+1 lookup per row.
     *
     * @param  \Illuminate\Contracts\Pagination\LengthAwarePaginator<int, \App\Models\CustomerLedger>  $entries
     * @return array<int, int>
     */
    private function resolveSaleIdsByReturnId($entries): array
    {
        $returnIds = collect($entries->items())
            ->where('reference_type', TransactionReferenceType::SaleReturn->value)
            ->pluck('reference_id');

        if ($returnIds->isEmpty()) {
            return [];
        }

        return SaleReturn::query()->whereIn('id', $returnIds)->pluck('sale_id', 'id')->all();
    }
}
