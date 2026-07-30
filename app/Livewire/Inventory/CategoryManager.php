<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CategoryManager extends Component
{
    public ?int $editingCategoryId = null;

    public string $name = '';

    public bool $showModal = false;

    public function create(): void
    {
        $this->authorize('products.manage');

        $this->reset(['editingCategoryId', 'name']);
        $this->showModal = true;
    }

    public function edit(int $categoryId): void
    {
        $this->authorize('products.manage');

        $category = Category::query()->findOrFail($categoryId);
        $this->editingCategoryId = $category->id;
        $this->name = $category->name;
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
                Rule::unique('categories', 'name')->where('shop_id', Auth::user()->shop_id)->ignore($this->editingCategoryId),
            ],
        ]);

        if ($this->editingCategoryId === null) {
            Category::query()->create(['name' => $this->name]);
        } else {
            Category::query()->whereKey($this->editingCategoryId)->update(['name' => $this->name]);
        }

        $this->showModal = false;
        $this->reset(['editingCategoryId', 'name']);
    }

    public function toggleActive(int $categoryId): void
    {
        $this->authorize('products.manage');

        $category = Category::query()->findOrFail($categoryId);
        $category->update(['is_active' => ! $category->is_active]);
    }

    public function render(): View
    {
        return view('livewire.inventory.category-manager', [
            'categories' => Category::query()->withCount('products')->orderBy('name')->get(),
        ]);
    }
}
