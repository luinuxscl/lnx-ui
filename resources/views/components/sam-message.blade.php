@props([
    'role' => 'assistant',
    'name' => null,
    'copy' => false,
    'citations' => [],
    'sources' => true,
])

@php($isUser = $role === 'user')
@php($links = collect($citations)->filter(
    fn ($citation) => is_array($citation)
        && is_string($citation['url'] ?? null)
        && preg_match('#^https?://#i', $citation['url']) === 1
))

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

        @if ($sources && ! $isUser && $links->isNotEmpty())
            <div class="mt-2 border-t border-zinc-200 pt-1.5 dark:border-zinc-700" data-sam-citations>
                <span class="text-[0.65rem] font-semibold tracking-wide text-zinc-500 uppercase dark:text-zinc-400">
                    {{ __('lnx-ui::components.sam_message.sources') }}
                </span>

                <ul class="mt-0.5 space-y-0.5">
                    @foreach ($links as $citation)
                        <li>
                            <a
                                href="{{ $citation['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                data-sam-citation
                                class="inline-flex items-start gap-1 text-xs text-violet-700 underline underline-offset-2 hover:text-violet-900 focus-visible:ring-2 focus-visible:ring-violet-400 focus-visible:outline-none dark:text-violet-300 dark:hover:text-violet-100"
                            >
                                <flux:icon icon="link" class="mt-0.5 size-3 shrink-0" />
                                {{ $citation['title'] ?? $citation['url'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

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
