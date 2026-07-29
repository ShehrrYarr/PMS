@php
    $theme = \App\Models\ThemeSetting::current();
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $theme->displayName() }}</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Noto+Nastaliq+Urdu:wght@500;700&family=Noto+Sans+Arabic:wght@500;600;700&display=swap" rel="stylesheet">

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Per-shop theme colors — deliberately loaded after app.css so these
     dynamic values win over the static fallback :root declared there
     (see design.md §2.1). --}}
<style>
    :root {
        --navbar-primary-color: {{ $theme->navbar_primary_color }};
        --navbar-accent-color: {{ $theme->navbar_accent_color }};
        --sidebar-primary-color: {{ $theme->sidebar_primary_color }};
        --sidebar-accent-color: {{ $theme->sidebar_accent_color }};
        --sidebar-gradient-from: {{ $theme->sidebar_gradient_from }};
        --sidebar-gradient-to: {{ $theme->sidebar_gradient_to }};
    }
</style>
