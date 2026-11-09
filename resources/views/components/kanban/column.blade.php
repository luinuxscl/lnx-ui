@props([
    'title',
    'columnId',
    'count' => null,
    'meta' => null,
])

<section
    data-kanban-column="{{ $columnId }}"
    {{ $attributes->class('flex max-h-[calc(100vh-11rem)] w-72 shrink-0 flex-col rounded-xl bg-zinc-100 dark:bg-zinc-800/80') }}
>
    <header class="flex items-start gap-2 px-3 py-2.5">
        <div class="min-w-0 flex-1">
            <div class="flex items-baseline gap-2">
                <h3 class="truncate text-sm font-semibold text-zinc-800 dark:text-zinc-100">{{ $title }}</h3>
                @if ($count !== null)
                    <span class="text-xs tabular-nums text-zinc-500">{{ $count }}</span>
                @endif
            </div>
            @if (filled($meta))
                <p class="truncate text-xs text-zinc-500">{{ $meta }}</p>
            @endif
        </div>
        @isset($menu)
            <div class="shrink-0">{{ $menu }}</div>
        @endisset
    </header>

    <div data-kanban-list class="flex min-h-12 flex-1 flex-col gap-2 overflow-y-auto px-2 pb-2">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-2 pb-2">{{ $footer }}</div>
    @endisset
</section>
