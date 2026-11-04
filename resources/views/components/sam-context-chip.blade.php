@props([
    'label',
    'source' => null,
    'icon' => 'computer-desktop',
])

<span {{ $attributes->class('inline-flex max-w-full items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-1 text-xs text-zinc-600 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-300') }}>
    <flux:icon :icon="$icon" class="size-3.5 shrink-0 text-zinc-400" />

    <span class="shrink-0 text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::components.sam_context') }}:</span>
    <span class="truncate font-medium text-zinc-800 dark:text-zinc-100">{{ $label }}</span>

    @if (filled($source))
        <span class="shrink-0 text-zinc-400 dark:text-zinc-500">· {{ $source }}</span>
    @endif
</span>
