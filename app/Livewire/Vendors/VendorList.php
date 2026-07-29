<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Enums\LedgerEntryType;
use App\Enums\TransactionReferenceType;
use App\Livewire\Forms\VendorForm;
use App\Models\Vendor;
use App\Services\LedgerService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class VendorList extends Component
{
    use WithPagination;

    public VendorForm $form;

    public string $search = '';

    public bool $showModal = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->authorize('create', Vendor::class);

        $this->form->resetForm();
        $this->showModal = true;
    }

    public function edit(int $vendorId): void
    {
        $vendor = Vendor::query()->findOrFail($vendorId);
        $this->authorize('update', $vendor);

        $this->form->setVendor($vendor);
        $this->showModal = true;
    }

    public function save(LedgerService $ledgerService): void
    {
        $this->authorize($this->form->vendor === null ? 'create' : 'update', $this->form->vendor ?? Vendor::class);

        $this->form->validate();

        DB::transaction(function () use ($ledgerService) {
            $isNew = $this->form->vendor === null;

            $vendor = $isNew
                ? Vendor::query()->create($this->form->attributesForSave())
                : tap($this->form->vendor)->update($this->form->attributesForSave());

            if ($isNew && bccomp($this->form->opening_balance, '0', 2) !== 0) {
                $ledgerService->postVendorEntry(
                    vendor: $vendor,
                    type: LedgerEntryType::Credit,
                    amount: $this->form->opening_balance,
                    referenceType: TransactionReferenceType::Payment,
                    referenceId: $vendor->id,
                    description: 'Opening balance',
                    user: auth()->user(),
                );
            }
        });

        $this->showModal = false;
        $this->form->resetForm();
    }

    public function toggleActive(int $vendorId): void
    {
        $vendor = Vendor::query()->findOrFail($vendorId);
        $this->authorize('update', $vendor);

        $vendor->update(['is_active' => ! $vendor->is_active]);
    }

    public function render(): View
    {
        $vendors = Vendor::query()
            ->when($this->search !== '', fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.vendors.vendor-list', [
            'vendors' => $vendors,
        ]);
    }
}
