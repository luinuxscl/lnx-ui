@props([
    'status',
])

@if ($status)
    {{-- Esmeralda como el resto de la paleta semántica del producto; green es el
        alias crudo de Flux (crm-app#16, unificación de la revisión por áreas). --}}
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-emerald-600 dark:text-emerald-400']) }}>
        {{ $status }}
    </div>
@endif
