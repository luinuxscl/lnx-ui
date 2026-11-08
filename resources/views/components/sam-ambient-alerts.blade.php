@props([
    'alerts' => [],
])

<div {{ $attributes->class(['space-y-2 rounded-lg border border-amber-200 bg-amber-50 p-3 dark:border-amber-900/50 dark:bg-amber-950/30']) }} data-sam-ambient-alerts>
    <flux:text class="text-xs font-medium text-amber-900 dark:text-amber-200">
        {{ __('lnx-ui::components.sam_ambient.title') }}
    </flux:text>

    <ul class="space-y-2">
        @foreach ($alerts as $alert)
            <li
                wire:key="sam-ambient-{{ $alert['resource'] }}-{{ $alert['record_id'] }}-{{ $alert['signal'] }}"
                class="flex flex-col gap-2 rounded-md bg-white/70 p-2 text-sm dark:bg-zinc-900/50"
            >
                <div class="text-zinc-800 dark:text-zinc-100">
                    @if ($alert['source'] === 'crm')
                        {{ trans('crm::crm.sam.signals.'.$alert['signal'], ['count' => $alert['value']]) }}
                    @else
                        {{ $alert['signal'] }}
                    @endif
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    @if (filled($alert['evidence'] ?? null))
                        <flux:link :href="$alert['evidence']" size="sm" wire:navigate>
                            {{ __('lnx-ui::components.sam_ambient.review') }}
                        </flux:link>
                    @endif

                    <flux:button
                        size="xs"
                        variant="ghost"
                        wire:click="dismissAmbientAlert(
                            @js($alert['source']),
                            @js($alert['resource']),
                            @js($alert['record_id']),
                            @js($alert['signal']),
                            @js($alert['fingerprint'])
                        )"
                    >
                        {{ __('lnx-ui::components.sam_ambient.dismiss') }}
                    </flux:button>

                    <flux:button
                        size="xs"
                        variant="ghost"
                        wire:click="silenceAmbientAlert(@js($alert['source']), @js($alert['signal']))"
                    >
                        {{ __('lnx-ui::components.sam_ambient.silence') }}
                    </flux:button>

                    <flux:button
                        size="xs"
                        variant="ghost"
                        wire:click="hideAmbientAlert(@js($alert['source']), @js($alert['signal']))"
                    >
                        {{ __('lnx-ui::components.sam_ambient.hide') }}
                    </flux:button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
