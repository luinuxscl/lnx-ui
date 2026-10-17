@props([
    'sender',
    'email' => null,
    'avatar' => null,
    'subject' => null,
    'date' => null,
])

<flux:card {{ $attributes->class('flex min-w-0 flex-col') }}>
    <header class="flex items-start gap-3 border-b border-zinc-200 pb-4 dark:border-zinc-700">
        <flux:avatar :src="$avatar" :name="$sender" circle />

        <div class="min-w-0">
            <flux:heading level="3" class="truncate">{{ $sender }}</flux:heading>

            @if (filled($email))
                <flux:text class="truncate">{{ $email }}</flux:text>
            @endif
        </div>

        @isset($actions)
            <div class="ms-auto flex shrink-0 items-center gap-1">{{ $actions }}</div>
        @endisset
    </header>

    <div class="flex-1 space-y-4 pt-4">
        @if (filled($subject) || filled($date))
            <div class="flex items-baseline gap-3">
                @if (filled($subject))
                    <flux:heading level="2" class="min-w-0 truncate">{{ $subject }}</flux:heading>
                @endif

                @if (filled($date))
                    <time class="ms-auto shrink-0 text-xs text-zinc-400 dark:text-zinc-500">{{ $date }}</time>
                @endif
            </div>
        @endif

        <div class="text-sm text-zinc-700 dark:text-zinc-300">
            {{ $slot }}
        </div>

        @isset($attachments)
            <section class="space-y-3">{{ $attachments }}</section>
        @endisset

        @isset($reply)
            <section class="space-y-3">{{ $reply }}</section>
        @endisset
    </div>

    @isset($footer)
        <footer class="mt-4 border-t border-zinc-200 pt-4 dark:border-zinc-700">{{ $footer }}</footer>
    @endisset
</flux:card>
