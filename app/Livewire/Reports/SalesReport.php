<?php

declare(strict_types=1);

namespace App\Livewire\Reports;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\SalesReportService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
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

    public ?int $productId = null;

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

    public function updatingProductId(): void
    {
        $this->resetPage();
    }

    public function applyPreset(string $preset): void
    {
        $today = Carbon::today();

        [$from, $to] = match ($preset) {
            'today' => [$today, $today],
            'yesterday' => [$today->copy()->subDay(), $today->copy()->subDay()],
            'last_week' => [$today->copy()->subWeek()->startOfWeek(), $today->copy()->subWeek()->endOfWeek()],
            'last_month' => [$today->copy()->subMonthNoOverflow()->startOfMonth(), $today->copy()->subMonthNoOverflow()->endOfMonth()],
            'last_year' => [$today->copy()->subYear()->startOfYear(), $today->copy()->subYear()->endOfYear()],
            default => [null, null],
        };

        $this->dateFrom = $from?->format('Y-m-d') ?? '';
        $this->dateTo = $to?->format('Y-m-d') ?? '';
        $this->resetPage();
    }

    public function render(): View
    {
        $summary = app(SalesReportService::class)->summary(
            $this->dateFrom !== '' ? $this->dateFrom : null,
            $this->dateTo !== '' ? $this->dateTo : null,
            $this->customerId,
            $this->productId,
        );

        return view('livewire.reports.sales-report', [
            'sales' => $this->productId === null ? $this->salesQuery() : null,
            'saleItems' => $this->productId !== null ? $this->saleItemsQuery() : null,
            'summary' => $summary,
            'customers' => Customer::query()->orderBy('name')->get(),
            'products' => Product::query()->orderBy('name')->get(),
        ]);
    }

    private function salesQuery(): LengthAwarePaginator
    {
        return Sale::query()
            ->with(['customer', 'items'])
            ->when($this->dateFrom !== '', fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo !== '', fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->when($this->customerId !== null, fn ($q) => $q->where('customer_id', $this->customerId))
            ->orderByDesc('created_at')
            ->paginate(15);
    }

    private function saleItemsQuery(): LengthAwarePaginator
    {
        return SaleItem::query()
            ->select('sale_items.*')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->join('batches', 'batches.id', '=', 'sale_items.batch_id')
            ->where('batches.product_id', $this->productId)
            ->with(['sale.customer'])
            ->when($this->dateFrom !== '', fn ($q) => $q->whereDate('sales.created_at', '>=', $this->dateFrom))
            ->when($this->dateTo !== '', fn ($q) => $q->whereDate('sales.created_at', '<=', $this->dateTo))
            ->when($this->customerId !== null, fn ($q) => $q->where('sales.customer_id', $this->customerId))
            ->orderByDesc('sales.created_at')
            ->paginate(15);
    }
}
