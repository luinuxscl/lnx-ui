@props([
    'role' => 'assistant',
    'name' => null,
    'copy' => false,
    'citations' => [],
    'sources' => true,
    'time' => null,
])

@php
    $isUser = $role === 'user';
    $links = collect($citations)->filter(
        fn ($citation) => is_array($citation)
            && is_string($citation['url'] ?? null)
            && preg_match('#^https?://#i', $citation['url']) === 1
    );
    $timestamp = $time instanceof \DateTimeInterface
        ? \Illuminate\Support\Carbon::instance($time)
        : (filled($time) ? \Illuminate\Support\Carbon::parse($time) : null);
@endphp

<div
    class="flex {{ $isUser ? 'justify-end' : 'justify-start' }}"
    @if ($copy) x-data="{ copied: false }" @endif
    data-sam-message
    data-sam-role="{{ $role }}"
>
    <div
        @class([
            'group max-w-[85%] rounded-2xl px-3 py-2 text-sm',
            'rounded-tr-xs bg-accent text-accent-foreground' => $isUser,
            'rounded-tl-xs bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100' => ! $isUser,
        ])
        role="group"
        @if (filled($name)) aria-label="{{ $name }}" @endif
    >
        @if (filled($name))
            <span class="mb-1 block text-xs font-semibold {{ $isUser ? 'text-accent-foreground/80' : 'text-zinc-500 dark:text-zinc-400' }}">
                {{ $name }}
            </span>
        @endif

        <div x-ref="content" class="whitespace-pre-line">{{ $slot }}</div>

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
                                class="inline-flex items-start gap-1 text-xs text-accent-content underline underline-offset-2 hover:underline-offset-4 focus-visible:ring-2 focus-visible:ring-accent focus-visible:outline-none"
                            >
                                <flux:icon icon="link" class="mt-0.5 size-3 shrink-0" />
                                {{ $citation['title'] ?? $citation['url'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($copy || $timestamp !== null)
            <div class="mt-1 flex items-center justify-end gap-2">
                @if ($copy)
                    <button
                        type="button"
                        data-sam-copy
                        class="inline-flex items-center gap-1 rounded text-[0.65rem] font-medium text-zinc-500 opacity-0 transition hover:text-accent-content focus-visible:opacity-100 focus-visible:ring-2 focus-visible:ring-accent focus-visible:outline-none group-hover:opacity-100 [@media(hover:none)]:opacity-100 dark:text-zinc-400"
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
                @endif

                @if ($timestamp !== null)
                    <time
                        datetime="{{ $timestamp->toIso8601String() }}"
                        title="{{ $timestamp->translatedFormat('j M Y, H:i') }}"
                        @class(['text-[0.65rem]', 'text-accent-foreground/80' => $isUser, 'text-zinc-500 dark:text-zinc-400' => ! $isUser])
                        data-sam-message-time
                    >{{ $timestamp->format('H:i') }}</time>
                @endif
            </div>
        @endif
    </div>
</div>
