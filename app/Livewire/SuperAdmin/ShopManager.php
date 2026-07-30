<?php

declare(strict_types=1);

namespace App\Livewire\SuperAdmin;

use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.super-admin')]
class ShopManager extends Component
{
    public bool $showCreateModal = false;

    public string $name = '';

    public string $adminName = '';

    public string $adminEmail = '';

    public ?string $justCreatedAdminEmail = null;

    public ?string $justCreatedTemporaryPassword = null;

    public bool $showEditModal = false;

    public ?int $editingShopId = null;

    public string $editName = '';

    public string $editSlug = '';

    public function create(): void
    {
        $this->reset(['name', 'adminName', 'adminEmail']);
        $this->resetValidation();
        $this->showCreateModal = true;
    }

    public function save(ShopService $shopService): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'adminName' => ['required', 'string', 'max:255'],
            'adminEmail' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
        ]);

        $result = $shopService->createShop($validated['name'], $validated['adminName'], $validated['adminEmail']);

        $this->showCreateModal = false;
        $this->reset(['name', 'adminName', 'adminEmail']);

        $this->justCreatedAdminEmail = $result['admin']->email;
        $this->justCreatedTemporaryPassword = $result['temporaryPassword'];
    }

    public function dismissTemporaryPassword(): void
    {
        $this->justCreatedAdminEmail = null;
        $this->justCreatedTemporaryPassword = null;
    }

    public function toggleActive(int $shopId): void
    {
        $shop = Shop::query()->findOrFail($shopId);
        $shop->update(['is_active' => ! $shop->is_active]);
    }

    public function edit(int $shopId): void
    {
        $shop = Shop::query()->findOrFail($shopId);

        $this->editingShopId = $shop->id;
        $this->editName = $shop->name;
        $this->editSlug = $shop->slug;
        $this->resetValidation();
        $this->showEditModal = true;
    }

    public function saveEdit(ShopService $shopService): void
    {
        $shop = Shop::query()->findOrFail($this->editingShopId);

        $validated = $this->validate([
            'editName' => ['required', 'string', 'max:255'],
            'editSlug' => [
                'required', 'string', 'max:255', 'alpha_dash',
                Rule::unique('shops', 'slug')->ignore($shop->id),
            ],
        ]);

        $shopService->updateShop($shop, $validated['editName'], $validated['editSlug']);

        $this->showEditModal = false;
        $this->reset(['editingShopId', 'editName', 'editSlug']);
    }

    public function resetAdminPassword(int $shopId, ShopService $shopService): void
    {
        $shop = Shop::query()->findOrFail($shopId);

        $result = $shopService->resetAdminPassword($shop);

        $this->justCreatedAdminEmail = $result['admin']->email;
        $this->justCreatedTemporaryPassword = $result['temporaryPassword'];
    }

    public function render(): View
    {
        return view('livewire.super-admin.shop-manager', [
            // withCount('users') builds a subquery through User's own
            // BelongsToShop scope — if this Super Admin's browser also
            // happens to carry an active 'web' session (same session cookie,
            // different guard key), that scope would silently narrow every
            // shop's user count down to whichever shop that session's user
            // belongs to. This panel must never depend on ambient 'web'
            // auth state, so the scope is stripped explicitly.
            'shops' => Shop::query()
                ->withCount(['users' => fn ($query) => $query->withoutGlobalScope('shop')])
                ->latest('id')
                ->get(),
        ]);
    }
}
