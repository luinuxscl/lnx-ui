@props([
    'insight',
])

<div {{ $attributes->class('space-y-3 text-sm text-zinc-700 dark:text-zinc-300') }}>
    @if (filled($insight->label))
        <p>
            <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $insight->label }}</span>
            @if (filled($insight->resourceLabel))
                <span class="text-xs font-normal text-zinc-500 dark:text-zinc-400">· {{ $insight->resourceLabel }}</span>
            @endif
        </p>
    @endif

    <x-lnx-ui::sam-signals
        :observations="$insight->observations"
        :actions="$insight->actions"
        :observation-limit="3"
    />

    <div class="flex flex-wrap gap-2">
        @if (filled($insight->continuePrompt))
            <button
                type="button"
                data-sam-continue
                class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-3 py-1.5 text-xs font-medium text-zinc-700 transition hover:border-accent/40 hover:bg-accent/10 hover:text-accent-content dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300"
                x-on:click="$dispatch('sam-continue', { prompt: @js($insight->continuePrompt) })"
            >
                {{ __('lnx-ui::components.sam_brief.continue') }}
            </button>
        @endif

        @if (filled($insight->deepenUrl))
            <a
                href="{{ $insight->deepenUrl }}"
                class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-3 py-1.5 text-xs font-medium text-zinc-700 transition hover:border-accent/40 hover:bg-accent/10 hover:text-accent-content dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300"
            >
                {{ __('lnx-ui::components.sam_brief.deepen') }}
            </a>
        @endif
    </div>
</div>
