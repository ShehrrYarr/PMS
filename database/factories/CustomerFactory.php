<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // See UserFactory for why this reuses the existing shop.
            'shop_id' => Shop::query()->value('id') ?? Shop::factory()->create()->id,
            'name' => fake()->name(),
            'phone' => fake()->numerify('03##-#######'),
            'address' => fake()->address(),
            'opening_balance' => 0,
            'is_active' => true,
        ];
    }
}
