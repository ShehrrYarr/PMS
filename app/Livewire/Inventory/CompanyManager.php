<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CompanyManager extends Component
{
    public ?int $editingCompanyId = null;

    public string $name = '';

    public bool $showModal = false;

    public function create(): void
    {
        $this->authorize('products.manage');

        $this->reset(['editingCompanyId', 'name']);
        $this->showModal = true;
    }

    public function edit(int $companyId): void
    {
        $this->authorize('products.manage');

        $company = Company::query()->findOrFail($companyId);
        $this->editingCompanyId = $company->id;
        $this->name = $company->name;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->authorize('products.manage');

        $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'name')->ignore($this->editingCompanyId),
            ],
        ]);

        if ($this->editingCompanyId === null) {
            Company::query()->create(['name' => $this->name]);
        } else {
            Company::query()->whereKey($this->editingCompanyId)->update(['name' => $this->name]);
        }

        $this->showModal = false;
        $this->reset(['editingCompanyId', 'name']);
    }

    public function toggleActive(int $companyId): void
    {
        $this->authorize('products.manage');

        $company = Company::query()->findOrFail($companyId);
        $company->update(['is_active' => ! $company->is_active]);
    }

    public function render(): View
    {
        return view('livewire.inventory.company-manager', [
            'companies' => Company::query()->withCount('products')->orderBy('name')->get(),
        ]);
    }
}
