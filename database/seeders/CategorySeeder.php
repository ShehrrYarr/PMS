<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the standard pesticide product categories for one shop.
     */
    public function run(int $shopId): void
    {
        collect(['Insecticide', 'Herbicide', 'Fungicide', 'Rodenticide'])
            ->each(fn (string $name) => Category::query()->firstOrCreate(['name' => $name, 'shop_id' => $shopId]));
    }
}
