<div>
    <x-page-header>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('super_admin.shops_title') }}</h2>
            <button type="button" wire:click="create" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                {{ __('super_admin.add_shop') }}
            </button>
        </div>
    </x-page-header>

    @if ($justCreatedTemporaryPassword)
        <div class="glass-panel-strong mb-4 p-4 sm:p-6 sm:mb-6">
            <h3 class="text-lg font-bold text-[var(--text-primary)]">{{ __('super_admin.temp_password_title') }}</h3>
            <p class="mt-1 text-sm text-[var(--text-secondary)]">{{ __('super_admin.temp_password_intro') }}</p>

            <dl class="mt-4 space-y-2 text-base">
                <div class="flex gap-2">
                    <dt class="font-semibold text-[var(--text-secondary)]">{{ __('super_admin.temp_password_email') }}:</dt>
                    <dd class="font-mono text-[var(--text-primary)]">{{ $justCreatedAdminEmail }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-semibold text-[var(--text-secondary)]">{{ __('super_admin.temp_password_password') }}:</dt>
                    <dd class="font-mono text-[var(--text-primary)]">{{ $justCreatedTemporaryPassword }}</dd>
                </div>
            </dl>

            <button type="button" wire:click="dismissTemporaryPassword" class="mt-4 min-h-[44px] rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                {{ __('super_admin.temp_password_dismiss') }}
            </button>
        </div>
    @endif

    <div class="glass-panel p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('super_admin.shop_name') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('super_admin.url') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('super_admin.users_count') }}</th>
                        <th class="px-3 py-2 text-center">{{ __('super_admin.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('super_admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shops as $shop)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">{{ $shop->name }}</td>
                            <td class="px-3 py-3 font-mono text-sm text-[var(--text-secondary)]">/{{ $shop->slug }}</td>
                            <td class="px-3 py-3 text-end">{{ $shop->users_count }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $shop->is_active ? 'bg-[var(--color-success)]/10 text-[var(--color-success)]' : 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]' }}">
                                    {{ $shop->is_active ? __('super_admin.active') : __('super_admin.suspended') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex flex-wrap justify-end gap-1">
                                    <button type="button" wire:click="edit({{ $shop->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                        {{ __('super_admin.edit') }}
                                    </button>
                                    <button
                                        type="button"
                                        wire:click="resetAdminPassword({{ $shop->id }})"
                                        onclick="return confirm('{{ __('super_admin.reset_password_confirm') }}')"
                                        class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5"
                                    >
                                        {{ __('super_admin.reset_password') }}
                                    </button>
                                    <button type="button" wire:click="toggleActive({{ $shop->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                        {{ $shop->is_active ? __('super_admin.suspend') : __('super_admin.activate') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('super_admin.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-glass-modal show="showCreateModal">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">{{ __('super_admin.add_shop') }}</h3>

            <div>
                <x-input-label for="name" :value="__('super_admin.shop_name')" />
                <x-text-input id="name" type="text" class="mt-1" wire:model="name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="adminName" :value="__('super_admin.admin_name')" />
                <x-text-input id="adminName" type="text" class="mt-1" wire:model="adminName" required />
                <x-input-error :messages="$errors->get('adminName')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="adminEmail" :value="__('super_admin.admin_email')" />
                <x-text-input id="adminEmail" type="email" class="mt-1" wire:model="adminEmail" required />
                <x-input-error :messages="$errors->get('adminEmail')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showCreateModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('super_admin.cancel') }}
                </button>
                <x-primary-button>{{ __('super_admin.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>

    <x-glass-modal show="showEditModal">
        <form wire:submit="saveEdit" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">{{ __('super_admin.edit_shop') }}</h3>

            <div>
                <x-input-label for="editName" :value="__('super_admin.shop_name')" />
                <x-text-input id="editName" type="text" class="mt-1" wire:model="editName" required autofocus />
                <x-input-error :messages="$errors->get('editName')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="editSlug" :value="__('super_admin.slug')" />
                <x-text-input id="editSlug" type="text" class="mt-1 font-mono" wire:model="editSlug" required />
                <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('super_admin.slug_hint') }}</p>
                <x-input-error :messages="$errors->get('editSlug')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showEditModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('super_admin.cancel') }}
                </button>
                <x-primary-button>{{ __('super_admin.save_edit') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
