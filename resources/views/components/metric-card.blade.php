@props([
    'label',
    'value',
    'icon',
    'description' => null,
    'help' => null,
    'change' => null,
    'trend' => null,
    'changeStyle' => 'badge',
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
        ? 'text-rose-600 dark:text-rose-400'
        : 'text-emerald-600 dark:text-emerald-400';
    $changeBadgeTone = $direction === 'down'
        ? 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400'
        : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400';

    $hasHelp = filled($help);
    $labelId = $hasHelp ? uniqid('lnx-metric-label-', true) : null;
    $helpId = $hasHelp ? uniqid('lnx-metric-help-', true) : null;
    $groupAttributes = $hasHelp
        ? ['role' => 'group', 'aria-labelledby' => $labelId, 'aria-describedby' => $helpId]
        : [];
@endphp

<flux:card {{ $attributes->class('flex h-full min-w-0 flex-col gap-3')->merge($groupAttributes) }}>
    <span @class(['flex size-10 shrink-0 items-center justify-center rounded-md', $tone]) aria-hidden="true">
        <flux:icon :icon="$icon" class="size-5" />
    </span>

    <div class="min-w-0">
        <flux:heading level="3" :id="$labelId">{{ $label }}</flux:heading>

        @if (filled($description))
            <flux:text class="mt-1 text-sm">{{ $description }}</flux:text>
        @endif

        @if ($hasHelp)
            <p id="{{ $helpId }}" class="mt-1 flex items-start gap-1 text-xs text-zinc-500 dark:text-zinc-400">
                <flux:icon icon="information-circle" variant="micro" class="mt-0.5 size-3.5 shrink-0" aria-hidden="true" />
                <span>{{ $help }}</span>
            </p>
        @endif
    </div>

    <div class="mt-auto flex flex-col gap-2">
        <p class="text-3xl font-semibold leading-none tabular-nums text-zinc-900 dark:text-zinc-100">{{ $value }}</p>

        @if ($hasChange)
            <span @class([
                'font-medium',
                'self-start rounded-md px-2 py-1 text-xs' => $changeStyle === 'badge',
                'text-sm' => $changeStyle !== 'badge',
                $changeStyle === 'badge' ? $changeBadgeTone : $changeTone,
            ])>{{ $change }}</span>
        @endif
    </div>
</flux:card>
