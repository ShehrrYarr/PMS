<?php

declare(strict_types=1);

namespace App\Livewire\Customers;

use App\Enums\LedgerEntryType;
use App\Enums\TransactionReferenceType;
use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use App\Services\LedgerService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CustomerList extends Component
{
    use WithPagination;

    public CustomerForm $form;

    public string $search = '';

    public bool $showModal = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->authorize('create', Customer::class);

        $this->form->resetForm();
        $this->showModal = true;
    }

    public function edit(int $customerId): void
    {
        $customer = Customer::query()->findOrFail($customerId);
        $this->authorize('update', $customer);

        $this->form->setCustomer($customer);
        $this->showModal = true;
    }

    public function save(LedgerService $ledgerService): void
    {
        $this->authorize($this->form->customer === null ? 'create' : 'update', $this->form->customer ?? Customer::class);

        $this->form->validate();

        DB::transaction(function () use ($ledgerService) {
            $isNew = $this->form->customer === null;

            // opening_balance is only ever meaningful at creation, where it
            // seeds the customer's first ledger entry below — the running
            // balance shown everywhere else is computed from ledger entries,
            // never from this column. Excluding it from the update path
            // keeps it immutable once set, since there's no way to "edit" it
            // afterwards without an offsetting ledger adjustment.
            $customer = $isNew
                ? Customer::query()->create($this->form->attributesForSave())
                : tap($this->form->customer)->update(collect($this->form->attributesForSave())->except('opening_balance')->all());

            if ($isNew && bccomp($this->form->opening_balance, '0', 2) !== 0) {
                $ledgerService->postCustomerEntry(
                    customer: $customer,
                    type: LedgerEntryType::Debit,
                    amount: $this->form->opening_balance,
                    referenceType: TransactionReferenceType::Payment,
                    referenceId: $customer->id,
                    description: 'Opening balance',
                    user: auth()->user(),
                );
            }
        });

        $this->showModal = false;
        $this->form->resetForm();
    }

    public function toggleActive(int $customerId): void
    {
        $customer = Customer::query()->findOrFail($customerId);
        $this->authorize('update', $customer);

        $customer->update(['is_active' => ! $customer->is_active]);
    }

    public function render(): View
    {
        $customers = Customer::query()
            ->when($this->search !== '', fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.customers.customer-list', [
            'customers' => $customers,
        ]);
    }
}
