            <div id="rich-text-editor" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::rich-text-editor</code></flux:heading>

                @php
                    $richTextSample = '<p>'.e(__('lnx-ui::design-gallery.rich_text_sample')).'</p>';
                @endphp

                <x-lnx-ui::rich-text-editor
                    :value="$richTextSample"
                    :label="__('lnx-ui::design-gallery.rich_text_body')"
                    :placeholder="__('lnx-ui::design-gallery.rich_text_placeholder')"
                />
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="rich-text-editor" />
                @endif
            </div>
