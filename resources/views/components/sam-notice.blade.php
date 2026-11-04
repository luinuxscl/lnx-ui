@props([
    'variant' => 'secondary',
    'icon' => null,
])

@php
    $icon ??= match ($variant) {
        'danger' => 'exclamation-circle',
        'warning' => 'exclamation-triangle',
        'success' => 'check-circle',
        default => 'information-circle',
    };
@endphp

<flux:callout :variant="$variant" :icon="$icon" {{ $attributes }}>
    {{ $slot }}
</flux:callout>
