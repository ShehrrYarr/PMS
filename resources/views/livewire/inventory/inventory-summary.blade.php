<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('inventory.title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="mb-4 flex flex-wrap items-end gap-3">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('inventory.search') }}"
                class="min-h-[44px] w-full max-w-sm rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
            >
            <select wire:model.live="companyId" class="min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]">
                <option value="">{{ __('products.search_company') }}</option>
                @foreach ($companies as $companyOption)
                    <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('products.name') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('products.company') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('inventory.batch_count') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('inventory.total_received') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('inventory.total_remaining') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('products.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">{{ $product->name }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $product->company?->name ?? '—' }}</td>
                            <td class="px-3 py-3 text-end">{{ number_format((float) $product->batches_count, 0) }}</td>
                            <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ number_format((float) ($product->batches_sum_quantity_received ?? 0), 0) }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) ($product->batches_sum_quantity_remaining ?? 0), 0) }}</td>
                            <td class="px-3 py-3 text-end">
                                <a href="{{ route('batches.index', ['product' => $product->id]) }}" wire:navigate class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                    {{ __('products.batches') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('products.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
