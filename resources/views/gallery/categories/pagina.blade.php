            <div id="page-header" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::page-header</code></flux:heading>

                <x-lnx-ui::page-header
                    :title="__('lnx-ui::design-gallery.page_header_title')"
                    :subtitle="__('lnx-ui::design-gallery.page_header_subtitle')"
                    icon="users"
                    color="blue"
                >
                    <x-slot:actions>
                        <flux:button size="sm" icon="arrow-down-tray">{{ __('lnx-ui::design-gallery.page_header_export') }}</flux:button>
                        <flux:button size="sm" variant="primary" icon="plus">{{ __('lnx-ui::design-gallery.page_header_add') }}</flux:button>
                    </x-slot:actions>
                </x-lnx-ui::page-header>

                <x-lnx-ui::page-header
                    :title="__('lnx-ui::design-gallery.page_header_title')"
                    :subtitle="__('lnx-ui::design-gallery.page_header_subtitle')"
                    :eyebrow="__('lnx-ui::design-gallery.page_header_eyebrow')"
                />

                <x-lnx-ui::page-header
                    :title="__('lnx-ui::design-gallery.page_header_title')"
                    :subtitle="__('lnx-ui::design-gallery.page_header_subtitle')"
                />
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="page-header" />
                @endif
            </div>
