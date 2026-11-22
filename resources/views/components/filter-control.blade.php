@props([
    'width' => 'w-44',
])

@php
    $maxWidth = str_starts_with($width, 'w-') ? 'max-'.$width : null;
@endphp

{{-- No overflow-hidden: it would clip the focus ring of inputs and selects
    (white corners reported during the crm#16 review). --}}
<div {{ $attributes->class(['shrink-0 min-w-0', $width, $maxWidth]) }}>
    {{ $slot }}
</div>
