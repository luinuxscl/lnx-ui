@props([
    'name',
    'size' => null,
    'icon' => 'document',
    'color' => 'accent',
    'href' => null,
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

    $classes = 'flex min-w-0 items-center gap-3 rounded-lg border border-zinc-200 p-2.5 dark:border-zinc-700';
@endphp

@if (filled($href))
    <a
        href="{{ $href }}"
        download
        {{ $attributes->class([$classes, 'transition hover:border-zinc-300 hover:bg-zinc-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent dark:hover:border-zinc-600 dark:hover:bg-white/5']) }}
    >
@else
    <div {{ $attributes->class($classes) }}>
@endif

    <span @class(['flex size-9 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
        <flux:icon :icon="$icon" class="size-5" />
    </span>

    <span class="min-w-0 flex-1">
        <span class="block truncate text-sm font-medium text-zinc-800 dark:text-zinc-100">{{ $name }}</span>
        @if (filled($size))
            <span class="block text-xs text-zinc-500 dark:text-zinc-400">{{ $size }}</span>
        @endif
    </span>

    @isset($action)
        <span class="shrink-0">{{ $action }}</span>
    @endisset

@if (filled($href))
    </a>
@else
    </div>
@endif
