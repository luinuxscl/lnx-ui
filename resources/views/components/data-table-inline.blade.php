@props([
    'title' => null,
    'description' => null,
    'paginate' => null,
    'tableClass' => null,
    'containerClass' => null,
])

@php
    $hasFilters = isset($filters) && $filters->hasActualContent();
    $hasFiltersActions = isset($filtersActions) && $filtersActions->hasActualContent();
    $hasFilterRow = $hasFilters || $hasFiltersActions;
    $hasHeader = filled($title) || $hasFilterRow;
    $hasToolbar = (isset($toolbar) && $toolbar->hasActualContent()) || (isset($actions) && $actions->hasActualContent());
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

            @if ($hasFilterRow)
                <div class="flex flex-wrap items-end gap-4">
                    {{ $filters ?? '' }}

                    @if ($hasFiltersActions)
                        <div class="flex w-full items-center gap-2 sm:ms-auto sm:w-auto">{{ $filtersActions }}</div>
                    @endif
                </div>
            @endif
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

    {{--
        min-w-0 lets this wrapper shrink below its content, so columns hidden by
        breakpoint actually reduce the table width instead of forcing an
        unreachable horizontal overflow that the card would clip.
    --}}
    <div @class([
        'min-w-0 border-zinc-200 px-4 pb-4 sm:px-6 sm:pb-6 dark:border-zinc-800',
        'border-t' => $hasSeparator,
    ])>
        <flux:table :paginate="$paginate" :class="$tableClasses" :container:class="$containerClass">
            {{ $slot }}
        </flux:table>
    </div>
</flux:card>
