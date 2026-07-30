<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ProductList extends Component
{
    use WithPagination;

    public ProductForm $form;

    public string $search = '';

    public ?int $companyId = null;

    public bool $showModal = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCompanyId(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->authorize('products.manage');

        $this->form->resetForm();
        $this->showModal = true;
    }

    public function edit(int $productId): void
    {
        $this->authorize('products.manage');

        $this->form->setProduct(Product::query()->findOrFail($productId));
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->authorize('products.manage');

        $this->form->validate();

        if ($this->form->product === null) {
            Product::query()->create($this->form->attributesForSave());
        } else {
            $this->form->product->update($this->form->attributesForSave());
        }

        $this->showModal = false;
        $this->form->resetForm();
    }

    public function toggleActive(int $productId): void
    {
        $this->authorize('products.manage');

        $product = Product::query()->findOrFail($productId);
        $product->update(['is_active' => ! $product->is_active]);
    }

    public function render(): View
    {
        $products = Product::query()
            ->with(['category', 'company'])
            ->when($this->search !== '', fn ($query) => $query->where(
                fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('sku', 'like', "%{$this->search}%")
            ))
            ->when($this->companyId !== null, fn ($query) => $query->where('company_id', $this->companyId))
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.inventory.product-list', [
            'products' => $products,
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
            'companies' => Company::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
