@props([
    'title' => null,
    'description' => null,
    'href' => null,
    'hrefLabel' => null,
    'span' => 4,
    'empty' => null,
])

@php
    $spanClass = match ((int) $span) {
        1 => 'col-span-12 xl:col-span-1',
        2 => 'col-span-12 xl:col-span-2',
        3 => 'col-span-12 sm:col-span-6 xl:col-span-3',
        4 => 'col-span-12 sm:col-span-6 xl:col-span-4',
        5 => 'col-span-12 xl:col-span-5',
        6 => 'col-span-12 sm:col-span-6',
        7 => 'col-span-12 xl:col-span-7',
        8 => 'col-span-12 xl:col-span-8',
        9 => 'col-span-12 xl:col-span-9',
        10 => 'col-span-12 xl:col-span-10',
        11 => 'col-span-12 xl:col-span-11',
        12 => 'col-span-12',
        default => 'col-span-12 sm:col-span-6 xl:col-span-4',
    };

    $hasHeader = filled($title) || filled($description) || filled($href) || isset($actions);
@endphp

<div {{ $attributes->class([$spanClass, 'min-w-0']) }}>
    <flux:card class="flex h-full min-w-0 flex-col gap-4">
        @if ($hasHeader)
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div class="min-w-0">
                    @if (filled($title))
                        <flux:heading level="3" class="truncate">{{ $title }}</flux:heading>
                    @endif

                    @if (filled($description))
                        <flux:text class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $description }}</flux:text>
                    @endif
                </div>

                <div class="flex shrink-0 items-center gap-2">
                    @isset($actions)
                        {{ $actions }}
                    @endisset

                    @if (filled($href))
                        <flux:button
                            size="xs"
                            variant="ghost"
                            square
                            icon="arrow-right"
                            :href="$href"
                            :aria-label="$hrefLabel ?? __('lnx-ui::components.widget_view_all')"
                            wire:navigate
                        />
                    @endif
                </div>
            </div>
        @endif

        @if ($slot->isEmpty())
            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $empty ?? __('lnx-ui::components.widget_empty') }}</p>
        @else
            {{ $slot }}
        @endif
    </flux:card>
</div>
