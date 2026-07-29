<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">
            {{ __('nav.dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="glass-panel px-6 py-8">
            <p class="text-lg font-semibold text-[var(--text-primary)]">
                {{ __('nav.welcome', ['name' => auth()->user()->name]) }}
            </p>
            <p class="mt-2 text-base text-[var(--text-secondary)]">
                {{ __('nav.signed_in_as') }}
                <span class="font-bold text-[var(--text-primary)]">{{ auth()->user()->getRoleNames()->first() }}</span>
            </p>
        </div>

        @can('expiry-alerts.view')
            @php $expiringCount = app(\App\Services\ExpiryAlertService::class)->expiringWithin(30)->count(); @endphp
            @if ($expiringCount > 0)
                <a href="{{ route('expiry-alerts.index') }}" wire:navigate class="glass-panel block px-6 py-4 transition hover:opacity-90">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-bold text-[var(--color-danger)]">{{ __('alerts.title') }}</p>
                            <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('alerts.dashboard_summary', ['count' => $expiringCount]) }}</p>
                        </div>
                        <span class="rounded-full bg-[var(--color-danger)]/10 px-4 py-2 text-2xl font-bold text-[var(--color-danger)]">{{ $expiringCount }}</span>
                    </div>
                </a>
            @endif
        @endcan
    </div>
</x-app-layout>
