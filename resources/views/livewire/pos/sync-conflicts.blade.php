<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('sync.conflicts_title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <p class="mb-4 max-w-3xl text-sm text-[var(--text-secondary)]">{{ __('sync.conflicts_hint') }}</p>

        <div class="mb-4 flex flex-wrap items-center gap-4">
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('sync.unresolved') }}</p>
                <p class="mt-1 text-lg font-bold {{ $unresolvedCount > 0 ? 'text-[var(--color-danger)]' : 'text-[var(--color-success)]' }}">
                    {{ $unresolvedCount }}
                </p>
            </div>

            <label class="flex items-center gap-2 text-sm font-semibold text-[var(--text-primary)]">
                <input type="checkbox" wire:model.live="showResolved" class="rounded border-black/20">
                {{ __('sync.show_resolved') }}
            </label>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('sync.invoice') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('sync.product') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('sync.sold') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('sync.available') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('sync.shortfall') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('sync.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('products.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($conflicts as $conflict)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">
                                <a href="{{ route('sales.show', $conflict->sale_id) }}" wire:navigate class="font-semibold text-[var(--color-info)] hover:underline">
                                    {{ $conflict->sale?->invoice_number }}
                                </a>
                            </td>
                            <td class="px-3 py-3">
                                {{ $conflict->batch?->product?->name }}
                                <span class="block font-mono text-xs text-[var(--text-secondary)]">{{ $conflict->batch?->barcode }}</span>
                            </td>
                            <td class="px-3 py-3 text-end">{{ number_format((float) $conflict->requested_quantity, 0) }}</td>
                            <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ number_format((float) $conflict->available_quantity, 0) }}</td>
                            <td class="px-3 py-3 text-end font-bold text-[var(--color-danger)]">{{ number_format((float) $conflict->shortfall, 0) }}</td>
                            <td class="px-3 py-3">
                                @if ($conflict->resolved_at)
                                    <span class="text-sm font-semibold text-[var(--color-success)]">
                                        {{ __('sync.resolved_by', ['name' => $conflict->resolver?->name ?? '—']) }}
                                    </span>
                                @else
                                    <span class="text-sm font-semibold text-[var(--color-warning)]">{{ __('sync.needs_review') }}</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 text-end">
                                @unless ($conflict->resolved_at)
                                    <button
                                        type="button"
                                        wire:click="resolve({{ $conflict->id }})"
                                        wire:confirm="{{ __('sync.resolve_confirm') }}"
                                        class="min-h-[40px] rounded-lg bg-black/5 px-3 py-2 text-sm font-semibold text-[var(--text-primary)] hover:bg-black/10"
                                    >
                                        {{ __('sync.mark_resolved') }}
                                    </button>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('sync.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $conflicts->links() }}
        </div>
    </div>
</div>
