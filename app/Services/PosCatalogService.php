<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Batch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\User;

/**
 * The product grid's data, in one shape shared by the live POS (fetched by
 * Pos::catalog()) and the offline till (shipped inside OfflineDataService's
 * snapshot). Both screens hand it to the same client-side grid
 * (resources/js/pos/catalog.js), so the two can never drift apart.
 *
 * Batches stay a flat list rather than being nested under products: the
 * offline till already looks batches up by barcode and decrements their
 * stock in place (resources/js/offline/pos-engine.js), and that code keeps
 * working unchanged.
 */
class PosCatalogService
{
    /**
     * @return array{products: list<array<string, mixed>>, batches: list<array<string, mixed>>, categories: list<array{id: int, name: string}>, companies: list<array{id: int, name: string}>}
     */
    public function forUser(User $user): array
    {
        return [
            'products' => $this->products(),
            'batches' => $this->batches($user->can('cost-prices.view')),
            'categories' => $this->categories(),
            'companies' => $this->companies(),
        ];
    }

    /**
     * Every active product, including ones with no stock left — the grid
     * shows those greyed out rather than hiding them.
     *
     * @return list<array<string, mixed>>
     */
    private function products(): array
    {
        return Product::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'sku', 'unit', 'default_sale_price', 'category_id', 'company_id', 'image_path'])
            ->map(fn (Product $product) => [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'unit' => $product->unit,
                'unit_price' => (string) $product->default_sale_price,
                'category_id' => $product->category_id,
                'company_id' => $product->company_id,
                'image_url' => $product->imageUrl(),
            ])
            ->values()
            ->all();
    }

    /**
     * Only batches that can actually be sold, earliest expiry first — the
     * order the batch pop-up lists them in. A batch at or below zero is
     * omitted rather than sent with a zero count.
     *
     * Cost price is included only for users allowed to see it; leaving the
     * key out entirely (rather than nulling it) keeps it out of a Salesman's
     * browser, including the offline till's stored snapshot.
     *
     * @return list<array<string, mixed>>
     */
    private function batches(bool $includeCostPrice): array
    {
        return Batch::query()
            ->with('product:id,name,default_sale_price,unit')
            ->where('quantity_remaining', '>', 0)
            ->whereHas('product', fn ($query) => $query->where('is_active', true))
            ->orderBy('expiry_date')
            ->orderBy('id')
            ->get()
            ->map(fn (Batch $batch) => [
                'id' => $batch->id,
                'product_id' => $batch->product_id,
                'barcode' => $batch->barcode,
                'product_name' => $batch->product->name,
                'unit' => $batch->product->unit,
                'unit_price' => (string) $batch->product->default_sale_price,
                'quantity_remaining' => (string) $batch->quantity_remaining,
                'manufacturing_date' => $batch->manufacturing_date->toDateString(),
                'expiry_date' => $batch->expiry_date->toDateString(),
            ] + ($includeCostPrice ? ['cost_price' => (string) $batch->cost_price] : []))
            ->values()
            ->all();
    }

    /**
     * @return list<array{id: int, name: string}>
     */
    private function categories(): array
    {
        return Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (Category $category) => ['id' => $category->id, 'name' => $category->name])
            ->values()
            ->all();
    }

    /**
     * @return list<array{id: int, name: string}>
     */
    private function companies(): array
    {
        return Company::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (Company $company) => ['id' => $company->id, 'name' => $company->name])
            ->values()
            ->all();
    }
}
