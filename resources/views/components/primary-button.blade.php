<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-6 py-2 text-base font-bold text-white shadow-sm transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[var(--navbar-primary-color)] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
