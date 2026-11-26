@props([
    'cardId',
    'locked' => false,
])

@php
    $cardClasses = 'rounded-b-lg rounded-t-none border border-zinc-200/80 bg-white p-3 shadow-sm dark:border-zinc-600 dark:bg-zinc-800 dark:shadow-none dark:ring-1 dark:ring-white/5'
        .($locked ? ' cursor-default' : ' cursor-grab active:cursor-grabbing');
@endphp

<article
    data-kanban-card="{{ $cardId }}"
    @if ($locked) data-kanban-locked="true" @endif
    {{ $attributes->merge(['class' => $cardClasses]) }}
>
    {{ $slot }}
</article>
