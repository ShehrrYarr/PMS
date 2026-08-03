<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    public ?Customer $customer = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:30|regex:/^[0-9+\-\s()]+$/')]
    public string $phone = '';

    #[Validate('nullable|string|max:1000')]
    public string $address = '';

    #[Validate('required|numeric|min:0')]
    public string $opening_balance = '0';

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
        $this->name = $customer->name;
        $this->phone = (string) $customer->phone;
        $this->address = (string) $customer->address;
        $this->opening_balance = (string) $customer->opening_balance;
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
        $this->customer = null;
        $this->reset(['name', 'phone', 'address']);
        $this->opening_balance = '0';
    }
}
