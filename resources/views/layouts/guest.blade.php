<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="min-h-screen font-sans antialiased {{ app()->getLocale() === 'ur' ? 'font-urdu' : '' }}">
        <div class="flex min-h-screen flex-col items-center justify-center px-4 py-6">
            <div class="mb-6 flex items-center gap-4">
                <a href="/" wire:navigate class="text-xl font-bold text-[var(--text-primary)]">
                    {{ __('nav.app_name') }}
                </a>
                <livewire:shared.language-switcher />
            </div>

            <div class="glass-panel-strong w-full max-w-md px-6 py-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
