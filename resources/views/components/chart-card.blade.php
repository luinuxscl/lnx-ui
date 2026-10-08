@props([
    'label',
    'value',
    'description' => null,
    'change' => null,
    'trend' => null,
    'changeStyle' => 'text',
    'series' => [],
    'chart' => 'line',
    'labels' => [],
    'color' => 'accent',
])

@php
    $chartColor = match ($color) {
        'violet' => 'text-violet-600 dark:text-violet-400',
        'cyan' => 'text-cyan-600 dark:text-cyan-400',
        'rose' => 'text-rose-600 dark:text-rose-400',
        'emerald' => 'text-emerald-600 dark:text-emerald-400',
        'blue' => 'text-blue-600 dark:text-blue-400',
        'amber' => 'text-amber-600 dark:text-amber-400',
        default => 'text-accent-content',
    };

    $values = array_values(array_map('floatval', array_filter($series, static fn ($point) => is_numeric($point) && is_finite((float) $point))));
    $isBar = $chart === 'bar';
    $hasChart = $isBar ? count($values) >= 1 : count($values) >= 2;

    $chartId = uniqid('chart-card-', true);
    $path = null;
    $area = null;
    $bars = [];

    if ($hasChart && $isBar) {
        $maximum = max($values);
        $bars = array_map(
            static fn (float $point): int => $maximum > 0 ? max(8, (int) round($point * 100 / $maximum)) : 8,
            $values,
        );
    } elseif ($hasChart) {
        $minimum = min($values);
        $maximum = max($values);
        $range = $maximum - $minimum;
        $coordinates = [];

        foreach ($values as $index => $point) {
            $coordinates[] = [
                $index * 128 / (count($values) - 1),
                $range > 0 ? 4 + ($maximum - $point) * 40 / $range : 24,
            ];
        }

        $format = static fn (float $number): string => number_format($number, 2, '.', '');
        $path = 'M '.$format($coordinates[0][0]).' '.$format($coordinates[0][1]);

        for ($index = 1; $index < count($coordinates); $index++) {
            [$previousX, $previousY] = $coordinates[$index - 1];
            [$x, $y] = $coordinates[$index];
            $controlOffset = ($x - $previousX) / 3;
            $path .= ' C '.$format($previousX + $controlOffset).' '.$format($previousY).' '.$format($x - $controlOffset).' '.$format($y).' '.$format($x).' '.$format($y);
        }

        $area = $path.' L 128 48 L 0 48 Z';
    }

    $hasChange = filled($change);
    $direction = $trend ?? ($hasChange && str_starts_with(trim((string) $change), '-') ? 'down' : 'up');
    $changeTone = $direction === 'down'
        ? 'text-rose-600 dark:text-rose-400'
        : 'text-emerald-600 dark:text-emerald-400';
    $changeBadgeTone = $direction === 'down'
        ? 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400'
        : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400';
@endphp

<flux:card {{ $attributes->class('flex h-full min-w-0 flex-col gap-4') }}>
    <div class="min-w-0">
        <flux:heading level="3">{{ $label }}</flux:heading>

        @if (filled($description))
            <flux:text class="mt-1 text-sm">{{ $description }}</flux:text>
        @endif
    </div>

    @if ($hasChart)
        @if ($isBar)
            <div class="space-y-2" aria-hidden="true">
                <div class="flex h-16 items-end gap-1 {{ $chartColor }}">
                    @foreach ($bars as $height)
                        <span class="flex-1 rounded-full bg-current" style="height: {{ $height }}%"></span>
                    @endforeach
                </div>

                @if (count($labels) > 0)
                    <div class="flex gap-1">
                        @foreach ($values as $index => $point)
                            <span class="flex-1 text-center text-xs text-zinc-500 dark:text-zinc-400">{{ $labels[$index] ?? '' }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <svg class="h-16 w-full {{ $chartColor }}" viewBox="0 0 128 48" preserveAspectRatio="none" fill="none" aria-hidden="true">
                <defs>
                    <linearGradient id="{{ $chartId }}" x1="0" y1="0" x2="0" y2="48" gradientUnits="userSpaceOnUse">
                        <stop stop-color="currentColor" stop-opacity=".35" />
                        <stop offset="1" stop-color="currentColor" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path d="{{ $area }}" fill="url(#{{ $chartId }})" />
                <path d="{{ $path }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke" />
            </svg>
        @endif
    @endif

    <div class="mt-auto flex flex-wrap items-baseline gap-x-3 gap-y-1">
        <p class="text-3xl font-semibold leading-none tabular-nums text-zinc-900 dark:text-zinc-100">{{ $value }}</p>

        @if ($hasChange)
            <span @class([
                'font-medium',
                'rounded-md px-2 py-1 text-xs' => $changeStyle === 'badge',
                'text-sm' => $changeStyle !== 'badge',
                $changeStyle === 'badge' ? $changeBadgeTone : $changeTone,
            ])>{{ $change }}</span>
        @endif
    </div>
</flux:card>
