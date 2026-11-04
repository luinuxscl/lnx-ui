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
            'fixed inset-y-0 right-0 z-50 h-full border-s' => ! $preview && ! $dock,
            'fixed inset-y-0 right-0 z-30 h-full border-s' => $dock,
            'relative h-[34rem] overflow-hidden rounded-xl border' => $preview,
        ])
        role="{{ $dock ? 'complementary' : 'dialog' }}"
        @if (! $dock) aria-modal="true" @endif
        @if (! $dock) aria-labelledby="sam-panel-title" @endif
        aria-label="{{ $label }}"
    >
        <header class="flex items-start justify-between gap-3 border-b border-zinc-200 px-4 py-3 dark:border-zinc-800">
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <flux:icon icon="sparkles" class="size-4 shrink-0 text-violet-500" />
                    <h2 id="sam-panel-title" class="truncate text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $title }}
                    </h2>
                    @if (filled($subtitle))
                        <span class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ $subtitle }}</span>
                    @endif
                </div>

                @isset($context)
                    <div class="mt-1">{{ $context }}</div>
                @endisset
            </div>

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
        </header>

        <div class="flex-1 overflow-y-auto px-4 py-4">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="border-t border-zinc-200 p-3 dark:border-zinc-800">
                {{ $footer }}
            </div>
        @endisset
    </aside>
</div>
