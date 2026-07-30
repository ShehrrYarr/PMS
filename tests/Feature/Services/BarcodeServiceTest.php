<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\Batch;
use App\Models\Product;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarcodeServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function baseAttributes(): array
    {
        return [
            'product_id' => Product::factory()->create()->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '400.00',
            'quantity_received' => '10',
            'quantity_remaining' => '10',
        ];
    }

    public function test_a_manual_barcode_is_used_as_is_when_provided(): void
    {
        $batch = app(BarcodeService::class)->createBatchWithBarcode([
            ...$this->baseAttributes(),
            'barcode' => 'MFR-CODE-12345',
        ]);

        $this->assertSame('MFR-CODE-12345', $batch->barcode);
    }

    public function test_a_barcode_is_auto_generated_when_none_is_provided(): void
    {
        $batch = app(BarcodeService::class)->createBatchWithBarcode($this->baseAttributes());

        $this->assertSame('BCH'.str_pad((string) $batch->id, 8, '0', STR_PAD_LEFT), $batch->barcode);
    }

    public function test_a_barcode_is_auto_generated_when_an_empty_string_is_provided(): void
    {
        $batch = app(BarcodeService::class)->createBatchWithBarcode([
            ...$this->baseAttributes(),
            'barcode' => '',
        ]);

        $this->assertSame('BCH'.str_pad((string) $batch->id, 8, '0', STR_PAD_LEFT), $batch->barcode);
    }

    public function test_creating_a_second_batch_with_a_duplicate_manual_barcode_fails_at_the_database_level(): void
    {
        app(BarcodeService::class)->createBatchWithBarcode([
            ...$this->baseAttributes(),
            'barcode' => 'DUP-CODE',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        app(BarcodeService::class)->createBatchWithBarcode([
            ...$this->baseAttributes(),
            'barcode' => 'DUP-CODE',
        ]);
    }
}
