<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('super_admin.control_panel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#0f172a] font-sans antialiased">
        @auth('super_admin')
            <header class="border-b border-white/10 bg-[#111827]">
                <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6">
                    <div class="flex items-center gap-6">
                        <span class="text-lg font-bold text-white">{{ __('super_admin.control_panel') }}</span>
                        <nav class="flex items-center gap-1">
                            <a href="{{ route('control-panel.index') }}" class="min-h-[44px] rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs('control-panel.index') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} flex items-center">
                                {{ __('super_admin.nav_shops') }}
                            </a>
                            <a href="{{ route('control-panel.developer-tools') }}" class="min-h-[44px] rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs('control-panel.developer-tools') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} flex items-center">
                                {{ __('super_admin.nav_developer_tools') }}
                            </a>
                        </nav>
                    </div>
                    <form method="POST" action="{{ route('control-panel.logout') }}">
                        @csrf
                        <button type="submit" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-semibold text-white/70 hover:bg-white/10 hover:text-white">
                            {{ __('super_admin.log_out') }}
                        </button>
                    </form>
                </div>
            </header>
        @endauth

        <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6">
            {{ $slot }}
        </main>
    </body>
</html>
