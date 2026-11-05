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

        <h4 class="mt-2 text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
            {{ __('lnx-ui::components.sam_brief.what_i_see') }}
        </h4>

        @if ($brief->observations !== [])
            <ul class="mt-1 space-y-1">
                @foreach ($brief->observations as $observation)
                    <li class="flex items-start gap-2">
                        <span class="mt-1 size-1.5 shrink-0 rounded-full bg-zinc-400" aria-hidden="true"></span>
                        <span>{{ $observation }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-1 text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::components.sam_brief.no_signals') }}</p>
        @endif
    </div>

    @if ($brief->actions !== [])
        <div>
            <h4 class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                {{ __('lnx-ui::components.sam_brief.what_you_can_do') }}
            </h4>

            <ul class="mt-2 space-y-1">
                @foreach (array_slice($brief->actions, 0, 3) as $action)
                    <li>
                        <a href="{{ $action->url }}" class="font-medium text-violet-600 underline dark:text-violet-400">
                            {{ $action->label }}
                        </a>
                        <span class="text-zinc-600 dark:text-zinc-400">{{ $action->description }}</span>
                    </li>
                @endforeach
            </ul>

            @if (count($brief->actions) > 3)
                <details class="mt-2">
                    <summary class="cursor-pointer text-xs font-medium text-violet-600 dark:text-violet-400">
                        {{ __('lnx-ui::components.sam_brief.see_more') }}
                    </summary>

                    <ul class="mt-2 space-y-1">
                        @foreach (array_slice($brief->actions, 3) as $action)
                            <li>
                                <a href="{{ $action->url }}" class="font-medium text-violet-600 underline dark:text-violet-400">
                                    {{ $action->label }}
                                </a>
                                <span class="text-zinc-600 dark:text-zinc-400">{{ $action->description }}</span>
                            </li>
                        @endforeach
                    </ul>
                </details>
            @endif
        </div>
    @endif

    @if (filled($brief->continuePrompt))
        <div class="flex flex-wrap gap-2">
            <button
                type="button"
                data-sam-continue
                class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-700 transition hover:border-violet-300 hover:bg-violet-50 hover:text-violet-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:border-violet-700 dark:hover:bg-violet-950/40 dark:hover:text-violet-300"
                x-on:click="$dispatch('sam-continue', { prompt: @js($brief->continuePrompt) })"
            >
                {{ __('lnx-ui::components.sam_brief.continue') }}
            </button>
        </div>
    @endif
</div>
