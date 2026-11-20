@props([
    'title',
    'description',
    'icon',
    'href',
    'color' => 'accent',
    'external' => false,
])

@php
    $tone = \Luinuxscl\LnxUi\Tone::classes($color);
@endphp

<a
    href="{{ $href }}"
    @if (! $external) wire:navigate @endif
    @if ($external) target="_blank" rel="noopener noreferrer" @endif
    {{ $attributes->class('group block rounded-xl focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent') }}
>
    <flux:card class="flex h-full items-start gap-4 transition duration-200 group-hover:-translate-y-0.5 group-hover:border-zinc-300 dark:group-hover:border-zinc-600">
        <span @class(['flex size-10 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
            <flux:icon :icon="$icon" class="size-5" />
        </span>

        <span class="min-w-0 flex-1">
            <flux:heading level="3" class="truncate">{{ $title }}</flux:heading>
            <flux:text class="mt-1 text-sm">{{ $description }}</flux:text>
        </span>

        <flux:icon
            :icon="$external ? 'arrow-up-right' : 'chevron-right'"
            class="size-4 shrink-0 text-zinc-400 transition group-hover:text-zinc-600 dark:group-hover:text-zinc-200"
            aria-hidden="true"
        />
    </flux:card>
</a>
