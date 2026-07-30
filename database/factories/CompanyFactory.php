<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
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
            'name' => fake()->unique()->company(),
            'is_active' => true,
        ];
    }
}
