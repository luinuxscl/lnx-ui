@props([
    'items' => [],
    'label' => null,
])

@if ($items !== [])
    <div
        {{ $attributes->class('flex flex-wrap gap-2') }}
        role="group"
        aria-label="{{ $label ?? __('lnx-ui::components.sam_suggestions') }}"
    >
        @foreach ($items as $item)
            <button
                type="button"
                x-data
                x-on:click="$dispatch('sam-suggestion', { text: @js($item) })"
                class="rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-700 transition hover:border-violet-300 hover:bg-violet-50 hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:border-violet-700 dark:hover:bg-violet-950/40 dark:hover:text-violet-300"
            >
                {{ $item }}
            </button>
        @endforeach
    </div>
@endif
