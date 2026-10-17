@props([
    'users' => [],
    'title' => null,
])

<div {{ $attributes->class('min-w-0') }}>
    @if (filled($title))
        <flux:text class="px-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ $title }}</flux:text>
    @endif

    <ul class="mt-2 flex flex-col gap-1">
        @foreach ($users as $user)
            <li class="flex items-center gap-3 rounded-lg px-3 py-1.5">
                <span class="relative shrink-0">
                    <flux:avatar :src="$user['avatar'] ?? null" :name="$user['name']" circle size="sm" />

                    @if ($user['online'] ?? true)
                        <span
                            class="absolute -end-0.5 -bottom-0.5 size-2.5 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-zinc-900"
                            aria-hidden="true"
                        ></span>
                    @endif
                </span>

                <span class="min-w-0 flex-1">
                    <span class="block truncate text-sm font-medium text-zinc-800 dark:text-zinc-100">{{ $user['name'] }}</span>

                    @if (filled($user['line'] ?? null))
                        <span class="block truncate text-xs text-zinc-500 dark:text-zinc-400">{{ $user['line'] }}</span>
                    @endif
                </span>
            </li>
        @endforeach

        {{ $slot }}
    </ul>
</div>
