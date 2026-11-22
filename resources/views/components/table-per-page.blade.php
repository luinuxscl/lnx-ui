@props([
    'options',
    'ariaLabel' => null,
])

<div class="shrink-0 w-28">
    <flux:select
        size="sm"
        wire:model.live="perPage"
        icon="queue-list"
        :aria-label="$ariaLabel"
    >
        @foreach ($options as $option)
            <flux:select.option value="{{ $option }}">{{ $option }}</flux:select.option>
        @endforeach
    </flux:select>
</div>
