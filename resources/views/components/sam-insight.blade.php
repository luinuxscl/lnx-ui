@props([
    'insight',
])

<div {{ $attributes->class('space-y-3 text-sm text-zinc-700 dark:text-zinc-300') }}>
    <div>
        @if (filled($insight->label))
            <p class="font-medium text-zinc-900 dark:text-zinc-100">
                {{ $insight->label }}
                @if (filled($insight->resourceLabel))
                    <span class="text-xs font-normal text-zinc-500 dark:text-zinc-400">· {{ $insight->resourceLabel }}</span>
                @endif
            </p>
        @endif

        <h4 class="mt-2 text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
            {{ __('lnx-ui::components.sam_brief.what_i_see') }}
        </h4>

        @if ($insight->observations !== [])
            <ul class="mt-1 space-y-1">
                @foreach (array_slice($insight->observations, 0, 3) as $observation)
                    <li class="flex items-start gap-2">
                        <span class="mt-1 size-1.5 shrink-0 rounded-full bg-zinc-400" aria-hidden="true"></span>
                        <span>{{ $observation }}</span>
                    </li>
                @endforeach
            </ul>

            @if (count($insight->observations) > 3)
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    {{ __('lnx-ui::components.sam_brief.more', ['count' => count($insight->observations) - 3]) }}
                </p>
            @endif
        @else
            <p class="mt-1 text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::components.sam_brief.no_signals') }}</p>
        @endif
    </div>

    @if ($insight->actions !== [])
        <div>
            <h4 class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                {{ __('lnx-ui::components.sam_brief.what_you_can_do') }}
            </h4>

            <ul class="mt-2 space-y-1">
                @foreach (array_slice($insight->actions, 0, 3) as $action)
                    <li>
                        <a href="{{ $action->url }}" class="font-medium text-violet-600 underline dark:text-violet-400">
                            {{ $action->label }}
                        </a>
                        <span class="text-zinc-600 dark:text-zinc-400">{{ $action->description }}</span>
                    </li>
                @endforeach
            </ul>

            @if (count($insight->actions) > 3)
                <details class="mt-2">
                    <summary class="cursor-pointer text-xs font-medium text-violet-600 dark:text-violet-400">
                        {{ __('lnx-ui::components.sam_brief.see_more') }}
                    </summary>

                    <ul class="mt-2 space-y-1">
                        @foreach (array_slice($insight->actions, 3) as $action)
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

    <div class="flex flex-wrap gap-2">
        @if (filled($insight->continuePrompt))
            <button
                type="button"
                data-sam-continue
                class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-700 transition hover:border-violet-300 hover:bg-violet-50 hover:text-violet-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:border-violet-700 dark:hover:bg-violet-950/40 dark:hover:text-violet-300"
                x-on:click="$dispatch('sam-continue', { prompt: @js($insight->continuePrompt) })"
            >
                {{ __('lnx-ui::components.sam_brief.continue') }}
            </button>
        @endif

        @if (filled($insight->deepenUrl))
            <a href="{{ $insight->deepenUrl }}" class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-700 transition hover:border-violet-300 hover:bg-violet-50 hover:text-violet-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:border-violet-700 dark:hover:bg-violet-950/40 dark:hover:text-violet-300">
                {{ __('lnx-ui::components.sam_brief.deepen') }}
            </a>
        @endif
    </div>
</div>
