<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the standard pesticide product categories.
     */
    public function run(): void
    {
        collect(['Insecticide', 'Herbicide', 'Fungicide', 'Rodenticide'])
            ->each(fn (string $name) => Category::query()->firstOrCreate(['name' => $name]));
    }
}
