{{--
    Wraps a block of shop-setup forms. In the public demo shop (never reset,
    every visitor is its Admin) it shows why they're read-only and disables
    every control inside via <fieldset disabled>. Everywhere else it renders
    its slot untouched. The server-side half is LocksDemoShopSetup.
--}}
@if (auth()->user()?->inDemoShop())
    <div role="note" class="glass-panel mt-4 flex items-start gap-3 border border-[var(--color-info)]/30 px-5 py-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 flex-shrink-0 text-[var(--color-info)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
        </svg>
        <div>
            <p class="text-sm font-bold text-[var(--text-primary)]">{{ __('demo.setup_locked_title') }}</p>
            <p class="mt-0.5 text-sm font-medium text-[var(--text-secondary)]">{{ __('demo.setup_locked') }}</p>
        </div>
    </div>

    <fieldset disabled class="m-0 min-w-0 border-0 p-0 [&_:disabled]:cursor-not-allowed [&_:disabled]:opacity-60">
        {{ $slot }}
    </fieldset>
@else
    {{ $slot }}
@endif
