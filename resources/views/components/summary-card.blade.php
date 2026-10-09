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
    $tone = match ($color) {
        'violet' => 'bg-violet-100 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400',
        'cyan' => 'bg-cyan-100 text-cyan-600 dark:bg-cyan-500/15 dark:text-cyan-400',
        'rose' => 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400',
        'emerald' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400',
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400',
        'amber' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
        default => 'bg-accent/10 text-accent-content',
    };

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

    <p class="text-3xl font-semibold leading-none tabular-nums text-zinc-900 dark:text-zinc-100">{{ $value }}</p>

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
