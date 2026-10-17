@props([
    'sender',
    'email' => null,
    'avatar' => null,
    'subject' => null,
    'preview' => null,
    'time' => null,
    'unread' => false,
    'starred' => false,
    'selected' => false,
    'badge' => null,
    'href' => null,
    'selectLabel' => null,
    'starLabel' => null,
])

@php
    $badgeLabel = is_array($badge) ? ($badge['label'] ?? null) : $badge;
    $badgeColor = is_array($badge) ? ($badge['color'] ?? null) : null;
    $selectLabel ??= __('lnx-ui::components.select_message');
    $starLabel ??= __('lnx-ui::components.star_message');
@endphp

<div
    {{ $attributes->class([
        'group relative flex items-start gap-3 rounded-lg px-3 py-3 transition',
        'bg-accent/5 ring-1 ring-inset ring-accent/25' => $selected,
        'hover:bg-zinc-100 dark:hover:bg-white/5' => ! $selected,
    ]) }}
    @if ($selected) data-selected @endif
>
    <div class="relative z-10 pt-1">
        @isset($select)
            {{ $select }}
        @else
            <flux:checkbox :checked="$selected" :aria-label="$selectLabel.' '.$sender" />
        @endisset
    </div>

    <flux:avatar :src="$avatar" :name="$sender" circle size="sm" class="mt-0.5" />

    <div class="min-w-0 flex-1">
        <div class="flex items-center gap-2">
            <span @class([
                'truncate',
                'font-semibold text-zinc-900 dark:text-white' => $unread,
                'font-medium text-zinc-700 dark:text-zinc-200' => ! $unread,
            ])>
                @if (filled($href))
                    <a
                        href="{{ $href }}"
                        wire:navigate
                        class="rounded-sm hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    >{{ $sender }}</a>
                @else
                    {{ $sender }}
                @endif
            </span>

            @if (filled($badgeLabel))
                <flux:badge :color="$badgeColor" size="sm">{{ $badgeLabel }}</flux:badge>
            @endif
        </div>

        @if (filled($subject))
            <p @class([
                'mt-0.5 truncate text-sm',
                'font-semibold text-zinc-900 dark:text-white' => $unread,
                'text-zinc-700 dark:text-zinc-300' => ! $unread,
            ])>{{ $subject }}</p>
        @endif

        @if (filled($preview))
            <p class="mt-0.5 line-clamp-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $preview }}</p>
        @endif
    </div>

    <div class="relative z-10 flex shrink-0 flex-col items-end justify-between gap-2 self-stretch">
        @if (filled($time))
            <time class="text-xs text-zinc-400 dark:text-zinc-500">{{ $time }}</time>
        @endif

        @isset($star)
            {{ $star }}
        @else
            <div x-data="{ starred: {{ $starred ? 'true' : 'false' }} }" class="mt-auto">
                <button
                    type="button"
                    x-on:click.stop="starred = ! starred"
                    :aria-pressed="starred ? 'true' : 'false'"
                    @class([
                        'flex size-6 items-center justify-center rounded-md text-zinc-300 transition hover:text-amber-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent dark:text-zinc-600 dark:hover:text-amber-400',
                        'text-amber-500 dark:text-amber-400' => $starred,
                    ])
                    aria-label="{{ $starLabel }}"
                >
                    <flux:icon icon="star" variant="solid" x-show="starred" class="size-4" />
                    <flux:icon icon="star" x-show="! starred" class="size-4" />
                </button>
            </div>
        @endisset
    </div>
</div>
