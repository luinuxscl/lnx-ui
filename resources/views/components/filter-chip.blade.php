@props([
    'name',
    'icon',
    'label',
    'options',
    'anyLabel' => null,
    'active' => false,
])

<flux:dropdown position="bottom" align="start">
    <flux:button
        variant="ghost"
        size="sm"
        square
        class="relative"
        :tooltip="$label"
        :aria-label="$label"
    >
        <flux:icon icon="{{ $icon }}" class="size-4" />
        @if ($active)
            <span class="absolute right-1 top-1 size-1.5 rounded-full bg-accent" aria-hidden="true"></span>
        @endif
    </flux:button>

    <div
        popover="manual"
        class="min-w-56 rounded-lg border border-zinc-200 bg-white p-3 shadow-xs focus:outline-hidden dark:border-zinc-600 dark:bg-zinc-700"
    >
        <flux:select size="sm" wire:model.live="{{ $name }}" :aria-label="$label">
            @if (filled($anyLabel))
                {{-- Null anyLabel: the filter has no empty option (e.g. pipeline on the board). --}}
                <flux:select.option value="">{{ $anyLabel }}</flux:select.option>
            @endif
            @foreach ($options as $value => $optionLabel)
                <flux:select.option :value="$value">{{ $optionLabel }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>
</flux:dropdown>
