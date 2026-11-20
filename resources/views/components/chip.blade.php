@props([
    'label' => null,
    'icon' => null,
    'color' => 'accent',
])

@php
    $tone = \Luinuxscl\LnxUi\Tone::classes($color);
@endphp

<span {{ $attributes->class('inline-flex items-center gap-2 whitespace-nowrap text-sm font-medium text-zinc-700 dark:text-zinc-200') }}>
    @if (filled($icon))
        <span @class(['flex size-7 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
            <flux:icon :icon="$icon" variant="mini" class="size-4" />
        </span>
    @endif

    {{ $label ?? $slot }}
</span>
