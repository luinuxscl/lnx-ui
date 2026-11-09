@props([
    'title',
    'columnId',
    'count' => null,
    'meta' => null,
    'metaTitle' => null,
])

<section
    data-kanban-column="{{ $columnId }}"
    {{ $attributes->class('flex h-full min-h-0 w-72 shrink-0 flex-col rounded-xl border border-zinc-200/80 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-900/50') }}
>
    <header class="shrink-0 flex items-start gap-2 px-3 py-2.5">
        <div class="min-w-0 flex-1">
            <div class="flex items-baseline justify-between gap-2">
                <h3 class="truncate text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h3>
                @if ($count !== null)
                    <span class="shrink-0 text-xs tabular-nums text-zinc-500 dark:text-zinc-400">{{ $count }}</span>
                @endif
            </div>
            @if (filled($meta))
                <p
                    @class([
                        'truncate text-sm font-semibold tabular-nums text-zinc-900 dark:text-zinc-100' => $meta !== '—',
                        'truncate text-sm text-zinc-500 dark:text-zinc-400' => $meta === '—',
                    ])
                    @if (filled($metaTitle))
                        title="{{ $metaTitle }}"
                    @endif
                >{{ $meta }}</p>
            @endif
        </div>
        @isset($menu)
            <div class="shrink-0">{{ $menu }}</div>
        @endisset
    </header>

    <div data-kanban-list class="flex min-h-0 flex-1 flex-col gap-2 overflow-y-auto px-2 pb-2">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-2 pb-2">{{ $footer }}</div>
    @endisset
</section>
