@props([
    'title' => null,
    'body' => null,
    'icon' => 'sparkles',
])

@php
    $title ??= __('lnx-ui::components.sam_empty_title');
    $body ??= __('lnx-ui::components.sam_empty_body');
@endphp

<div
    {{ $attributes->class('flex h-full min-h-64 flex-col items-center justify-center gap-3 px-4 text-center') }}
    role="status"
>
    <flux:icon :icon="$icon" class="size-8 text-violet-400" />

    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</p>
    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $body }}</p>

    @if (filled($slot))
        <div class="mt-2">{{ $slot }}</div>
    @endif
</div>
