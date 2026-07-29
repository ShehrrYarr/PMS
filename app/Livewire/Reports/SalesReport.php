<?php

declare(strict_types=1);

namespace App\Livewire\Reports;

use App\Models\Customer;
use App\Models\Sale;
use App\Services\SalesReportService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class SalesReport extends Component
{
    use WithPagination;

    public string $dateFrom = '';

    public string $dateTo = '';

    public ?int $customerId = null;

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

    public function updatingCustomerId(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $sales = Sale::query()
            ->with(['customer', 'items'])
            ->when($this->dateFrom !== '', fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo !== '', fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->when($this->customerId !== null, fn ($q) => $q->where('customer_id', $this->customerId))
            ->orderByDesc('created_at')
            ->paginate(15);

        $summary = app(SalesReportService::class)->summary(
            $this->dateFrom !== '' ? $this->dateFrom : null,
            $this->dateTo !== '' ? $this->dateTo : null,
            $this->customerId,
        );

        return view('livewire.reports.sales-report', [
            'sales' => $sales,
            'summary' => $summary,
            'customers' => Customer::query()->orderBy('name')->get(),
        ]);
    }
}
