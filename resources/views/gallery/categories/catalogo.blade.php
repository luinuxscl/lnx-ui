            <div id="tool-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::tool-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.chat')" :description="__('lnx-ui::design-gallery.chat_description')" icon="chat-bubble-left-right" color="violet" href="#" />
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.users')" :description="__('lnx-ui::design-gallery.users_description')" icon="users" color="blue" href="#" />
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.repository')" :description="__('lnx-ui::design-gallery.repository_description')" icon="code-bracket" external href="https://github.com/luinuxscl/lnx" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="tool-card" />
                @endif
            </div>
            <div id="resource-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::resource-card</code></flux:heading>

                <div class="space-y-4">
                    <div>
                        <flux:heading level="2">{{ __('lnx-ui::design-gallery.resources_heading') }}</flux:heading>
                        <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.resources_intro') }}</flux:text>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <x-lnx-ui::resource-card
                            class="col-span-12 md:col-span-6 xl:col-span-3"
                            title="create-ui-component"
                            :description="__('lnx-ui::design-gallery.resource_create_ui_component')"
                            :eyebrow="__('lnx-ui::design-gallery.skill_eyebrow')"
                            icon="sparkles"
                            color="violet"
                            href="#"
                        >
                            <x-slot:badges>
                                <flux:badge color="amber" size="sm">{{ __('lnx-ui::design-gallery.advanced') }}</flux:badge>
                                <flux:badge color="violet" size="sm" icon="clock">{{ __('lnx-ui::design-gallery.minutes', ['count' => 10]) }}</flux:badge>
                            </x-slot:badges>
                            <x-slot:tags>
                                <flux:badge size="sm">{{ __('lnx-ui::design-gallery.tag_ui') }}</flux:badge>
                                <flux:text class="text-xs">+8</flux:text>
                            </x-slot:tags>
                            <x-slot:meta>
                                <span class="inline-flex items-center gap-1 text-xs">
                                    <flux:icon icon="clock" variant="micro" class="size-3.5" aria-hidden="true" />
                                    1mo
                                </span>
                            </x-slot:meta>
                        </x-lnx-ui::resource-card>

                        <x-lnx-ui::resource-card
                            class="col-span-12 md:col-span-6 xl:col-span-3"
                            title="expose-mcp-operation"
                            :description="__('lnx-ui::design-gallery.resource_expose_mcp_operation')"
                            :eyebrow="__('lnx-ui::design-gallery.skill_eyebrow')"
                            icon="server-stack"
                            color="blue"
                            href="#"
                        >
                            <x-slot:badges>
                                <flux:badge color="green" size="sm">{{ __('lnx-ui::design-gallery.intermediate') }}</flux:badge>
                                <flux:badge color="blue" size="sm" icon="clock">{{ __('lnx-ui::design-gallery.minutes', ['count' => 30]) }}</flux:badge>
                            </x-slot:badges>
                            <x-slot:tags>
                                <flux:badge size="sm">{{ __('lnx-ui::design-gallery.tag_mcp') }}</flux:badge>
                                <flux:text class="text-xs">+5</flux:text>
                            </x-slot:tags>
                            <x-slot:meta>
                                <span class="inline-flex items-center gap-1 text-xs">
                                    <flux:icon icon="clock" variant="micro" class="size-3.5" aria-hidden="true" />
                                    2mo
                                </span>
                            </x-slot:meta>
                        </x-lnx-ui::resource-card>

                        <x-lnx-ui::resource-card
                            class="col-span-12 md:col-span-6 xl:col-span-3"
                            title="lnx-ui-release"
                            :description="__('lnx-ui::design-gallery.resource_release_lnx_ui')"
                            href="#"
                        >
                            <x-slot:tags>
                                <flux:badge size="sm">{{ __('lnx-ui::design-gallery.tag_package') }}</flux:badge>
                                <flux:text class="text-xs">+3</flux:text>
                            </x-slot:tags>
                            <x-slot:meta>
                                <span class="inline-flex items-center gap-1 text-xs">
                                    <flux:icon icon="arrow-down-tray" variant="micro" class="size-3.5" aria-hidden="true" /> 2K
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs">
                                    <flux:icon icon="clock" variant="micro" class="size-3.5" aria-hidden="true" />
                                    5mo
                                </span>
                            </x-slot:meta>
                            <x-slot:actions>
                                <div x-data="{ copied: false, copy(text) { navigator.clipboard?.writeText(text).catch(() => {}); this.copied = true; setTimeout(() => this.copied = false, 1500); } }">
                                    <flux:button size="sm" variant="ghost" type="button" x-on:click="copy(@js('lnx-ui-release'))">
                                        <span x-show="! copied">{{ __('lnx-ui::design-gallery.copy') }}</span>
                                        <span x-show="copied" x-cloak>{{ __('lnx-ui::design-gallery.copied') }}</span>
                                    </flux:button>
                                </div>
                            </x-slot:actions>
                        </x-lnx-ui::resource-card>

                        <x-lnx-ui::resource-card
                            class="col-span-12 md:col-span-6 xl:col-span-3"
                            title="brand-logos"
                            :description="__('lnx-ui::design-gallery.resource_brand_logos')"
                        >
                            <x-slot:tags>
                                <flux:badge size="sm">{{ __('lnx-ui::design-gallery.tag_brand') }}</flux:badge>
                                <flux:text class="text-xs">+4</flux:text>
                            </x-slot:tags>
                            <x-slot:meta>
                                <span class="inline-flex items-center gap-1 text-xs">
                                    <flux:icon icon="arrow-down-tray" variant="micro" class="size-3.5" aria-hidden="true" /> 2K
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs">
                                    <flux:icon icon="clock" variant="micro" class="size-3.5" aria-hidden="true" />
                                    4mo
                                </span>
                            </x-slot:meta>
                        </x-lnx-ui::resource-card>
                    </div>
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="resource-card" />
                @endif
            </div>
            <div id="properties-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::properties-card</code></flux:heading>

                <div class="grid gap-4 lg:grid-cols-2">
                    <x-lnx-ui::properties-card
                        :title="__('lnx-ui::design-gallery.properties_title')"
                        :description="__('lnx-ui::design-gallery.properties_description')"
                        :items="[
                            ['label' => __('lnx-ui::design-gallery.properties_owner'), 'value' => 'Ana Ruiz', 'icon' => 'user'],
                            ['label' => __('lnx-ui::design-gallery.properties_stage'), 'value' => __('lnx-ui::design-gallery.properties_stage_value')],
                            ['label' => __('lnx-ui::design-gallery.properties_domain'), 'value' => 'acme.test', 'href' => 'https://acme.test'],
                            ['label' => __('lnx-ui::design-gallery.properties_phone'), 'value' => null],
                        ]"
                        :columns="2"
                    >
                        <x-slot:actions>
                            <flux:button size="sm" variant="ghost" icon="pencil-square">{{ __('lnx-ui::design-gallery.action_edit') }}</flux:button>
                        </x-slot:actions>
                    </x-lnx-ui::properties-card>

                    <x-lnx-ui::properties-card :title="__('lnx-ui::design-gallery.properties_empty_title')">
                        <x-slot:empty>{{ __('lnx-ui::design-gallery.properties_empty') }}</x-slot:empty>
                    </x-lnx-ui::properties-card>
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="properties-card" />
                @endif
            </div>
            <div id="timeline" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::timeline</code></flux:heading>

                <div class="grid gap-4 lg:grid-cols-2">
                    <x-lnx-ui::timeline
                        :title="__('lnx-ui::design-gallery.timeline_title')"
                        :description="__('lnx-ui::design-gallery.timeline_description')"
                        :items="[
                            [
                                'title' => __('lnx-ui::design-gallery.timeline_created'),
                                'description' => __('lnx-ui::design-gallery.timeline_created_description'),
                                'time' => __('lnx-ui::design-gallery.timeline_time_today'),
                                'datetime' => '2026-10-25T09:15:00Z',
                                'icon' => 'plus-circle',
                                'color' => 'emerald',
                                'meta' => 'Ana Ruiz',
                            ],
                            [
                                'title' => __('lnx-ui::design-gallery.timeline_updated'),
                                'description' => __('lnx-ui::design-gallery.timeline_updated_description'),
                                'time' => __('lnx-ui::design-gallery.timeline_time_yesterday'),
                                'datetime' => '2026-10-24T17:40:00Z',
                                'icon' => 'pencil-square',
                                'color' => 'blue',
                                'meta' => 'Luis',
                            ],
                            [
                                'title' => __('lnx-ui::design-gallery.timeline_tagged'),
                                'time' => __('lnx-ui::design-gallery.timeline_time_week'),
                                'icon' => 'tag',
                                'color' => 'violet',
                            ],
                        ]"
                    />

                    <x-lnx-ui::timeline :title="__('lnx-ui::design-gallery.timeline_empty_title')">
                        <x-slot:empty>{{ __('lnx-ui::design-gallery.timeline_empty') }}</x-slot:empty>
                    </x-lnx-ui::timeline>
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="timeline" />
                @endif
            </div>
            <div id="media-cell" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::media-cell</code></flux:heading>

                <flux:card class="space-y-4">
                    <div>
                        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::design-gallery.media_cell_with_icon') }}</flux:text>
                        <div class="mt-3 space-y-3">
                            <x-lnx-ui::media-cell title="Amelia Chen" :description="__('lnx-ui::design-gallery.role_design_lead')" icon="user" color="violet" />
                            <x-lnx-ui::media-cell title="Noah Patel" :description="__('lnx-ui::design-gallery.role_backend')" icon="user" color="blue" />
                        </div>
                    </div>

                    <div class="border-t border-zinc-200 pt-4 dark:border-zinc-800">
                        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::design-gallery.media_cell_text') }}</flux:text>
                        <div class="mt-3">
                            <x-lnx-ui::media-cell title="Mia Novak" :description="__('lnx-ui::design-gallery.role_marketing')" />
                        </div>
                    </div>
                </flux:card>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="media-cell" />
                @endif
            </div>
            <div id="chip" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::chip</code></flux:heading>

                <flux:card>
                    <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::design-gallery.chip_colors') }}</flux:text>
                    <div class="mt-3 flex flex-wrap items-center gap-4">
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_design')" icon="swatch" color="violet" />
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_engineering')" icon="cpu-chip" color="blue" />
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_product')" icon="cube" color="emerald" />
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_data')" icon="chart-bar" color="cyan" />
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_marketing')" icon="megaphone" color="amber" />
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_support')" icon="lifebuoy" color="rose" />
                        <x-lnx-ui::chip :label="__('lnx-ui::design-gallery.cat_design')" />
                    </div>
                </flux:card>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="chip" />
                @endif
            </div>
