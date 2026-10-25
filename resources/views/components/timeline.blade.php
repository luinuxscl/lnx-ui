@props([
    'title' => null,
    'description' => null,
    'items' => [],
    'empty' => null,
])

@php
    $entries = is_array($items) ? $items : $items->all();
    $entries = array_values($entries);
    $hasHeader = filled($title) || filled($description);

    $tone = fn (string $color): string => match ($color) {
        'violet' => 'bg-violet-100 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400',
        'cyan' => 'bg-cyan-100 text-cyan-600 dark:bg-cyan-500/15 dark:text-cyan-400',
        'rose' => 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400',
        'emerald' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400',
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400',
        'amber' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
        default => 'bg-accent/10 text-accent-content',
    };
@endphp

<flux:card {{ $attributes->class('min-w-0') }}>
    @if ($hasHeader || isset($actions))
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div class="min-w-0">
                @if (filled($title))
                    <flux:heading level="2" size="lg">{{ $title }}</flux:heading>
                @endif

                @if (filled($description))
                    <flux:text class="mt-1 text-sm">{{ $description }}</flux:text>
                @endif
            </div>

            @isset($actions)
                <div class="flex shrink-0 flex-wrap items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    @if ($entries !== [])
        <ol @class(['space-y-0', 'mt-5' => $hasHeader || isset($actions)])>
            @foreach ($entries as $entry)
                @php
                    $icon = $entry['icon'] ?? 'clock';
                    $color = (string) ($entry['color'] ?? 'accent');
                    $time = $entry['time'] ?? null;
                    $datetime = $entry['datetime'] ?? null;
                @endphp

                <li class="relative flex gap-3 pb-5 last:pb-0">
                    <div class="flex flex-col items-center">
                        <span @class(['flex size-8 shrink-0 items-center justify-center rounded-full', $tone($color)]) aria-hidden="true">
                            <flux:icon :icon="$icon" variant="mini" class="size-4" />
                        </span>

                        @unless ($loop->last)
                            <span class="mt-1 w-px flex-1 bg-zinc-200 dark:bg-zinc-800" aria-hidden="true"></span>
                        @endunless
                    </div>

                    <div class="min-w-0 flex-1 pt-0.5">
                        <div class="flex flex-wrap items-baseline justify-between gap-x-3 gap-y-1">
                            @if (filled($entry['title'] ?? null))
                                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $entry['title'] }}</p>
                            @endif

                            @if (filled($time))
                                <time @if (filled($datetime)) datetime="{{ $datetime }}" @endif class="text-xs text-zinc-500 dark:text-zinc-400">{{ $time }}</time>
                            @endif
                        </div>

                        @if (filled($entry['description'] ?? null))
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">{{ $entry['description'] }}</p>
                        @endif

                        @if (filled($entry['meta'] ?? null))
                            <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ $entry['meta'] }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    @elseif (isset($empty))
        <div @class(['text-sm text-zinc-500 dark:text-zinc-400', 'mt-4' => $hasHeader || isset($actions)])>{{ $empty }}</div>
    @elseif (isset($slot) && ! $slot->isEmpty())
        <div @class(['mt-5' => $hasHeader || isset($actions)])>{{ $slot }}</div>
    @endif
</flux:card>
