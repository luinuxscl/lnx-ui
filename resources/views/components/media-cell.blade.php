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
    $tone = \Luinuxscl\LnxUi\Tone::classes($color);
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
