<?php

declare(strict_types=1);

namespace App\Livewire\Reports;

use App\Models\Purchase;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class PurchaseReport extends Component
{
    use WithPagination;

    public string $dateFrom = '';

    public string $dateTo = '';

    public ?int $vendorId = null;

    public function mount(): void
    {
        $this->authorize('reports.view');
    }

    public function updatingDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingDateTo(): void
    {
        $this->resetPage();
    }

    public function updatingVendorId(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Purchase::query()
            ->when($this->dateFrom !== '', fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo !== '', fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->when($this->vendorId !== null, fn ($q) => $q->where('vendor_id', $this->vendorId));

        $purchasesTotal = bcadd((string) (clone $query)->sum('total_amount'), '0.00', 2);

        $purchases = (clone $query)->with('vendor')->orderByDesc('created_at')->paginate(15);

        return view('livewire.reports.purchase-report', [
            'purchases' => $purchases,
            'purchasesTotal' => $purchasesTotal,
            'vendors' => Vendor::query()->orderBy('name')->get(),
        ]);
    }
}
