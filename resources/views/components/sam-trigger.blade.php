@props([
    'label' => null,
    'shortcut' => true,
    'count' => null,
])

@php
    $initial = is_numeric($count) ? (int) $count : 0;
@endphp

<div
    {{ $attributes->class(['relative inline-flex']) }}
    data-sam-trigger-wrap
    x-data="{ badge: {{ $initial }} }"
    x-on:sam-badge-count.window="badge = $event.detail?.count ?? 0"
>
    <flux:button
        variant="ghost"
        size="sm"
        square
        icon="sparkles"
        x-on:click="$dispatch('sam-open')"
        :aria-label="$label ?? __('lnx-ui::components.sam_trigger')"
        :title="$shortcut
            ? __('lnx-ui::components.sam_trigger').' · '.__('lnx-ui::components.sam_shortcut')
            : __('lnx-ui::components.sam_trigger')"
    />

    <span
        class="pointer-events-none absolute -right-0.5 -top-0.5 flex min-h-4 min-w-4 items-center justify-center rounded-full bg-amber-500 px-1 text-[10px] font-semibold leading-none text-white"
        data-sam-trigger-badge
        x-show="badge > 0"
        x-cloak
        x-text="badge > 9 ? '9+' : String(badge)"
        aria-hidden="true"
    ></span>
</div>
