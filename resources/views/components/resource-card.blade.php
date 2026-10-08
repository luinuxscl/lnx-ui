@props([
    'title',
    'description' => null,
    'icon' => null,
    'eyebrow' => null,
    'href' => null,
    'external' => false,
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

    $wholeLink = filled($href) && ! isset($actions);
    $hasFooter = isset($tags) || isset($meta) || isset($actions);
@endphp

@if ($wholeLink)
    <a
        href="{{ $href }}"
        @if (! $external) wire:navigate @endif
        @if ($external) target="_blank" rel="noopener noreferrer" @endif
        {{ $attributes->class('group block h-full rounded-xl focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent') }}
    >
@else
    <div {{ $attributes->class('h-full') }}>
@endif

    <flux:card class="flex h-full min-w-0 flex-col gap-4">
        @if (filled($icon) || filled($eyebrow) || isset($badges))
            <div class="flex flex-wrap items-start gap-x-3 gap-y-2">
                <div class="flex items-center gap-3">
                    @if (filled($icon))
                        <span @class(['flex size-10 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
                            <flux:icon :icon="$icon" class="size-5" />
                        </span>
                    @endif

                    @if (filled($eyebrow))
                        <flux:text class="whitespace-nowrap text-sm">{{ $eyebrow }}</flux:text>
                    @endif
                </div>

                @isset($badges)
                    <div class="ms-auto flex flex-wrap items-center justify-end gap-2">{{ $badges }}</div>
                @endisset
            </div>
        @endif

        <div class="min-w-0 flex-1">
            <flux:heading level="3">
                @if (filled($href) && ! $wholeLink)
                    <a
                        href="{{ $href }}"
                        @if (! $external) wire:navigate @endif
                        @if ($external) target="_blank" rel="noopener noreferrer" @endif
                        class="rounded-sm hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    >{{ $title }}</a>
                @else
                    {{ $title }}
                @endif
            </flux:heading>

            @if (filled($description))
                <flux:text class="mt-1 line-clamp-2">{{ $description }}</flux:text>
            @endif
        </div>

        @if ($hasFooter)
            <div class="mt-auto flex flex-wrap items-center justify-between gap-3 border-t border-zinc-200 pt-3 dark:border-zinc-800">
                <div class="flex min-w-0 flex-wrap items-center gap-2">{{ $tags ?? '' }}</div>

                <div class="flex shrink-0 flex-wrap items-center justify-end gap-3">
                    @isset($meta)
                        <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">{{ $meta }}</div>
                    @endisset

                    @isset($actions)
                        <div class="flex items-center gap-2">{{ $actions }}</div>
                    @endisset
                </div>
            </div>
        @endif
    </flux:card>

@if ($wholeLink)
    </a>
@else
    </div>
@endif
