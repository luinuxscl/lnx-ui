@props([
    'label' => null,
    'shortcut' => true,
])

<flux:button
    {{ $attributes->merge(['variant' => 'ghost', 'size' => 'sm', 'square' => true, 'icon' => 'sparkles']) }}
    x-data
    x-on:click="$dispatch('sam-open')"
    :aria-label="$label ?? __('lnx-ui::components.sam_trigger')"
    :title="$shortcut
        ? __('lnx-ui::components.sam_trigger').' · '.__('lnx-ui::components.sam_shortcut')
        : __('lnx-ui::components.sam_trigger')"
/>
