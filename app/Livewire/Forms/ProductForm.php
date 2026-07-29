<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public string $name = '';

    public string $sku = '';

    public ?int $category_id = null;

    public string $unit = '';

    public string $default_sale_price = '0';

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
            'unit' => 'required|string|max:50',
            'default_sale_price' => 'required|numeric|min:0',
        ];
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->category_id = $product->category_id;
        $this->unit = $product->unit;
        $this->default_sale_price = (string) $product->default_sale_price;
    }

    /**
     * @return array<string, mixed>
     */
    public function attributesForSave(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
            'unit' => $this->unit,
            'default_sale_price' => $this->default_sale_price,
        ];
    }

    public function resetForm(): void
    {
        $this->product = null;
        $this->reset(['name', 'sku', 'category_id', 'unit']);
        $this->default_sale_price = '0';
    }
}
