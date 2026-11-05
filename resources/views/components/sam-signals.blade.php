@props([
    'observations' => [],
    'actions' => [],
    'observationLimit' => null,
    'actionLimit' => 3,
])

@php
    $observations = array_values($observations);
    $actions = array_values($actions);
    $visibleObservations = $observationLimit === null
        ? $observations
        : array_slice($observations, 0, $observationLimit);
    $hiddenObservations = count($observations) - count($visibleObservations);
    $visibleActions = array_slice($actions, 0, $actionLimit);
    $remainingActions = array_slice($actions, $actionLimit);
@endphp

<div {{ $attributes->class('space-y-3') }}>
    <div>
        <h4 class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
            {{ __('lnx-ui::components.sam_brief.what_i_see') }}
        </h4>

        @if ($observations !== [])
            <ul class="mt-1 space-y-1">
                @foreach ($visibleObservations as $observation)
                    <li class="flex items-start gap-2">
                        <span class="mt-1 size-1.5 shrink-0 rounded-full bg-accent/60" aria-hidden="true"></span>
                        <span>{{ $observation }}</span>
                    </li>
                @endforeach
            </ul>

            @if ($hiddenObservations > 0)
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    {{ __('lnx-ui::components.sam_brief.more', ['count' => $hiddenObservations]) }}
                </p>
            @endif
        @else
            <p class="mt-1 text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::components.sam_brief.no_signals') }}</p>
        @endif
    </div>

    @if ($actions !== [])
        <div>
            <h4 class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                {{ __('lnx-ui::components.sam_brief.what_you_can_do') }}
            </h4>

            <ul class="mt-2 space-y-1">
                @foreach ($visibleActions as $action)
                    <li>
                        <a href="{{ $action->url }}" class="font-medium text-accent-content underline underline-offset-2 hover:underline-offset-4">
                            {{ $action->label }}
                        </a>
                        <span class="text-zinc-600 dark:text-zinc-400">{{ $action->description }}</span>
                    </li>
                @endforeach
            </ul>

            @if ($remainingActions !== [])
                <details class="mt-2">
                    <summary class="cursor-pointer text-xs font-medium text-accent-content">
                        {{ __('lnx-ui::components.sam_brief.see_more') }}
                    </summary>

                    <ul class="mt-2 space-y-1">
                        @foreach ($remainingActions as $action)
                            <li>
                                <a href="{{ $action->url }}" class="font-medium text-accent-content underline underline-offset-2 hover:underline-offset-4">
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
</div>
