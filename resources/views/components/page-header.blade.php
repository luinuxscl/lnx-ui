@props([
    'title',
    'subtitle' => null,
    'icon' => null,
    'color' => 'accent',
])

@php
    $tone = match ($color) {
        'violet' => 'bg-violet-100 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400',
        'cyan' => 'bg-cyan-100 text-cyan-600 dark:bg-cyan-500/15 dark:text-cyan-400',
        'rose' => 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400',
        'emerald' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400',
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400',
        'amber' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
        default => 'bg-accent/10 text-accent-content',
    };
@endphp

<div {{ $attributes->class('flex flex-wrap items-start justify-between gap-4') }}>
    <div class="flex min-w-0 items-start gap-3">
        @if (filled($icon))
            <span @class(['flex size-11 shrink-0 items-center justify-center rounded-xl', $tone]) aria-hidden="true">
                <flux:icon :icon="$icon" class="size-6" />
            </span>
        @endif

        <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-3">
                <flux:heading level="1" size="xl" class="!font-bold">{{ $title }}</flux:heading>

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
