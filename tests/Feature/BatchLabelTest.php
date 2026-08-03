<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Batch;
use App\Models\Product;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BatchLabelTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_label_route_renders_for_a_real_batch(): void
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Admin->value);

        $product = Product::factory()->create(['shop_id' => $user->shop_id]);
        $batch = app(BarcodeService::class)->createBatchWithBarcode([
            'shop_id' => $user->shop_id,
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '60.00',
            'quantity_received' => '10',
            'quantity_remaining' => '10',
        ]);

        $response = $this->actingAs($user)->get($this->shopPath($user, "batches/{$batch->id}/label"));

        $response->assertOk();
        $response->assertSee($batch->barcode);
    }
}
