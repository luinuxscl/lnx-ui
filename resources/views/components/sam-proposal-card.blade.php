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
    'risk' => 'irreversible',
    'requiresPhrase' => null,
    'canUndo' => false,
    'undoExpiresAt' => null,
])

@php
    $risk = in_array($risk, ['reversible', 'irreversible', 'bulk'], true) ? $risk : 'irreversible';
    $requiresPhrase ??= $risk !== 'reversible';

    $expires = $expiresAt !== null ? \Illuminate\Support\Carbon::parse($expiresAt) : null;
    $expired = $expires !== null && $expires->isPast();
    $state = $expired ? 'expired' : $status;
    $statusLabel = \Illuminate\Support\Facades\Lang::has('lnx-ui::components.sam_proposal_statuses.'.$state)
        ? __('lnx-ui::components.sam_proposal_statuses.'.$state)
        : $state;
    $badgeColor = match (true) {
        $state === 'confirmed' => 'green',
        in_array($state, ['pending', 'draft', 'proposed'], true) => 'amber',
        $state === 'duplicate' => 'zinc',
        default => 'red',
    };
    $riskLabel = __("lnx-ui::components.sam_proposal_risks.{$risk}");
    $riskIcon = match ($risk) {
        'reversible' => 'arrow-uturn-left',
        'bulk' => 'rectangle-stack',
        default => 'lock-closed',
    };

    $undoExpires = $undoExpiresAt !== null ? \Illuminate\Support\Carbon::parse($undoExpiresAt) : null;
    $undoable = $canUndo
        && $state === 'confirmed'
        && ($undoExpires === null || ! $undoExpires->isPast());

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

        <div class="flex shrink-0 flex-col items-end gap-1">
            <flux:badge :color="$badgeColor" size="sm" data-sam-proposal-status>
                {{ $statusLabel }}
            </flux:badge>

            <span
                data-sam-proposal-risk="{{ $risk }}"
                class="inline-flex items-center gap-1 text-[11px] font-medium text-zinc-500 dark:text-zinc-400"
            >
                <flux:icon :icon="$riskIcon" class="size-3" />
                {{ $riskLabel }}
            </span>
        </div>
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
                    class="font-medium text-accent-content underline-offset-2 hover:underline"
                >
                    {{ __('lnx-ui::components.sam_proposal_view_record') }}
                </a>
            @endif
        </div>

        @if ($undoable)
            <div
                data-sam-proposal-undo
                x-data="{ used: false }"
                class="flex flex-wrap items-center justify-between gap-2"
            >
                <span class="text-[11px] text-zinc-500 dark:text-zinc-400">
                    {{ $undoExpires !== null
                        ? __('lnx-ui::components.sam_proposal_undo_expires', ['time' => $undoExpires->diffForHumans()])
                        : __('lnx-ui::components.sam_proposal_undo_hint') }}
                </span>

                <flux:button
                    size="sm"
                    variant="filled"
                    icon="arrow-uturn-left"
                    x-bind:disabled="used"
                    x-on:click="used = true; $dispatch('sam-undo', { source: @js($source), id: @js($id) })"
                >
                    {{ __('lnx-ui::components.sam_proposal_undo') }}
                </flux:button>
            </div>
        @endif

        @if ($canConfirm && ! $expired && filled($source) && filled($id))
            @if ($requiresPhrase)
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
                        class="min-w-0 flex-1 rounded-lg border border-zinc-300 bg-white px-2 py-1.5 font-mono text-xs text-zinc-900 placeholder:font-sans placeholder:text-zinc-400 focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder:text-zinc-500"
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
            @else
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">
                        {{ __('lnx-ui::components.sam_proposal_click_hint') }}
                    </p>

                    <flux:button
                        size="sm"
                        variant="primary"
                        x-on:click="$dispatch('sam-confirm', { source: @js($source), id: @js($id), phrase: '' })"
                    >
                        {{ __('lnx-ui::components.sam_proposal_confirm') }}
                    </flux:button>
                </div>
            @endif
        @endif
    </footer>
</article>
