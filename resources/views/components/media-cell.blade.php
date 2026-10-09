@props([
    'title',
    'description' => null,
    'image' => null,
    'icon' => null,
    'color' => 'accent',
    'href' => null,
    'external' => false,
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

<div {{ $attributes->class('flex min-w-0 items-center gap-3') }}>
    @if (filled($image))
        <img
            src="{{ $image }}"
            alt=""
            loading="lazy"
            aria-hidden="true"
            class="size-10 shrink-0 rounded-md object-cover ring-1 ring-zinc-200 dark:ring-zinc-700"
        />
    @elseif (filled($icon))
        <span @class(['flex size-10 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
            <flux:icon :icon="$icon" class="size-5" />
        </span>
    @endif

    <div class="min-w-0">
        <p class="truncate font-medium text-zinc-800 dark:text-white">
            @if (filled($href))
                <a
                    href="{{ $href }}"
                    @if (! $external) wire:navigate @endif
                    @if ($external) target="_blank" rel="noopener noreferrer" @endif
                    class="rounded-sm hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                >{{ $title }}</a>
            @else
                {{ $title }}
            @endif
        </p>

        @if (filled($description))
            <p class="truncate text-sm text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
        @endif
    </div>
</div>
