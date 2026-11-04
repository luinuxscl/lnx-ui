@props([
    'source',
    'id',
    'title',
    'summary' => null,
    'changes' => [],
    'status' => 'pending',
    'expiresAt' => null,
    'recordUrl' => null,
    'canConfirm' => false,
])

@php
    $expires = $expiresAt !== null ? \Illuminate\Support\Carbon::parse($expiresAt) : null;
    $expired = $expires !== null && $expires->isPast();
    $state = $expired ? 'expired' : $status;
    $statusLabel = \Illuminate\Support\Facades\Lang::has('lnx-ui::components.sam_proposal_statuses.'.$state)
        ? __('lnx-ui::components.sam_proposal_statuses.'.$state)
        : $state;
    $phraseId = 'sam-phrase-'.\Illuminate\Support\Str::slug($source.'-'.$id);
@endphp

<article
    data-sam-proposal
    {{ $attributes->class('rounded-xl border border-zinc-200 bg-white p-3 text-sm shadow-sm dark:border-zinc-800 dark:bg-zinc-950/40') }}
>
    <header class="flex items-start justify-between gap-3">
        <div class="min-w-0">
            <h3 class="truncate font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h3>

            @if (filled($summary))
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ $summary }}</p>
            @endif
        </div>

        <span @class([
            'shrink-0 rounded-full px-2 py-0.5 text-[11px] font-medium',
            'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' => $state === 'confirmed',
            'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300' => in_array($state, ['pending', 'draft', 'proposed'], true),
            'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300' => $state === 'duplicate',
            'bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300' => in_array($state, ['failed', 'expired'], true),
        ])>
            {{ $statusLabel }}
        </span>
    </header>

    @if ($changes !== [])
        <dl class="mt-3 space-y-2">
            @foreach ($changes as $change)
                <div class="grid gap-0.5">
                    <dt class="text-xs font-medium text-zinc-600 dark:text-zinc-400">
                        {{ filled($change['label'] ?? null) ? $change['label'] : ($change['field'] ?? '') }}
                    </dt>
                    <dd class="flex flex-wrap items-baseline gap-2 text-sm">
                        @if (filled($change['old'] ?? null))
                            <span class="text-rose-600 line-through decoration-rose-400 dark:text-rose-400">
                                {{ $change['old'] }}
                            </span>
                        @endif
                        <span class="font-medium text-emerald-700 dark:text-emerald-400">
                            {{ $change['new'] ?? '' }}
                        </span>
                    </dd>
                </div>
            @endforeach
        </dl>
    @endif

    <footer class="mt-3 space-y-2 border-t border-zinc-200 pt-2 dark:border-zinc-800">
        <div class="flex flex-wrap items-center justify-between gap-2 text-xs text-zinc-500 dark:text-zinc-400">
            <span>
                @if ($expires !== null)
                    {{ $expired
                        ? __('lnx-ui::components.sam_proposal_expired')
                        : __('lnx-ui::components.sam_proposal_expires', ['time' => $expires->diffForHumans()]) }}
                @endif
            </span>

            @if (filled($recordUrl))
                <a
                    href="{{ $recordUrl }}"
                    class="font-medium text-violet-600 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-300"
                >
                    {{ __('lnx-ui::components.sam_proposal_view_record') }}
                </a>
            @endif
        </div>

        @if ($canConfirm && ! $expired && filled($source) && filled($id))
            <div
                x-data="{ phrase: '' }"
                x-on:sam-phrase-consumed.window="phrase = ''"
                class="flex flex-wrap items-center gap-2"
            >
                <label class="sr-only" for="{{ $phraseId }}">
                    {{ __('lnx-ui::components.sam_proposal_phrase_label') }}
                </label>

                <input
                    id="{{ $phraseId }}"
                    type="text"
                    x-model="phrase"
                    autocomplete="off"
                    spellcheck="false"
                    maxlength="64"
                    placeholder="{{ __('lnx-ui::components.sam_proposal_phrase_placeholder') }}"
                    class="min-w-0 flex-1 rounded-lg border border-zinc-300 bg-white px-2 py-1.5 font-mono text-xs text-zinc-900 placeholder:font-sans placeholder:text-zinc-400 focus:border-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500/30 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                />

                <flux:button
                    size="sm"
                    variant="primary"
                    x-bind:disabled="phrase.trim().length === 0"
                    x-on:click="$dispatch('sam-confirm', { source: @js($source), id: @js($id), phrase: phrase })"
                >
                    {{ __('lnx-ui::components.sam_proposal_confirm') }}
                </flux:button>
            </div>

            <p class="text-[11px] text-zinc-500 dark:text-zinc-400">
                {{ __('lnx-ui::components.sam_proposal_phrase_hint') }}
            </p>
        @endif
    </footer>
</article>
