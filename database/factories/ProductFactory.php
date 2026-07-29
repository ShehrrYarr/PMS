<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-####??')),
            'category_id' => null,
            'unit' => fake()->randomElement(['Liter', 'Kg', 'Bottle', 'Bag']),
            'default_sale_price' => fake()->randomFloat(2, 100, 5000),
            'is_active' => true,
        ];
    }
}
