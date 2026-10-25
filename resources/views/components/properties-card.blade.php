@props([
    'title' => null,
    'description' => null,
    'items' => [],
    'columns' => 1,
    'empty' => null,
])

@php
    $properties = is_array($items) ? $items : $items->all();
    $properties = array_values($properties);
    $hasHeader = filled($title) || filled($description);
    $gridClass = (int) $columns >= 2
        ? 'grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2'
        : 'grid grid-cols-1 gap-4';
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

    @if ($properties !== [])
        <dl @class([$gridClass, 'mt-5' => $hasHeader || isset($actions)])>
            @foreach ($properties as $property)
                @php
                    $label = $property['label'] ?? null;
                    $value = $property['value'] ?? null;
                    $href = $property['href'] ?? null;
                    $icon = $property['icon'] ?? null;
                @endphp

                @continue(blank($label))

                <div class="min-w-0">
                    <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ $label }}</dt>

                    <dd class="mt-1 flex min-w-0 items-start gap-2 text-sm text-zinc-900 dark:text-zinc-100">
                        @if (filled($icon))
                            <flux:icon :icon="$icon" variant="micro" class="mt-0.5 size-4 shrink-0 text-zinc-400 dark:text-zinc-500" aria-hidden="true" />
                        @endif

                        @if (filled($href))
                            <a href="{{ $href }}" class="min-w-0 break-words rounded-sm text-accent-content hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">{{ $value }}</a>
                        @else
                            <span class="min-w-0 break-words">{{ filled($value) ? $value : '—' }}</span>
                        @endif
                    </dd>
                </div>
            @endforeach
        </dl>
    @elseif (isset($empty))
        <div @class(['text-sm text-zinc-500 dark:text-zinc-400', 'mt-4' => $hasHeader || isset($actions)])>{{ $empty }}</div>
    @endif

    @if (isset($slot) && ! $slot->isEmpty())
        <div @class(['mt-5' => $properties !== [] || $hasHeader || isset($actions)])>{{ $slot }}</div>
    @endif
</flux:card>
