@props([
    'label' => null,
    'value' => 0,
    'max' => 100,
    'hint' => null,
])

@php
    $percent = $max > 0 ? (int) round(min(max($value, 0), $max) / $max * 100) : 0;
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if (filled($label) || filled($hint))
        <div class="mb-1.5 flex items-center justify-between gap-3">
            @if (filled($label))
                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ $label }}</span>
            @endif

            @if (filled($hint))
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $hint }}</span>
            @endif
        </div>
    @endif

    <div
        role="progressbar"
        aria-valuemin="0"
        aria-valuemax="{{ $max }}"
        aria-valuenow="{{ $value }}"
        class="h-1.5 w-full overflow-hidden rounded-full bg-zinc-200/80 dark:bg-zinc-800"
    >
        <div class="h-full rounded-full bg-accent transition-all" style="width: {{ $percent }}%"></div>
    </div>
</div>
