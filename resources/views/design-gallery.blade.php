<section class="flex w-full flex-col gap-8">
        <div>
            <flux:heading level="1">{{ __('lnx-ui::design-gallery.title') }}</flux:heading>
            <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.intro') }}</flux:text>
        </div>

        {{-- Component index: each entry links to its stable anchor (#name). --}}
        <nav aria-label="{{ __('lnx-ui::design-gallery.index') }}" class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
            <flux:heading level="2" size="sm">{{ __('lnx-ui::design-gallery.index') }}</flux:heading>
            <ul class="mt-3 grid grid-cols-2 gap-x-4 gap-y-1 font-mono text-sm sm:grid-cols-3 lg:grid-cols-4">
                @foreach (['stat', 'stat-card', 'statistics-panel', 'trend-card', 'chart-card', 'metric-card', 'summary-card', 'tool-card', 'resource-card', 'media-cell', 'chip', 'data-table', 'placeholder-pattern', 'auth-header', 'auth-session-status', 'loading', 'empty-state', 'error-state', 'validation', 'actions-statuses', 'messaging'] as $anchor)
                    <li><a href="#{{ $anchor }}" class="text-accent-content hover:underline">{{ $anchor }}</a></li>
                @endforeach
            </ul>
        </nav>

        <section class="space-y-8" aria-label="{{ __('lnx-ui::design-gallery.library_title') }}">
            <div>
                <flux:heading level="2">{{ __('lnx-ui::design-gallery.library_title') }}</flux:heading>
                <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.library_intro') }}</flux:text>
            </div>

            {{-- stat --}}
            <div id="stat" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::stat</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" color="violet" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" value="8.549k" icon="users" color="cyan" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.products')" value="1.423k" icon="shopping-cart" color="rose" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue')" value="$9745" icon="currency-dollar" color="emerald" />
                </div>
            </div>

            {{-- stat-card --}}
            <div id="stat-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::stat-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" color="violet" />
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" value="8.549k" icon="users" color="cyan" />
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.products')" value="1.423k" icon="shopping-cart" color="rose" />
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue')" value="$9745" icon="currency-dollar" color="emerald" />
                </div>

                {{-- Interactive variant: pass href to turn the card into a link; active marks the current filter. --}}
                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" color="violet" active href="#" />
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" value="8.549k" icon="users" color="cyan" href="#" />
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.products')" value="1.423k" icon="shopping-cart" color="rose" href="#" />
                    <x-lnx-ui::stat-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue')" value="$9745" icon="currency-dollar" color="emerald" href="#" />
                </div>
            </div>

            {{-- statistics-panel --}}
            <div id="statistics-panel" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::statistics-panel</code></flux:heading>

                <x-lnx-ui::statistics-panel :title="__('lnx-ui::design-gallery.statistics')" :updated-label="__('lnx-ui::design-gallery.updated_month')" updated-icon="clock">
                    <x-slot:actions>
                        <flux:button size="sm" variant="ghost" icon="arrow-down-tray">{{ __('lnx-ui::design-gallery.export') }}</flux:button>
                        <flux:button size="sm" variant="primary">{{ __('lnx-ui::design-gallery.last_7_days') }}</flux:button>
                    </x-slot:actions>
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" color="violet" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" value="8.549k" icon="users" color="cyan" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.products')" value="1.423k" icon="shopping-cart" color="rose" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue')" value="$9745" icon="currency-dollar" color="emerald" />
                </x-lnx-ui::statistics-panel>

                <x-lnx-ui::statistics-panel :title="__('lnx-ui::design-gallery.statistics_no_update')">
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" />
                </x-lnx-ui::statistics-panel>

                <x-lnx-ui::statistics-panel>
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" color="violet" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" value="8.549k" icon="users" color="cyan" />
                </x-lnx-ui::statistics-panel>

                <x-lnx-ui::statistics-panel :title="__('lnx-ui::design-gallery.statistics_empty')">
                    <x-slot:empty>
                        <flux:text>{{ __('lnx-ui::design-gallery.no_metrics') }}</flux:text>
                    </x-slot:empty>
                </x-lnx-ui::statistics-panel>
            </div>

            {{-- trend-card --}}
            <div id="trend-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::trend-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::trend-card class="col-span-12 md:col-span-6 xl:col-span-4" :label="__('lnx-ui::design-gallery.product_sold')" value="2.968" :change="__('lnx-ui::design-gallery.change_last_week', ['change' => '+3.2%'])" :series="[28, 16, 34, 42, 51, 75, 78, 80, 72, 21]" color="emerald" />
                    <x-lnx-ui::trend-card class="col-span-12 md:col-span-6 xl:col-span-4" :label="__('lnx-ui::design-gallery.total_balance')" value="24.699" :change="__('lnx-ui::design-gallery.change_last_week', ['change' => '+0.6%'])" :series="[62, 58, 54, 49, 70, 79, 91, 57, 42, 58]" color="amber" />
                    <x-lnx-ui::trend-card class="col-span-12 md:col-span-6 xl:col-span-4" :label="__('lnx-ui::design-gallery.sales_profit')" value="2.368" :change="__('lnx-ui::design-gallery.change_last_week', ['change' => '+0.9%'])" :series="[31, 78, 46, 50, 55, 29, 23, 18, 15, 22]" color="rose" />
                </div>
            </div>

            {{-- chart-card --}}
            <div id="chart-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::chart-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.order')" :description="__('lnx-ui::design-gallery.last_week')" value="124k" change="+12.6%" :series="[40, 55, 35, 60, 45, 75, 90]" chart="bar" color="violet" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" :description="__('lnx-ui::design-gallery.sales_last_year')" value="175k" change="-16.2%" :series="[28, 16, 34, 42, 51, 75, 78, 80, 72, 21]" chart="line" color="emerald" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue_growth')" :description="__('lnx-ui::design-gallery.weekly_report')" value="$4,673" change="+15.2%" :series="[30, 45, 25, 55, 60, 95, 70]" chart="bar" :labels="__('lnx-ui::design-gallery.weekdays')" color="emerald" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" :description="__('lnx-ui::design-gallery.last_week')" value="230k" change="+3.2%" change-style="badge" :series="[]" color="amber" />
                </div>
            </div>

            {{-- metric-card --}}
            <div id="metric-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::metric-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.total_profit')" :description="__('lnx-ui::design-gallery.last_week')" value="1.28k" change="-12.2%" icon="banknotes" color="rose" />
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.total_sales')" :description="__('lnx-ui::design-gallery.last_week')" value="24.67k" change="+24.5%" icon="shopping-bag" color="emerald" />
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" :description="__('lnx-ui::design-gallery.last_week')" value="8.549k" change="+4.1%" change-style="text" icon="users" color="blue" />
                </div>
            </div>

            {{-- summary-card --}}
            <div id="summary-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::summary-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.store_sales')" value="$5,345.43" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '5k'])" change="+5.7%" icon="building-storefront" color="violet" />
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.website_sales')" value="$674,347.12" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '21k'])" change="+12.4%" icon="computer-desktop" color="blue" />
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.discount')" value="$14,235.12" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '6k'])" icon="gift" color="amber" />
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.affiliate')" value="$8,345.23" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '150'])" change="-3.5%" icon="share" color="emerald" />
                </div>
            </div>

            {{-- tool-card --}}
            <div id="tool-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::tool-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.chat')" :description="__('lnx-ui::design-gallery.chat_description')" icon="chat-bubble-left-right" color="violet" href="#" />
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.users')" :description="__('lnx-ui::design-gallery.users_description')" icon="users" color="blue" href="#" />
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.repository')" :description="__('lnx-ui::design-gallery.repository_description')" icon="code-bracket" external href="https://github.com/luinuxscl/lnx" />
                </div>
            </div>

            {{-- resource-card --}}
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
            </div>

            {{-- media-cell --}}
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
            </div>

            {{-- chip --}}
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
            </div>

            {{-- data-table --}}
            <div id="data-table" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::data-table</code></flux:heading>

                @php
                    $people = [
                        ['name' => 'Amelia Chen', 'role' => __('lnx-ui::design-gallery.role_design_lead'), 'category' => ['label' => __('lnx-ui::design-gallery.cat_design'), 'icon' => 'swatch', 'color' => 'violet'], 'reference' => 'REF-4821', 'price' => '$125.00', 'quantity' => '942', 'status' => ['label' => __('lnx-ui::design-gallery.status_inactive'), 'color' => 'red'], 'active' => false],
                        ['name' => 'Noah Patel', 'role' => __('lnx-ui::design-gallery.role_backend'), 'category' => ['label' => __('lnx-ui::design-gallery.cat_engineering'), 'icon' => 'cpu-chip', 'color' => 'blue'], 'reference' => 'REF-5829', 'price' => '$263.49', 'quantity' => '587', 'status' => ['label' => __('lnx-ui::design-gallery.status_active'), 'color' => 'green'], 'active' => true],
                        ['name' => 'Sofia Rossi', 'role' => __('lnx-ui::design-gallery.role_product_manager'), 'category' => ['label' => __('lnx-ui::design-gallery.cat_product'), 'icon' => 'cube', 'color' => 'emerald'], 'reference' => 'REF-35946', 'price' => '$248.39', 'quantity' => '468', 'status' => ['label' => __('lnx-ui::design-gallery.status_active'), 'color' => 'green'], 'active' => true],
                        ['name' => 'Liam Walsh', 'role' => __('lnx-ui::design-gallery.role_data_analyst'), 'category' => ['label' => __('lnx-ui::design-gallery.cat_data'), 'icon' => 'chart-bar', 'color' => 'cyan'], 'reference' => 'REF-46658', 'price' => '$799.00', 'quantity' => '851', 'status' => ['label' => __('lnx-ui::design-gallery.status_scheduled'), 'color' => 'amber'], 'active' => false],
                        ['name' => 'Mia Novak', 'role' => __('lnx-ui::design-gallery.role_marketing'), 'category' => ['label' => __('lnx-ui::design-gallery.cat_marketing'), 'icon' => 'megaphone', 'color' => 'amber'], 'reference' => 'REF-41867', 'price' => '$79.99', 'quantity' => '519', 'status' => ['label' => __('lnx-ui::design-gallery.status_inactive'), 'color' => 'red'], 'active' => true],
                        ['name' => 'Ethan Brooks', 'role' => __('lnx-ui::design-gallery.role_support'), 'category' => ['label' => __('lnx-ui::design-gallery.cat_support'), 'icon' => 'lifebuoy', 'color' => 'rose'], 'reference' => 'REF-63474', 'price' => '$399.00', 'quantity' => '810', 'status' => ['label' => __('lnx-ui::design-gallery.status_scheduled'), 'color' => 'amber'], 'active' => true],
                    ];
                @endphp

                <x-lnx-ui::data-table
                    :title="__('lnx-ui::design-gallery.directory_title')"
                    :description="__('lnx-ui::design-gallery.directory_description')"
                    :filters-label="__('lnx-ui::design-gallery.table_filter')"
                    table-class="min-w-[64rem]"
                    container-class="max-h-96 overflow-auto"
                >
                    <x-slot:filters>
                        <div class="w-full sm:w-52">
                            <flux:select :aria-label="__('lnx-ui::design-gallery.filter_status')">
                                <flux:select.option value="">{{ __('lnx-ui::design-gallery.filter_all') }}</flux:select.option>
                                <flux:select.option value="inactive">{{ __('lnx-ui::design-gallery.status_inactive') }}</flux:select.option>
                                <flux:select.option value="scheduled">{{ __('lnx-ui::design-gallery.status_scheduled') }}</flux:select.option>
                                <flux:select.option value="active">{{ __('lnx-ui::design-gallery.status_active') }}</flux:select.option>
                            </flux:select>
                        </div>

                        <div class="w-full sm:w-52">
                            <flux:select :aria-label="__('lnx-ui::design-gallery.filter_category')">
                                <flux:select.option value="">{{ __('lnx-ui::design-gallery.filter_all') }}</flux:select.option>
                                <flux:select.option value="design">{{ __('lnx-ui::design-gallery.cat_design') }}</flux:select.option>
                                <flux:select.option value="engineering">{{ __('lnx-ui::design-gallery.cat_engineering') }}</flux:select.option>
                                <flux:select.option value="product">{{ __('lnx-ui::design-gallery.cat_product') }}</flux:select.option>
                            </flux:select>
                        </div>

                        <div class="w-full sm:w-52">
                            <flux:select :aria-label="__('lnx-ui::design-gallery.col_stock')">
                                <flux:select.option value="">{{ __('lnx-ui::design-gallery.filter_all') }}</flux:select.option>
                                <flux:select.option value="in">{{ __('lnx-ui::design-gallery.stock_in') }}</flux:select.option>
                                <flux:select.option value="out">{{ __('lnx-ui::design-gallery.stock_out') }}</flux:select.option>
                            </flux:select>
                        </div>
                    </x-slot:filters>

                    <x-slot:toolbar>
                        <div class="w-full sm:max-w-xs">
                            <flux:input icon="magnifying-glass" :placeholder="__('lnx-ui::design-gallery.search_placeholder')" />
                        </div>
                    </x-slot:toolbar>

                    <x-slot:actions>
                        <div class="w-28">
                            <flux:select :aria-label="__('lnx-ui::design-gallery.per_page')">
                                <flux:select.option value="7">7</flux:select.option>
                                <flux:select.option value="25">25</flux:select.option>
                                <flux:select.option value="50">50</flux:select.option>
                            </flux:select>
                        </div>

                        <flux:dropdown align="end">
                            <flux:button icon="arrow-down-tray" icon:trailing="chevron-down">{{ __('lnx-ui::design-gallery.export') }}</flux:button>
                            <flux:menu>
                                <flux:menu.item icon="document-text">CSV</flux:menu.item>
                                <flux:menu.item icon="table-cells">XLSX</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>

                        <flux:button variant="primary" icon="plus">{{ __('lnx-ui::design-gallery.add_resource') }}</flux:button>
                    </x-slot:actions>

                    <flux:table.columns sticky class="bg-white dark:bg-zinc-900">
                        <flux:table.column class="w-10"><flux:checkbox :aria-label="__('lnx-ui::design-gallery.col_item')" /></flux:table.column>
                        <flux:table.column class="w-72">{{ __('lnx-ui::design-gallery.col_item') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_category') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_stock') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_reference') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_price') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_quantity') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_status') }}</flux:table.column>
                        <flux:table.column align="end" class="w-20">{{ __('lnx-ui::design-gallery.col_actions') }}</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($people as $person)
                            <flux:table.row :key="$person['name']">
                                <flux:table.cell><flux:checkbox :aria-label="$person['name']" /></flux:table.cell>
                                <flux:table.cell>
                                    <x-lnx-ui::media-cell :title="$person['name']" :description="$person['role']" icon="user" :color="$person['category']['color']" />
                                </flux:table.cell>
                                <flux:table.cell>
                                    <x-lnx-ui::chip :label="$person['category']['label']" :icon="$person['category']['icon']" :color="$person['category']['color']" />
                                </flux:table.cell>
                                <flux:table.cell><flux:switch :checked="$person['active']" :aria-label="__('lnx-ui::design-gallery.col_stock')" /></flux:table.cell>
                                <flux:table.cell>{{ $person['reference'] }}</flux:table.cell>
                                <flux:table.cell>{{ $person['price'] }}</flux:table.cell>
                                <flux:table.cell>{{ $person['quantity'] }}</flux:table.cell>
                                <flux:table.cell><flux:badge :color="$person['status']['color']" size="sm">{{ $person['status']['label'] }}</flux:badge></flux:table.cell>
                                <flux:table.cell align="end">
                                    <div class="flex items-center justify-end gap-1">
                                        <flux:button size="sm" variant="ghost" icon="pencil-square" :aria-label="__('lnx-ui::design-gallery.action_edit')" />
                                        <flux:dropdown align="end">
                                            <flux:button size="sm" variant="ghost" icon="ellipsis-vertical" :aria-label="__('lnx-ui::design-gallery.action_more')" />
                                            <flux:menu>
                                                <flux:menu.item icon="eye">{{ __('lnx-ui::design-gallery.action_view') }}</flux:menu.item>
                                                <flux:menu.item icon="pencil-square">{{ __('lnx-ui::design-gallery.action_edit') }}</flux:menu.item>
                                                <flux:menu.item variant="danger" icon="trash">{{ __('lnx-ui::design-gallery.action_delete') }}</flux:menu.item>
                                            </flux:menu>
                                        </flux:dropdown>
                                    </div>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </x-lnx-ui::data-table>

                <x-lnx-ui::data-table :title="__('lnx-ui::design-gallery.directory_title')">
                    <flux:table.columns>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_item') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_category') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_status') }}</flux:table.column>
                        <flux:table.column align="end">{{ __('lnx-ui::design-gallery.col_actions') }}</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        <flux:table.row>
                            <flux:table.cell colspan="4">{{ __('lnx-ui::design-gallery.no_records') }}</flux:table.cell>
                        </flux:table.row>
                    </flux:table.rows>
                </x-lnx-ui::data-table>
            </div>

            {{-- placeholder-pattern --}}
            <div id="placeholder-pattern" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::placeholder-pattern</code></flux:heading>

                <div class="size-32 rounded-lg border border-zinc-200 text-zinc-300 dark:border-zinc-800 dark:text-zinc-700">
                    <x-lnx-ui::placeholder-pattern class="size-full [&_path]:fill-none [&_path]:stroke-current" />
                </div>
            </div>

            {{-- auth-header --}}
            <div id="auth-header" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::auth-header</code></flux:heading>

                <flux:card>
                    <x-lnx-ui::auth-header :title="__('lnx-ui::design-gallery.login_title')" :description="__('lnx-ui::design-gallery.login_description')" />
                </flux:card>
            </div>

            {{-- auth-session-status --}}
            <div id="auth-session-status" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::auth-session-status</code></flux:heading>

                <flux:card>
                    <x-lnx-ui::auth-session-status :status="__('lnx-ui::design-gallery.password_reset')" />
                </flux:card>
            </div>
        </section>

        <section class="space-y-4" aria-label="{{ __('lnx-ui::design-gallery.states_title') }}">
            <flux:heading level="2">{{ __('lnx-ui::design-gallery.states_title') }}</flux:heading>

            <div class="grid gap-6 lg:grid-cols-2">
                <flux:card id="loading" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.loading') }}</flux:heading>
                    <flux:skeleton class="h-5 w-2/3" />
                    <flux:skeleton class="h-5 w-full" />
                    <flux:skeleton class="h-9 w-28" />
                </flux:card>

                <flux:card id="empty-state" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.empty_state') }}</flux:heading>
                    <flux:text>{{ __('lnx-ui::design-gallery.no_invitations') }}</flux:text>
                    <flux:button href="#" wire:navigate>{{ __('lnx-ui::design-gallery.invite_user') }}</flux:button>
                </flux:card>

                <flux:card id="error-state" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.error_state') }}</flux:heading>
                    <flux:callout variant="danger" icon="x-circle">
                        <flux:callout.heading>{{ __('lnx-ui::design-gallery.invitation_failed') }}</flux:callout.heading>
                        <flux:callout.text>{{ __('lnx-ui::design-gallery.try_again') }}</flux:callout.text>
                    </flux:callout>
                </flux:card>

                <flux:card id="validation" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.validation') }}</flux:heading>
                    <flux:field>
                        <flux:label>{{ __('lnx-ui::design-gallery.email') }}</flux:label>
                        <flux:input type="email" value="invalid-email" aria-invalid="true" />
                        <flux:error name="email" :message="__('lnx-ui::design-gallery.invalid_email')" />
                    </flux:field>
                </flux:card>
            </div>
        </section>

        <section id="actions-statuses" class="scroll-mt-24" aria-label="{{ __('lnx-ui::design-gallery.actions_statuses') }}">
            <flux:card class="space-y-4">
                <flux:heading level="2">{{ __('lnx-ui::design-gallery.actions_statuses') }}</flux:heading>
                <div class="flex flex-wrap items-center gap-3">
                    <flux:badge color="green">{{ __('lnx-ui::design-gallery.active') }}</flux:badge>
                    <flux:badge color="amber">{{ __('lnx-ui::design-gallery.suspended') }}</flux:badge>
                    <flux:button variant="primary" href="#" wire:navigate>{{ __('lnx-ui::design-gallery.invite_user') }}</flux:button>
                    <flux:button variant="ghost" href="#" wire:navigate>{{ __('lnx-ui::design-gallery.cancel') }}</flux:button>
                </div>
            </flux:card>
        </section>

        <section id="messaging" class="scroll-mt-24 space-y-4" aria-label="{{ __('lnx-ui::design-gallery.messaging') }}">
            <flux:heading level="2">{{ __('lnx-ui::design-gallery.messaging') }}</flux:heading>
            <flux:card class="space-y-4">
                <div class="flex items-center justify-between">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.chat_sample') }}</flux:heading>
                    <flux:button size="sm" variant="primary" href="#" wire:navigate>
                        {{ __('lnx-ui::design-gallery.open_messages') }}
                    </flux:button>
                </div>
                <div class="space-y-3 rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex flex-col items-start">
                        <div class="max-w-md rounded-2xl rounded-tl-xs border border-zinc-200 bg-white p-3 text-sm text-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100">
                            <span class="block text-xs font-bold text-zinc-500">Felecia Rower</span>
                            {{ __('lnx-ui::design-gallery.chat_line_1') }}
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <div class="max-w-md rounded-2xl rounded-tr-xs bg-gradient-to-r from-indigo-600 to-violet-600 p-3 text-sm text-white">
                            {{ __('lnx-ui::design-gallery.chat_line_2') }}
                        </div>
                    </div>
                </div>
            </flux:card>
        </section>
    </section>
