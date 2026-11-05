@props([
    'role' => 'assistant',
    'name' => null,
    'copy' => false,
])

@php($isUser = $role === 'user')

<div
    class="flex {{ $isUser ? 'justify-end' : 'justify-start' }}"
    @if ($copy) x-data="{ copied: false }" @endif
>
    <div
        @class([
            'max-w-[85%] rounded-2xl px-3 py-2 text-sm whitespace-pre-line',
            'rounded-tr-xs bg-violet-600 text-white' => $isUser,
            'rounded-tl-xs bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100' => ! $isUser,
        ])
        role="group"
        @if (filled($name)) aria-label="{{ $name }}" @endif
    >
        @if (filled($name))
            <span class="mb-1 block text-xs font-semibold {{ $isUser ? 'text-violet-100' : 'text-zinc-500 dark:text-zinc-400' }}">
                {{ $name }}
            </span>
        @endif

        <div x-ref="content">{{ $slot }}</div>

        @if ($copy)
            <div class="mt-1 flex justify-end">
                <button
                    type="button"
                    data-sam-copy
                    class="inline-flex items-center gap-1 rounded text-[0.65rem] font-medium text-zinc-500 transition hover:text-violet-600 focus-visible:ring-2 focus-visible:ring-violet-400 focus-visible:outline-none dark:text-zinc-400 dark:hover:text-violet-300"
                    x-on:click="
                        navigator.clipboard
                            .writeText(($refs.content?.innerText ?? '').trim())
                            .then(() => { copied = true; setTimeout(() => { copied = false }, 2000) })
                            .catch(() => {})
                    "
                    x-bind:aria-label="copied ? '{{ __('lnx-ui::components.sam_message.copied') }}' : '{{ __('lnx-ui::components.sam_message.copy') }}'"
                >
                    <flux:icon icon="clipboard" class="size-3.5" />
                    <span
                        role="status"
                        x-text="copied ? '{{ __('lnx-ui::components.sam_message.copied') }}' : '{{ __('lnx-ui::components.sam_message.copy') }}'"
                    >{{ __('lnx-ui::components.sam_message.copy') }}</span>
                </button>
            </div>
        @endif
    </div>
</div>
