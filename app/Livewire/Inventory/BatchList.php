<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Livewire\Forms\BatchForm;
use App\Models\Batch;
use App\Models\Product;
use App\Services\BarcodeService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class BatchList extends Component
{
    use WithPagination;

    public BatchForm $form;

    #[Url(as: 'product')]
    public ?int $productFilter = null;

    public bool $showModal = false;

    public function create(): void
    {
        $this->authorize('batches.manage');

        $this->form->resetForm();

        if ($this->productFilter !== null) {
            $this->form->product_id = $this->productFilter;
        }

        $this->showModal = true;
    }

    public function edit(int $batchId): void
    {
        $this->authorize('batches.manage');

        $this->form->setBatch(Batch::query()->findOrFail($batchId));
        $this->showModal = true;
    }

    public function save(BarcodeService $barcodeService): void
    {
        $this->authorize('batches.manage');

        $this->form->validate();

        if ($this->form->batch === null) {
            $barcodeService->createBatchWithBarcode($this->form->attributesForCreate());
        } else {
            $this->form->batch->update($this->form->attributesForUpdate());
        }

        $this->showModal = false;
        $this->form->resetForm();
    }

    public function clearFilter(): void
    {
        $this->productFilter = null;
        $this->resetPage();
    }

    public function render(): View
    {
        $batches = Batch::query()
            ->with('product')
            ->when($this->productFilter !== null, fn ($query) => $query->where('product_id', $this->productFilter))
            ->orderBy('expiry_date')
            ->paginate(15);

        return view('livewire.inventory.batch-list', [
            'batches' => $batches,
            'products' => Product::query()->where('is_active', true)->orderBy('name')->get(),
            'filteredProduct' => $this->productFilter !== null ? Product::query()->find($this->productFilter) : null,
        ]);
    }
}
