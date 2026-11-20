@props([
    'label',
    'value',
    'icon',
    'color' => 'accent',
    'display' => false,
])

@php
    $tone = \Luinuxscl\LnxUi\Tone::classes($color);
@endphp

<div {{ $attributes->class('flex min-w-0 items-center gap-4') }}>
    <span @class(['flex size-10 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
        <flux:icon :icon="$icon" class="size-5" />
    </span>

    <div class="min-w-0">
        <p @class([
            'truncate tabular-nums text-zinc-900 dark:text-zinc-100',
            'font-display text-2xl font-semibold leading-tight' => $display,
            'text-xl font-medium' => ! $display,
        ])>{{ $value }}</p>
        <flux:text class="truncate text-sm">{{ $label }}</flux:text>
    </div>
</div>
