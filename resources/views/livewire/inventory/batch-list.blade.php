<div>
    <x-page-header>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('batches.title') }}</h2>
                @if ($filteredProduct)
                    <p class="mt-1 flex items-center gap-2 text-base font-semibold text-[var(--text-secondary)]">
                        {{ __('batches.filtered_by', ['name' => $filteredProduct->name]) }}
                        <button type="button" wire:click="clearFilter" class="text-sm font-bold text-[var(--color-info)] underline">
                            {{ __('batches.clear_filter') }}
                        </button>
                    </p>
                @endif
            </div>
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('batches.barcode') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('batches.product') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('batches.manufacturing_date') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('batches.expiry_date') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('batches.remaining') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('batches.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($batches as $batch)
                        @php
                            $days = $batch->daysUntilExpiry();
                            $badgeClass = match (true) {
                                $days < 0 => 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]',
                                $days <= 7 => 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]',
                                $days <= 15 => 'bg-[var(--color-warning)]/10 text-[var(--color-warning)]',
                                $days <= 30 => 'bg-[var(--color-warning)]/10 text-[var(--color-warning)]',
                                default => 'bg-[var(--color-success)]/10 text-[var(--color-success)]',
                            };
                        @endphp
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3 font-mono text-sm">{{ $batch->barcode }}</td>
                            <td class="px-3 py-3">{{ $batch->product->name }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $batch->manufacturing_date->format('Y-m-d') }}</td>
                            <td class="px-3 py-3">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $badgeClass }}">
                                    {{ $batch->expiry_date->format('Y-m-d') }}
                                    ({{ $days < 0 ? __('batches.expired') : __('batches.days_left', ['days' => $days]) }})
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $batch->quantity_remaining, 0) }} / {{ number_format((float) $batch->quantity_received, 0) }}</td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('batches.label', $batch) }}" target="_blank" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                        {{ __('batches.label') }}
                                    </a>
                                    @can('batches.manage')
                                        <button type="button" wire:click="edit({{ $batch->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                            {{ __('batches.edit') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('batches.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $batches->links() }}
        </div>
    </div>

    <x-glass-modal show="showModal">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">
                {{ __('batches.edit') }}
            </h3>

            <div>
                <x-input-label :value="__('batches.product')" />
                <p class="mt-1 flex min-h-[44px] items-center rounded-xl border border-black/10 bg-black/5 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    {{ $form->batch?->product->name }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="manufacturing_date" :value="__('batches.manufacturing_date')" />
                    <input id="manufacturing_date" type="date" wire:model="form.manufacturing_date" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <x-input-error :messages="$errors->get('form.manufacturing_date')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="expiry_date" :value="__('batches.expiry_date')" />
                    <input id="expiry_date" type="date" wire:model="form.expiry_date" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <x-input-error :messages="$errors->get('form.expiry_date')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="cost_price" :value="__('batches.cost_price')" />
                <x-text-input id="cost_price" type="number" step="0.01" min="0" class="mt-1" wire:model="form.cost_price" />
                <x-input-error :messages="$errors->get('form.cost_price')" class="mt-1" />
            </div>


            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('batches.cancel') }}
                </button>
                <x-primary-button>{{ __('batches.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
