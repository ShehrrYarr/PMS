{{--
    Renders as part of the Livewire component's own tracked root, unlike
    <x-slot:header> (see layouts/app.blade.php), which Livewire's Layout
    mechanism extracts and places OUTSIDE the component's wire:id'd root —
    making any wire:click/wire:model inside it permanently inert. Always use
    this component instead of <x-slot:header> for page headers that contain
    any Livewire directive.

    No horizontal/top padding of its own — this renders inside <main>
    (which already supplies px-4 lg:px-8 py-6), so adding the same padding
    here would stack on top of it and indent the header relative to every
    other .glass-panel on the page. Only a bottom margin, to separate it
    from the content that follows.
--}}
<header class="mb-4 sm:mb-6">
    <div class="glass-panel px-6 py-4">
        {{ $slot }}
    </div>
</header>
