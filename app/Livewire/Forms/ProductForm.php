<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public string $name = '';

    public string $sku = '';

    public ?int $category_id = null;

    public ?int $company_id = null;

    public string $unit = '';

    public string $default_sale_price = '0';

    /** A newly chosen image, not yet saved. Optional — a product never needs one. */
    public ?TemporaryUploadedFile $image = null;

    /** The image already stored on the product being edited, if any. */
    public ?string $existingImagePath = null;

    /** Set when the cashier removes the stored image without choosing a new one. */
    public bool $removeImage = false;

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($this->product?->id),
            ],
            'category_id' => 'nullable|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',
            'unit' => 'required|string|max:50',
            'default_sale_price' => 'required|numeric|min:0',
            // No svg, for the same stored-XSS reason as the shop logo (see
            // SettingsPage::ALLOWED_LOGO_EXTENSIONS). 2 MB matches cPanel's
            // stock upload_max_filesize; the browser shrinks photos well below
            // that before uploading (resources/js/image-upload.js).
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->category_id = $product->category_id;
        $this->company_id = $product->company_id;
        $this->unit = $product->unit;
        $this->default_sale_price = (string) $product->default_sale_price;
        $this->image = null;
        $this->existingImagePath = $product->image_path;
        $this->removeImage = false;
    }

    /**
     * The image is handled separately (see ProductList::save()) — it can only
     * be stored once the product has an id to name the file after.
     *
     * @return array<string, mixed>
     */
    public function attributesForSave(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
            'company_id' => $this->company_id,
            'unit' => $this->unit,
            'default_sale_price' => $this->default_sale_price,
        ];
    }

    public function resetForm(): void
    {
        $this->product = null;
        $this->reset(['name', 'sku', 'category_id', 'company_id', 'unit', 'image', 'existingImagePath', 'removeImage']);
        $this->default_sale_price = '0';
    }
}
