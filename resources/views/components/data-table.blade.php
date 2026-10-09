@props([
    'title' => null,
    'description' => null,
    'filtersLabel' => null,
    'paginate' => null,
    'tableClass' => null,
])

@php
    $hasHeader = filled($title) || isset($filters);
    $hasToolbar = isset($toolbar) || isset($actions);
    $hasSeparator = $hasHeader || $hasToolbar;
    $tableClasses = trim('w-full '.(string) $tableClass);
@endphp

<flux:card {{ $attributes->class('overflow-hidden p-0') }}>
    @if ($hasHeader)
        <div class="space-y-4 p-4 sm:p-6">
            @if (filled($title))
                <div class="min-w-0">
                    <flux:heading level="2" size="lg">{{ $title }}</flux:heading>

                    @if (filled($description))
                        <flux:text class="mt-1 text-sm">{{ $description }}</flux:text>
                    @endif
                </div>
            @endif

            @isset($filters)
                @if (filled($filtersLabel))
                    <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ $filtersLabel }}</flux:text>
                @endif

                <div class="flex flex-wrap items-end gap-4">{{ $filters }}</div>
            @endisset
        </div>
    @endif

    @if ($hasToolbar)
        <div @class([
            'flex flex-col gap-3 border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-6 dark:border-zinc-800',
            'border-t' => $hasHeader,
        ])>
            <div class="min-w-0 flex-1">{{ $toolbar ?? '' }}</div>

            @isset($actions)
                <div class="flex shrink-0 flex-wrap items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div @class([
        'border-zinc-200 px-4 pb-4 sm:px-6 sm:pb-6 dark:border-zinc-800',
        'border-t' => $hasSeparator,
    ])>
        <flux:table :paginate="$paginate" :class="$tableClasses">
            {{ $slot }}
        </flux:table>
    </div>
</flux:card>
