<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Read-only stock overview: every product with how many batches it has and
 * how many units remain across them, aggregated in one query rather than
 * per-product N+1 sums (see Product::totalRemainingQuantity(), which product-
 * list.blade.php already accepts that cost for on its own smaller listing).
 */
#[Layout('layouts.app')]
class InventorySummary extends Component
{
    use WithPagination;

    public string $search = '';

    public ?int $companyId = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCompanyId(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $products = Product::query()
            ->withCount('batches')
            ->withSum('batches', 'quantity_remaining')
            ->withSum('batches', 'quantity_received')
            ->with('company')
            ->when($this->search !== '', fn ($query) => $query->where(
                fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('sku', 'like', "%{$this->search}%")
            ))
            ->when($this->companyId !== null, fn ($query) => $query->where('company_id', $this->companyId))
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.inventory.inventory-summary', [
            'products' => $products,
            'companies' => Company::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
