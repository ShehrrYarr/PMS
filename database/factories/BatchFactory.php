<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantityReceived = fake()->randomFloat(2, 10, 200);

        // Created eagerly (not passed as a lazy Product::factory() attribute)
        // so shop_id is known synchronously below — a batch must always
        // belong to the same shop as its product.
        $product = Product::factory()->create();

        return [
            'shop_id' => $product->shop_id,
            'product_id' => $product->id,
            'barcode' => strtoupper('BCH'.fake()->unique()->numerify('########')),
            'manufacturing_date' => fake()->dateTimeBetween('-1 year', '-1 month'),
            'expiry_date' => fake()->dateTimeBetween('+1 month', '+2 years'),
            'cost_price' => fake()->randomFloat(2, 50, 3000),
            'quantity_received' => $quantityReceived,
            'quantity_remaining' => $quantityReceived,
            'purchase_item_id' => null,
        ];
    }
}
