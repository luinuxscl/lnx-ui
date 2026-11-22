@props([
    'collapsible' => false,
    'activeCount' => 0,
    'toggleLabel' => null,
])

<div x-data="{ filtersOpen: false }" {{ $attributes->class(['space-y-2' => $collapsible]) }}>
    @if ($collapsible)
        <div class="hidden max-sm:block">
            <flux:button
                size="sm"
                icon="funnel"
                x-on:click="filtersOpen = ! filtersOpen"
                x-bind:aria-expanded="filtersOpen ? 'true' : 'false'"
            >
                {{ $toggleLabel }}
                @if ($activeCount > 0)
                    <span class="tabular-nums text-zinc-500 dark:text-zinc-400">· {{ $activeCount }}</span>
                @endif
            </flux:button>
        </div>
    @endif

    <div
        {{ (new \Illuminate\View\ComponentAttributeBag)->class([
            'flex flex-wrap items-center gap-2 px-0.5 py-1',
            'max-sm:hidden' => $collapsible,
        ]) }}
        @if ($collapsible)
            :class="filtersOpen ? 'max-sm:!flex' : ''"
        @endif
    >
        {{ $slot }}
    </div>
</div>
