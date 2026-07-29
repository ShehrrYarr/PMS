<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('reports.purchases_title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="mb-4 flex flex-wrap items-end gap-3">
            <div>
                <x-input-label for="dateFrom" :value="__('reports.from')" />
                <input id="dateFrom" type="date" wire:model.live="dateFrom" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            </div>
            <div>
                <x-input-label for="dateTo" :value="__('reports.to')" />
                <input id="dateTo" type="date" wire:model.live="dateTo" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            </div>
            <div>
                <x-input-label for="vendorId" :value="__('reports.vendor')" />
                <select id="vendorId" wire:model.live="vendorId" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('reports.all_vendors') }}</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4 rounded-xl bg-black/5 px-4 py-3 sm:w-64">
            <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.totals') }}</p>
            <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ money($purchasesTotal) }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('reports.date') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('reports.invoice') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('reports.vendor') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('purchases.total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchases as $purchase)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3 whitespace-nowrap text-[var(--text-secondary)]">{{ $purchase->created_at->format('d M Y') }}</td>
                            <td class="px-3 py-3">
                                <a href="{{ route('purchases.show', $purchase) }}" wire:navigate class="font-semibold text-[var(--color-info)] hover:underline">
                                    {{ $purchase->invoice_number }}
                                </a>
                            </td>
                            <td class="px-3 py-3">{{ $purchase->vendor->name ?? '—' }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ money($purchase->total_amount) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('reports.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $purchases->links() }}
        </div>
    </div>
</div>
