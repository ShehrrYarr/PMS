@props(['show' => 'showModal', 'maxWidth' => 'max-w-lg'])

<div
    x-data
    x-show="$wire.{{ $show }}"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center px-4"
>
    <div class="fixed inset-0 bg-black/40" wire:click="$set('{{ $show }}', false)"></div>

    <div class="glass-panel-strong relative w-full {{ $maxWidth }} max-h-[90vh] overflow-y-auto p-6">
        {{ $slot }}
    </div>
</div>
