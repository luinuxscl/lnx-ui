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
                class="rounded-full border border-zinc-200 bg-white px-3 py-1.5 text-xs font-medium text-zinc-700 transition hover:border-accent/40 hover:bg-accent/10 hover:text-accent-content focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300"
            >
                {{ $item }}
            </button>
        @endforeach
    </div>
@endif
