<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="min-h-screen font-sans antialiased {{ app()->getLocale() === 'ur' ? 'font-urdu' : '' }}">
        <div class="flex min-h-screen flex-col lg:flex-row">
            <x-sidebar />

            <div class="flex min-w-0 flex-1 flex-col">
                <x-navbar />

                <main class="flex-1 px-4 py-6 lg:px-8">
                    @if (session('success'))
                        <div class="glass-panel mb-4 border border-[var(--color-success)]/30 px-6 py-3 text-base font-semibold text-[var(--color-success)]">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
