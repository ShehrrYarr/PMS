<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Bank;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class BankAccountManager extends Component
{
    public ?int $editingBankId = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:100')]
    public string $accountNumber = '';

    public bool $showModal = false;

    public function create(): void
    {
        $this->authorize('bank-accounts.manage');

        $this->reset(['editingBankId', 'name', 'accountNumber']);
        $this->showModal = true;
    }

    public function edit(int $bankId): void
    {
        $this->authorize('bank-accounts.manage');

        $bank = Bank::query()->findOrFail($bankId);
        $this->editingBankId = $bank->id;
        $this->name = $bank->name;
        $this->accountNumber = (string) $bank->account_number;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->authorize('bank-accounts.manage');

        $this->validate();

        $attributes = [
            'name' => $this->name,
            'account_number' => $this->accountNumber !== '' ? $this->accountNumber : null,
        ];

        if ($this->editingBankId === null) {
            Bank::query()->create($attributes);
        } else {
            Bank::query()->whereKey($this->editingBankId)->update($attributes);
        }

        $this->showModal = false;
        $this->reset(['editingBankId', 'name', 'accountNumber']);
    }

    public function toggleActive(int $bankId): void
    {
        $this->authorize('bank-accounts.manage');

        $bank = Bank::query()->findOrFail($bankId);
        $bank->update(['is_active' => ! $bank->is_active]);
    }

    public function render(): View
    {
        return view('livewire.admin.bank-account-manager', [
            'banks' => Bank::query()->orderBy('name')->get(),
        ]);
    }
}
