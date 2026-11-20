@props([
    'label',
    'value',
    'icon',
    'color' => 'accent',
    'href' => null,
    'active' => false,
    'external' => false,
    'display' => false,
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
        'h-full transition duration-200',
        'group-hover:-translate-y-0.5 group-hover:border-zinc-300 dark:group-hover:border-zinc-600' => $isLink,
        'border-accent ring-1 ring-accent/40' => $active,
    ])>
        <x-lnx-ui::stat :$label :$value :$icon :$color :$display />
    </flux:card>

@if ($isLink)
    </a>
@else
    </div>
@endif