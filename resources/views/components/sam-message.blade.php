@props([
    'role' => 'assistant',
    'name' => null,
])

@php($isUser = $role === 'user')

<div class="flex {{ $isUser ? 'justify-end' : 'justify-start' }}">
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

        {{ $slot }}
    </div>
</div>
