@props([
    'open' => 'true',
    'close' => null,
    'title' => null,
    'subtitle' => null,
    'label' => null,
    'preview' => false,
    'dock' => false,
])

@php
    $title ??= __('lnx-ui::components.sam_title');
    $subtitle ??= __('lnx-ui::components.sam_subtitle');
    $label ??= $title;
@endphp

<div
    data-sam-panel
    {{ $attributes->class($preview ? 'relative w-full max-w-md' : '') }}
>
    @unless ($preview || $dock)
        <div
            x-show="{{ $open }}"
            x-transition.opacity
            @if (filled($close)) x-on:click="{{ $close }}" @endif
            class="fixed inset-0 z-40 bg-zinc-950/40"
            aria-hidden="true"
        ></div>
    @endunless

    <aside
        x-show="{{ $open }}"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        @if (filled($close)) x-on:keydown.escape.window="{{ $close }}" @endif
        @class([
            'flex w-full max-w-md flex-col border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900',
            'shadow-xl' => ! $dock,
            'shadow-sm' => $dock,
            'fixed inset-y-0 right-0 z-50 h-dvh border-s' => ! $preview && ! $dock,
            'fixed inset-y-0 right-0 z-30 h-dvh border-s' => $dock,
            'relative h-[34rem] overflow-hidden rounded-xl border' => $preview,
        ])
        role="{{ $dock ? 'complementary' : 'dialog' }}"
        @if (! $dock) aria-modal="true" @endif
        @if (! $dock) aria-labelledby="sam-panel-title" @endif
        aria-label="{{ $label }}"
    >
        <header class="flex items-start justify-between gap-2 border-b border-zinc-200 px-4 pt-[calc(0.75rem+env(safe-area-inset-top))] pb-3 dark:border-zinc-800">
            <div class="flex min-w-0 items-center gap-2">
                <flux:icon icon="sparkles" class="size-4 shrink-0 text-accent-content" />
                <h2 id="sam-panel-title" class="truncate text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                    {{ $title }}
                </h2>
                @if (filled($subtitle))
                    <span class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ $subtitle }}</span>
                @endif
            </div>

            <div class="flex shrink-0 items-center gap-1">
                @isset($actions)
                    {{ $actions }}
                @endisset

                @if (filled($close))
                    <flux:button
                        variant="ghost"
                        size="sm"
                        square
                        icon="x-mark"
                        x-on:click="{{ $close }}"
                        :aria-label="__('lnx-ui::components.sam_close')"
                        :title="__('lnx-ui::components.sam_close')"
                    />
                @endif
            </div>
        </header>

        @isset($context)
            <div class="border-b border-zinc-200/70 px-4 py-2 dark:border-zinc-800/70">
                {{ $context }}
            </div>
        @endisset

        <div class="min-h-0 flex-1 overflow-y-auto overscroll-contain px-4 py-4">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="border-t border-zinc-200 p-3 pb-[calc(0.75rem+env(safe-area-inset-bottom))] dark:border-zinc-800">
                {{ $footer }}
            </div>
        @endisset
    </aside>
</div>
