<div>
    <x-page-header>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('customers.title') }}</h2>
            @can('create', App\Models\Customer::class)
                <button type="button" wire:click="create" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                    {{ __('customers.add') }}
                </button>
            @endcan
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="{{ __('customers.search') }}"
            class="mb-4 min-h-[44px] w-full max-w-sm rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
        >

        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('customers.name') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('customers.phone') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('customers.balance') }}</th>
                        <th class="px-3 py-2 text-center">{{ __('customers.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('customers.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">{{ $customer->name }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $customer->phone ?? '—' }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ money($customer->currentBalance()) }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $customer->is_active ? 'bg-[var(--color-success)]/10 text-[var(--color-success)]' : 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]' }}">
                                    {{ $customer->is_active ? __('customers.active') : __('customers.inactive') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('customers.ledger', $customer) }}" wire:navigate class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                        {{ __('customers.ledger') }}
                                    </a>
                                    @can('update', $customer)
                                        <button type="button" wire:click="edit({{ $customer->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                            {{ __('customers.edit') }}
                                        </button>
                                        <button type="button" wire:click="toggleActive({{ $customer->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                            {{ $customer->is_active ? __('customers.deactivate') : __('customers.activate') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('customers.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>

    <x-glass-modal show="showModal">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">
                {{ $form->customer ? __('customers.edit') : __('customers.add') }}
            </h3>

            <div>
                <x-input-label for="name" :value="__('customers.name')" />
                <x-text-input id="name" type="text" class="mt-1" wire:model="form.name" required />
                <x-input-error :messages="$errors->get('form.name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('customers.phone')" />
                <x-text-input id="phone" type="text" class="mt-1" wire:model="form.phone" />
                <x-input-error :messages="$errors->get('form.phone')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="address" :value="__('customers.address')" />
                <x-text-input id="address" type="text" class="mt-1" wire:model="form.address" />
                <x-input-error :messages="$errors->get('form.address')" class="mt-1" />
            </div>

            @unless ($form->customer)
                <div>
                    <x-input-label for="opening_balance" :value="__('customers.opening_balance')" />
                    <x-text-input id="opening_balance" type="number" step="0.01" min="0" class="mt-1" wire:model="form.opening_balance" />
                    <x-input-error :messages="$errors->get('form.opening_balance')" class="mt-1" />
                </div>
            @endunless

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('customers.cancel') }}
                </button>
                <x-primary-button>{{ __('customers.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
