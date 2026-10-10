@props([
    'label',
    'value',
    'icon',
    'color' => 'accent',
    'href' => null,
    'active' => false,
    'external' => false,
])

@php
    $isLink = filled($href);
@endphp

@if ($isLink)
    <a
        href="{{ $href }}"
        @if ($external) target="_blank" rel="noopener noreferrer" @endif
        @if ($active) aria-current="page" @endif
        {{ $attributes->class('group block h-full rounded-xl focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent') }}
    >
@else
    <div {{ $attributes->class('h-full') }}>
@endif

    <flux:card @class([
        'h-full transition',
        'group-hover:border-zinc-300 group-hover:bg-zinc-50 dark:group-hover:border-zinc-600 dark:group-hover:bg-zinc-800/60' => $isLink,
        'border-accent ring-1 ring-accent/40' => $active,
    ])>
        <x-lnx-ui::stat :$label :$value :$icon :$color />
    </flux:card>

@if ($isLink)
    </a>
@else
    </div>
@endif