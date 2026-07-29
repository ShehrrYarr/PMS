<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Batch;
use Livewire\Form;

class BatchForm extends Form
{
    public ?Batch $batch = null;

    public ?int $product_id = null;

    public string $manufacturing_date = '';

    public string $expiry_date = '';

    public string $cost_price = '';

    public string $quantity_received = '';

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'manufacturing_date' => 'required|date',
            'expiry_date' => 'required|date|after:manufacturing_date',
            'cost_price' => 'required|numeric|min:0',
            'quantity_received' => 'required|numeric|min:0.01',
        ];
    }

    public function setBatch(Batch $batch): void
    {
        $this->batch = $batch;
        $this->product_id = $batch->product_id;
        $this->manufacturing_date = $batch->manufacturing_date->toDateString();
        $this->expiry_date = $batch->expiry_date->toDateString();
        $this->cost_price = (string) $batch->cost_price;
        $this->quantity_received = (string) $batch->quantity_received;
    }

    /**
     * @return array<string, mixed>
     */
    public function attributesForCreate(): array
    {
        return [
            'product_id' => $this->product_id,
            'manufacturing_date' => $this->manufacturing_date,
            'expiry_date' => $this->expiry_date,
            'cost_price' => $this->cost_price,
            'quantity_received' => $this->quantity_received,
            'quantity_remaining' => $this->quantity_received,
        ];
    }

    /**
     * Dates/cost only — quantity changes must go through purchase/return
     * flows (Phase 4/5), never a raw batch edit.
     *
     * @return array<string, mixed>
     */
    public function attributesForUpdate(): array
    {
        return [
            'manufacturing_date' => $this->manufacturing_date,
            'expiry_date' => $this->expiry_date,
            'cost_price' => $this->cost_price,
        ];
    }

    public function resetForm(): void
    {
        $this->batch = null;
        $this->reset(['product_id', 'manufacturing_date', 'expiry_date', 'cost_price', 'quantity_received']);
    }
}
