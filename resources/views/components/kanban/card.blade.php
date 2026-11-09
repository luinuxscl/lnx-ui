@props([
    'cardId',
])

<article
    data-kanban-card="{{ $cardId }}"
    {{ $attributes->class('cursor-grab rounded-lg border border-zinc-200/80 bg-white p-3 shadow-sm active:cursor-grabbing dark:border-zinc-600 dark:bg-zinc-800 dark:shadow-none dark:ring-1 dark:ring-white/5') }}
>
    {{ $slot }}
</article>
