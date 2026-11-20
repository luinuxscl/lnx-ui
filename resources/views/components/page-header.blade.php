@props([
    'title',
    'subtitle' => null,
    'eyebrow' => null,
    'icon' => null,
    'color' => 'accent',
])

@php
    $tone = \Luinuxscl\LnxUi\Tone::classes($color);
@endphp

<div {{ $attributes->class('flex flex-wrap items-start justify-between gap-4') }}>
    <div class="flex min-w-0 items-start gap-3">
        @if (filled($icon))
            <span @class(['flex size-11 shrink-0 items-center justify-center rounded-xl', $tone]) aria-hidden="true">
                <flux:icon :icon="$icon" class="size-6" />
            </span>
        @endif

        <div class="min-w-0">
            @if (filled($eyebrow))
                <div class="mb-1 text-sm font-semibold text-zinc-600 dark:text-zinc-400">{{ $eyebrow }}</div>
            @endif

            <div class="flex flex-wrap items-center gap-3">
                <flux:heading level="1" size="xl" class="!font-bold font-display">{{ $title }}</flux:heading>

                @if (isset($meta))
                    {{ $meta }}
                @endif
            </div>

            @if (filled($subtitle))
                <flux:text class="mt-0.5">{{ $subtitle }}</flux:text>
            @endif
        </div>
    </div>

    @if (isset($actions))
        <div class="flex shrink-0 flex-wrap items-center gap-2">
            {{ $actions }}
        </div>
    @endif
</div>
