<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vendor>
 */
class VendorFactory extends Factory
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
            'name' => fake()->company(),
            'phone' => fake()->numerify('03##-#######'),
            'address' => fake()->address(),
            'opening_balance' => 0,
            'is_active' => true,
        ];
    }
}
