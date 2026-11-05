@props([
    'brief',
    'narrativeUrl' => null,
])

@php($narrativeEndpoint = filled($narrativeUrl) ? $narrativeUrl : data_get($brief, 'narrativeUrl'))

<div
    {{ $attributes->class('space-y-3 text-sm text-zinc-700 dark:text-zinc-300') }}
    @if (filled($narrativeEndpoint))
        x-data="{ narrative: @js($brief->narrative) }"
        x-init="
            const key = 'sam-brief-narrative:' + @js($narrativeEndpoint);
            if (! sessionStorage.getItem(key)) {
                fetch(@js($narrativeEndpoint), { headers: { Accept: 'application/json' }, credentials: 'same-origin' })
                    .then((response) => response.status === 200 ? response.json() : null)
                    .then((payload) => {
                        if (payload && typeof payload.narrative === 'string' && payload.narrative.trim() !== '') {
                            narrative = payload.narrative;
                        }
                    })
                    .catch(() => {})
                    .finally(() => sessionStorage.setItem(key, '1'));
            }
        "
    @else
        x-data="{ narrative: @js($brief->narrative) }"
    @endif
    data-sam-brief
>
    <div>
        <h3 class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
            {{ __('lnx-ui::components.sam_brief.title') }}
        </h3>

        @if (filled($brief->label))
            <p class="mt-1 font-medium text-zinc-900 dark:text-zinc-100">
                {{ $brief->label }}
                @if (filled($brief->resourceLabel))
                    <span class="text-xs font-normal text-zinc-500 dark:text-zinc-400">· {{ $brief->resourceLabel }}</span>
                @endif
            </p>
        @endif

        @if (filled($brief->narrative))
            <p
                class="mt-1 whitespace-pre-line"
                aria-live="polite"
                data-sam-brief-narrative
                x-text="narrative"
            >{{ $brief->narrative }}</p>
        @endif
    </div>

    <x-lnx-ui::sam-signals :observations="$brief->observations" :actions="$brief->actions" />

    @if (filled($brief->continuePrompt))
        <div class="flex flex-wrap gap-2">
            <button
                type="button"
                data-sam-continue
                class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-3 py-1.5 text-xs font-medium text-zinc-700 transition hover:border-accent/40 hover:bg-accent/10 hover:text-accent-content dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300"
                x-on:click="$dispatch('sam-continue', { prompt: @js($brief->continuePrompt) })"
            >
                {{ __('lnx-ui::components.sam_brief.continue') }}
            </button>
        </div>
    @endif
</div>
