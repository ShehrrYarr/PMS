<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Batch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;

/**
 * Owns barcode assignment for batches. A batch's barcode is derived from its
 * own id (guaranteed unique, never reused even if the batch is later
 * depleted) — see rules.md and architecture.md §3.7.
 */
class BarcodeService
{
    public function __construct(private readonly DNS1D $barcodeGenerator) {}

    /**
     * Create a batch and assign it a permanent barcode in one step, since the
     * barcode value is derived from the batch's own (post-insert) id.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function createBatchWithBarcode(array $attributes): Batch
    {
        return DB::transaction(function () use ($attributes) {
            $batch = Batch::query()->create([
                ...$attributes,
                'barcode' => (string) Str::uuid(),
            ]);

            $batch->update([
                'barcode' => 'BCH'.str_pad((string) $batch->id, 8, '0', STR_PAD_LEFT),
            ]);

            return $batch;
        });
    }

    public function renderSvg(string $code): string
    {
        return $this->barcodeGenerator->getBarcodeSVG($code, 'C128', 2, 60, 'black', true);
    }
}
