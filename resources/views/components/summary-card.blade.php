@props([
    'label',
    'value',
    'icon',
    'caption' => null,
    'change' => null,
    'trend' => null,
    'color' => 'accent',
])

@php
    $tone = \Luinuxscl\LnxUi\Tone::classes($color);

    $hasChange = filled($change);
    $direction = $trend ?? ($hasChange && str_starts_with(trim((string) $change), '-') ? 'down' : 'up');
    $changeTone = $direction === 'down'
        ? 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400'
        : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400';
@endphp

<flux:card {{ $attributes->class('flex h-full min-w-0 flex-col gap-3') }}>
    <div class="flex items-start justify-between gap-3">
        <flux:text class="min-w-0 text-sm font-medium text-zinc-600 dark:text-zinc-300">{{ $label }}</flux:text>

        <span @class(['flex size-9 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
            <flux:icon :icon="$icon" class="size-4" />
        </span>
    </div>

    <p class="font-display text-3xl font-semibold leading-none tabular-nums text-zinc-900 dark:text-zinc-100">{{ $value }}</p>

    @if (filled($caption) || $hasChange)
        <div class="mt-auto flex flex-wrap items-center gap-2 text-sm">
            @if (filled($caption))
                <span class="text-zinc-500 dark:text-zinc-400">{{ $caption }}</span>
            @endif

            @if ($hasChange)
                <span @class(['rounded-md px-2 py-0.5 text-xs font-medium', $changeTone])>{{ $change }}</span>
            @endif
        </div>
    @endif
</flux:card>
