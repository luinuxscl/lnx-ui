@props([
    'label' => null,
])

@php($label ??= __('lnx-ui::components.sam_typing'))

<div
    {{ $attributes->class('inline-flex items-center gap-1.5 rounded-full bg-zinc-100 px-3 py-1.5 dark:bg-zinc-800') }}
    role="status"
    aria-label="{{ $label }}"
>
    <span class="size-1.5 animate-bounce rounded-full bg-zinc-400 [animation-delay:-0.3s]"></span>
    <span class="size-1.5 animate-bounce rounded-full bg-zinc-400 [animation-delay:-0.15s]"></span>
    <span class="size-1.5 animate-bounce rounded-full bg-zinc-400"></span>
</div>
