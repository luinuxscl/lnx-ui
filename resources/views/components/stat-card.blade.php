@props([
    'label',
    'value',
    'icon',
    'color' => 'accent',
])

<flux:card {{ $attributes->class('h-full') }}>
    <x-lnx-ui::stat :$label :$value :$icon :$color />
</flux:card>
