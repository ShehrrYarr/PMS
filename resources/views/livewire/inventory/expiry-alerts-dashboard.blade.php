<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('alerts.title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        @if ($batches->isEmpty())
            <p class="py-6 text-center text-base font-semibold text-[var(--text-secondary)]">{{ __('alerts.none') }}</p>
        @else
            <div class="space-y-3">
                @foreach ($batches as $batch)
                    @php
                        $days = $batch->daysUntilExpiry();
                        [$badgeClass, $borderClass] = match (true) {
                            $days < 0 => ['bg-[var(--color-danger)]/10 text-[var(--color-danger)]', 'border-[var(--color-danger)]/30'],
                            $days <= 7 => ['bg-[var(--color-danger)]/10 text-[var(--color-danger)]', 'border-[var(--color-danger)]/30'],
                            $days <= 15 => ['bg-[var(--color-warning)]/10 text-[var(--color-warning)]', 'border-[var(--color-warning)]/30'],
                            default => ['bg-[var(--color-warning)]/10 text-[var(--color-warning)]', 'border-black/10'],
                        };
                    @endphp
                    <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border {{ $borderClass }} bg-white/60 px-4 py-3">
                        <div>
                            <p class="text-base font-bold text-[var(--text-primary)]">{{ $batch->product->name }}</p>
                            <p class="font-mono text-sm text-[var(--text-secondary)]">{{ $batch->barcode }}</p>
                        </div>
                        <div class="text-end">
                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $badgeClass }}">
                                {{ $batch->expiry_date->format('Y-m-d') }}
                                ({{ $days < 0 ? __('batches.expired') : __('batches.days_left', ['days' => $days]) }})
                            </span>
                            <p class="mt-1 text-sm font-semibold text-[var(--text-secondary)]">
                                {{ __('alerts.remaining_qty', ['qty' => number_format((float) $batch->quantity_remaining, 2)]) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
