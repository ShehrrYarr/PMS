@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-base font-semibold text-[var(--text-primary)]']) }}>
    {{ $value ?? $slot }}
</label>
