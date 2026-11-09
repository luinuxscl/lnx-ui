@php
    $sortable = \Luinuxscl\LnxUi\KanbanAssets::sortableSource();
    $behavior = \Luinuxscl\LnxUi\KanbanAssets::behaviorSource();
@endphp

<div
    x-data="lnxKanban()"
    x-init="init()"
    {{ $attributes->class('flex h-full min-h-0 items-stretch gap-3 overflow-x-auto overflow-y-hidden pb-1') }}
>
    {{ $slot }}
</div>

@once
    <style>
        .lnx-kanban-ghost {
            opacity: 0.35;
        }

        .lnx-kanban-chosen {
            cursor: grabbing;
        }

        .lnx-kanban-drag {
            transform: rotate(2deg);
            box-shadow: 0 12px 28px rgb(0 0 0 / 0.18);
        }

        .dark .lnx-kanban-drag {
            box-shadow: 0 16px 40px rgb(0 0 0 / 0.55);
        }
    </style>
    @if ($sortable !== '')
        <script>{!! $sortable !!}</script>
    @endif
    @if ($behavior !== '')
        <script>{!! $behavior !!}</script>
    @endif
@endonce
