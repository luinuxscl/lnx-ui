<div id="kanban" class="scroll-mt-24 space-y-3">
    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::kanban</code></flux:heading>

    <div class="h-80 overflow-x-auto rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900/40">
        <x-lnx-ui::kanban class="h-full min-h-72">
            <x-lnx-ui::kanban.column :title="__('lnx-ui::design-gallery.kanban_column_todo')" column-id="1" :count="2">
                <x-lnx-ui::kanban.card card-id="101">{{ __('lnx-ui::design-gallery.kanban_card_a') }}</x-lnx-ui::kanban.card>
                <x-lnx-ui::kanban.card card-id="102">{{ __('lnx-ui::design-gallery.kanban_card_b') }}</x-lnx-ui::kanban.card>
            </x-lnx-ui::kanban.column>
            <x-lnx-ui::kanban.column :title="__('lnx-ui::design-gallery.kanban_column_done')" column-id="2" :count="0" />
        </x-lnx-ui::kanban>
    </div>

    @if ($showSnippets ?? false)
        <x-lnx-ui::gallery-snippet name="kanban" />
    @endif
</div>
