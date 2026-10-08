<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ProductList extends Component
{
    use WithFileUploads, WithPagination;

    /**
     * The stored extension follows the validated MIME type, never the
     * client-supplied filename — same reasoning as the shop logo (see
     * SettingsPage::ALLOWED_LOGO_EXTENSIONS).
     */
    private const IMAGE_EXTENSIONS = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    public ProductForm $form;

    public string $search = '';

    public ?int $companyId = null;

    public bool $showModal = false;

    /**
     * Bumped every time the modal opens. Keys the image picker so its
     * browser-side preview starts empty, rather than carrying the last
     * product's photo into a fresh "Add Product" form.
     */
    public int $formVersion = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCompanyId(): void
    {
        $this->resetPage();
    }

    /** Reports a rejected image as soon as it's picked, not only on Save. */
    public function updatedFormImage(): void
    {
        $this->validateOnly('form.image');
        $this->form->removeImage = false;
    }

    public function create(): void
    {
        $this->authorize('products.manage');

        $this->form->resetForm();
        $this->resetValidation();
        $this->formVersion++;
        $this->showModal = true;
    }

    public function edit(int $productId): void
    {
        $this->authorize('products.manage');

        $this->form->setProduct(Product::query()->findOrFail($productId));
        $this->resetValidation();
        $this->formVersion++;
        $this->showModal = true;
    }

    public function removeImage(): void
    {
        $this->authorize('products.manage');

        $this->form->image = null;
        $this->form->removeImage = true;
        $this->resetValidation('form.image');
    }

    public function save(): void
    {
        $this->authorize('products.manage');

        $this->form->validate();

        if ($this->form->product === null) {
            $product = Product::query()->create($this->form->attributesForSave());
        } else {
            $product = $this->form->product;
            $product->update($this->form->attributesForSave());
        }

        if ($this->form->image !== null) {
            $this->storeImage($product, $this->form->image);
        } elseif ($this->form->removeImage) {
            $this->deleteImage($product);
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

    /**
     * Each upload gets a fresh filename rather than overwriting the old one,
     * so a browser or the offline till's image cache can never keep showing
     * the previous photo under the same URL.
     */
    private function storeImage(Product $product, TemporaryUploadedFile $image): void
    {
        $this->deleteImage($product);

        $extension = self::IMAGE_EXTENSIONS[$image->getMimeType()] ?? 'jpg';
        $path = $image->storeAs(
            "products/{$product->shop_id}",
            "{$product->id}-".Str::lower(Str::random(10)).".{$extension}",
            'public',
        );

        $product->update(['image_path' => $path]);
    }

    private function deleteImage(Product $product): void
    {
        if ($product->image_path === null) {
            return;
        }

        Storage::disk('public')->delete($product->image_path);
        $product->update(['image_path' => null]);
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
