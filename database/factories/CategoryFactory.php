<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
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
            'name' => fake()->unique()->words(2, true),
            'is_active' => true,
        ];
    }
}
