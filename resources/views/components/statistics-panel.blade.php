@props([
    'title' => null,
    'updatedLabel' => null,
    'updatedIcon' => 'arrow-path',
])

<flux:card
    role="group"
    :aria-label="$title"
    {{ $attributes->class('w-full space-y-4') }}
>
    @if (filled($title))
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div class="min-w-0">
                <flux:heading level="2" size="lg">{{ $title }}</flux:heading>

                @isset($description)
                    <flux:text class="mt-1 text-sm">{{ $description }}</flux:text>
                @endisset
            </div>

            @if ($updatedLabel || isset($actions))
                <div class="flex shrink-0 items-center gap-2">
                    @if ($updatedLabel)
                        <flux:tooltip :content="$updatedLabel" position="bottom">
                            <span
                                tabindex="0"
                                aria-label="{{ $updatedLabel }}"
                                class="inline-flex size-8 cursor-help items-center justify-center rounded-md text-zinc-500 hover:text-zinc-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent dark:text-zinc-400 dark:hover:text-zinc-200"
                            >
                                <flux:icon :icon="$updatedIcon" variant="mini" class="size-4" aria-hidden="true" />
                            </span>
                        </flux:tooltip>
                    @endif

                    @isset($actions)
                        <div class="flex items-center gap-2">{{ $actions }}</div>
                    @endisset
                </div>
            @endif
        </div>
    @endif

    @if ($slot->isEmpty())
        @isset($empty)
            {{ $empty }}
        @endisset
    @else
        <div class="grid grid-cols-12 gap-4">
            {{ $slot }}
        </div>
    @endif
</flux:card>
