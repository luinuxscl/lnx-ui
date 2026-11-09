@props([
    'cardId',
])

<article
    data-kanban-card="{{ $cardId }}"
    {{ $attributes->class('cursor-grab rounded-lg border border-zinc-200/80 bg-white p-3 shadow-sm active:cursor-grabbing dark:border-zinc-700 dark:bg-zinc-900') }}
>
    {{ $slot }}
</article>
