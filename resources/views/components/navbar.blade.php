@php
    $theme = \App\Models\ThemeSetting::current();
@endphp
<header class="glass-nav sticky top-0 z-30 flex min-h-[64px] items-center justify-between gap-4 px-4 py-3 shadow-sm lg:px-8">
    <a href="{{ route('dashboard') }}" wire:navigate class="hidden min-h-[44px] items-center truncate text-lg font-bold text-[var(--text-on-dark)] sm:flex">
        {{ $theme->displayName() }}
    </a>

    <div class="ms-auto flex min-w-0 items-center gap-2 sm:gap-3">
        <livewire:shared.language-switcher />

        @auth
            <div x-data="{ open: false }" class="relative">
                <button
                    type="button"
                    @click="open = !open"
                    class="flex min-h-[44px] max-w-[140px] items-center gap-2 rounded-full bg-white/20 px-3 py-2 text-sm font-semibold text-[var(--text-on-dark)] transition hover:bg-white/30 sm:max-w-none"
                >
                    <span class="truncate">{{ auth()->user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-transition
                    @click.outside="open = false"
                    class="glass-panel-strong absolute end-0 z-40 mt-2 w-56 overflow-hidden py-2"
                    style="display: none;"
                >
                    <div class="border-b border-black/5 px-4 py-2 text-xs text-[var(--text-secondary)]">
                        {{ __('nav.signed_in_as') }}<br>
                        <span class="font-semibold text-[var(--text-primary)]">{{ auth()->user()->getRoleNames()->first() }}</span>
                    </div>

                    <a
                        href="{{ route('profile') }}"
                        wire:navigate
                        class="block min-h-[44px] px-4 py-2 text-sm font-semibold text-[var(--text-primary)] hover:bg-black/5"
                    >
                        {{ __('nav.manage_account') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="block w-full min-h-[44px] px-4 py-2 text-start text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5"
                        >
                            {{ __('nav.log_out') }}
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</header>
