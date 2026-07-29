<div>
    <x-page-header>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('vendors.title') }}</h2>
            @can('create', App\Models\Vendor::class)
                <button type="button" wire:click="create" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                    {{ __('vendors.add') }}
                </button>
            @endcan
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="{{ __('vendors.search') }}"
            class="mb-4 min-h-[44px] w-full max-w-sm rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
        >

        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('vendors.name') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('vendors.phone') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('vendors.balance') }}</th>
                        <th class="px-3 py-2 text-center">{{ __('vendors.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('vendors.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vendors as $vendor)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">{{ $vendor->name }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $vendor->phone ?? '—' }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $vendor->currentBalance(), 2) }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $vendor->is_active ? 'bg-[var(--color-success)]/10 text-[var(--color-success)]' : 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]' }}">
                                    {{ $vendor->is_active ? __('vendors.active') : __('vendors.inactive') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('vendors.ledger', $vendor) }}" wire:navigate class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                        {{ __('vendors.ledger') }}
                                    </a>
                                    @can('update', $vendor)
                                        <button type="button" wire:click="edit({{ $vendor->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                            {{ __('vendors.edit') }}
                                        </button>
                                        <button type="button" wire:click="toggleActive({{ $vendor->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                            {{ $vendor->is_active ? __('vendors.deactivate') : __('vendors.activate') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('vendors.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vendors->links() }}
        </div>
    </div>

    <x-glass-modal show="showModal">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">
                {{ $form->vendor ? __('vendors.edit') : __('vendors.add') }}
            </h3>

            <div>
                <x-input-label for="name" :value="__('vendors.name')" />
                <x-text-input id="name" type="text" class="mt-1" wire:model="form.name" required />
                <x-input-error :messages="$errors->get('form.name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('vendors.phone')" />
                <x-text-input id="phone" type="text" class="mt-1" wire:model="form.phone" />
                <x-input-error :messages="$errors->get('form.phone')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="address" :value="__('vendors.address')" />
                <x-text-input id="address" type="text" class="mt-1" wire:model="form.address" />
                <x-input-error :messages="$errors->get('form.address')" class="mt-1" />
            </div>

            @unless ($form->vendor)
                <div>
                    <x-input-label for="opening_balance" :value="__('vendors.opening_balance')" />
                    <x-text-input id="opening_balance" type="number" step="0.01" min="0" class="mt-1" wire:model="form.opening_balance" />
                    <x-input-error :messages="$errors->get('form.opening_balance')" class="mt-1" />
                </div>
            @endunless

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('vendors.cancel') }}
                </button>
                <x-primary-button>{{ __('vendors.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
