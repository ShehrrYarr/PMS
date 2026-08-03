<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Vendor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VendorForm extends Form
{
    public ?Vendor $vendor = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:30|regex:/^[0-9+\-\s()]+$/')]
    public string $phone = '';

    #[Validate('nullable|string|max:1000')]
    public string $address = '';

    #[Validate('required|numeric|min:0')]
    public string $opening_balance = '0';

    public function setVendor(Vendor $vendor): void
    {
        $this->vendor = $vendor;
        $this->name = $vendor->name;
        $this->phone = (string) $vendor->phone;
        $this->address = (string) $vendor->address;
        $this->opening_balance = (string) $vendor->opening_balance;
    }

    /**
     * @return array<string, mixed>
     */
    public function attributesForSave(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone !== '' ? $this->phone : null,
            'address' => $this->address !== '' ? $this->address : null,
            'opening_balance' => $this->opening_balance,
        ];
    }

    public function resetForm(): void
    {
        $this->vendor = null;
        $this->reset(['name', 'phone', 'address']);
        $this->opening_balance = '0';
    }
}
