@props(['options', 'valueKey' => 'id', 'labelKey' => 'name', 'placeholder' => ''])

{{--
    A client-side-filtered combobox that stays wire:model-compatible by
    driving a real (visually hidden) <select> underneath — Livewire only
    ever sees a normal <select> change event, so this works anywhere a
    <select wire:model="..."> would, including inside @foreach-indexed
    array bindings like wire:model="items.{{ $index }}.product_id".

    Usage: <x-searchable-select wire:model="vendor_id" :options="$vendors" placeholder="Select a vendor…" />
--}}

<div
    x-data="{
        open: false,
        query: '',
        options: @js($options->map(fn ($option) => ['value' => (string) data_get($option, $valueKey), 'label' => data_get($option, $labelKey)])->values()),
        get filtered() {
            if (this.query.trim() === '') {
                return this.options;
            }
            const q = this.query.toLowerCase();
            return this.options.filter((o) => o.label.toLowerCase().includes(q));
        },
        select(option) {
            this.query = option.label;
            this.open = false;
            this.$refs.hiddenSelect.value = option.value;
            this.$refs.hiddenSelect.dispatchEvent(new Event('change'));
        },
        syncFromSelect() {
            const match = this.options.find((o) => o.value === this.$refs.hiddenSelect.value);
            this.query = match ? match.label : '';
        },
        revertIfUnmatched() {
            const match = this.options.find((o) => o.label === this.query);
            if (! match) {
                this.syncFromSelect();
            }
        },
    }"
    x-init="syncFromSelect()"
    class="relative"
>
    <select x-ref="hiddenSelect" x-on:change="syncFromSelect()" {{ $attributes->merge(['class' => 'hidden']) }}>
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ data_get($option, $valueKey) }}">{{ data_get($option, $labelKey) }}</option>
        @endforeach
    </select>

    <input
        type="text"
        x-model="query"
        x-on:focus="open = true"
        x-on:click="open = true"
        x-on:keydown.escape="open = false; $event.target.blur()"
        x-on:click.outside="open = false; revertIfUnmatched()"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        class="min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
    >

    <div
        x-show="open"
        x-cloak
        class="absolute z-20 mt-1 max-h-60 w-full overflow-y-auto rounded-xl border border-black/10 bg-white shadow-lg"
    >
        <template x-for="option in filtered" :key="option.value">
            <button
                type="button"
                x-on:click="select(option)"
                x-text="option.label"
                class="block w-full min-h-[44px] px-4 py-2 text-start text-base text-[var(--text-primary)] hover:bg-black/5"
            ></button>
        </template>
        <p x-show="filtered.length === 0" class="px-4 py-3 text-sm text-[var(--text-secondary)]">{{ __('common.no_results') }}</p>
    </div>
</div>
