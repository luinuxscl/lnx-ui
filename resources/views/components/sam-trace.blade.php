@props([
    'trace',
])

@php
    $kinds = [
        'read' => ['icon' => 'eye', 'label' => __('lnx-ui::components.sam_trace.kind.read')],
        'proposal' => ['icon' => 'document-plus', 'label' => __('lnx-ui::components.sam_trace.kind.proposal')],
        'confirmation' => ['icon' => 'check-circle', 'label' => __('lnx-ui::components.sam_trace.kind.confirmation')],
        'denied' => ['icon' => 'shield-exclamation', 'label' => __('lnx-ui::components.sam_trace.kind.denied')],
    ];
@endphp

@if ($trace->entries !== [])
    <details
        data-sam-trace
        {{ $attributes->class('rounded-lg border border-zinc-200 bg-zinc-50/60 px-3 py-2 text-sm dark:border-zinc-800 dark:bg-zinc-900/40') }}
    >
        <summary class="flex cursor-pointer items-center gap-2 text-xs font-medium text-zinc-600 dark:text-zinc-300">
            <flux:icon icon="magnifying-glass" class="size-3.5 shrink-0 text-zinc-400" />
            <span>{{ __('lnx-ui::components.sam_trace.title') }}</span>
            <span class="rounded-full bg-accent/10 px-1.5 py-0.5 text-[0.65rem] font-semibold text-accent-content">
                {{ count($trace->entries) }}
            </span>
        </summary>

        <ul class="mt-2 space-y-1">
            @foreach ($trace->entries as $entry)
                @php
                    $kind = $kinds[$entry->kind] ?? $kinds['read'];
                    $statusKey = 'lnx-ui::components.sam_trace.status.'.$entry->status;
                    $status = trans()->has($statusKey) ? __($statusKey) : null;
                @endphp

                <li
                    data-sam-trace-entry
                    class="flex flex-wrap items-center gap-x-2 gap-y-1 text-zinc-700 dark:text-zinc-300"
                >
                    <flux:icon :icon="$kind['icon']" class="size-3.5 shrink-0 text-zinc-400" />
                    <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">{{ $kind['label'] }}</span>

                    @if (filled($entry->label))
                        <span>{{ $entry->label }}</span>
                    @endif

                    @if ($entry->count !== null)
                        <span class="text-xs text-zinc-500 dark:text-zinc-400">
                            {{ trans_choice('lnx-ui::components.sam_trace.results', $entry->count, ['count' => $entry->count]) }}
                        </span>
                    @endif

                    @if ($status !== null && ! in_array($entry->status, ['read', 'success'], true))
                        <span class="rounded-full bg-rose-100 px-1.5 py-0.5 text-[0.65rem] font-semibold text-rose-700 dark:bg-rose-950/50 dark:text-rose-300">
                            {{ $status }}
                        </span>
                    @endif

                    @if (filled($entry->url))
                        <a href="{{ $entry->url }}" class="ms-auto text-xs font-medium text-accent-content underline underline-offset-2 hover:underline-offset-4">
                            {{ __('lnx-ui::components.sam_trace.open') }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>

        @if (filled($trace->activityUrl))
            <a href="{{ $trace->activityUrl }}" class="mt-2 inline-flex text-xs font-medium text-accent-content underline underline-offset-2 hover:underline-offset-4">
                {{ __('lnx-ui::components.sam_trace.activity') }}
            </a>
        @endif
    </details>
@endif
