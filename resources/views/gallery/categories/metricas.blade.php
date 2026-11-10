            <div id="stat" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::stat</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" value="230k" icon="chart-pie" color="violet" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" value="8.549k" icon="users" color="cyan" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.products')" value="1.423k" icon="shopping-cart" color="rose" />
                    <x-lnx-ui::stat class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue')" value="$9745" icon="currency-dollar" color="emerald" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="stat" />
                @endif
            </div>
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
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="stat-card" />
                @endif
            </div>
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
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="statistics-panel" />
                @endif
            </div>
            <div id="widget" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::widget</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::widget :title="__('lnx-ui::design-gallery.statistics')" :description="__('lnx-ui::design-gallery.statistics_no_update')" href="#" span="6">
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::design-gallery.no_metrics') }}</p>
                    </x-lnx-ui::widget>

                    <x-lnx-ui::widget :title="__('lnx-ui::design-gallery.statistics_empty')" :empty="__('lnx-ui::design-gallery.no_metrics')" span="6" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="widget" />
                @endif
            </div>
            <div id="trend-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::trend-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::trend-card class="col-span-12 md:col-span-6 xl:col-span-4" :label="__('lnx-ui::design-gallery.product_sold')" value="2.968" :change="__('lnx-ui::design-gallery.change_last_week', ['change' => '+3.2%'])" :series="[28, 16, 34, 42, 51, 75, 78, 80, 72, 21]" color="emerald" />
                    <x-lnx-ui::trend-card class="col-span-12 md:col-span-6 xl:col-span-4" :label="__('lnx-ui::design-gallery.total_balance')" value="24.699" :change="__('lnx-ui::design-gallery.change_last_week', ['change' => '+0.6%'])" :series="[62, 58, 54, 49, 70, 79, 91, 57, 42, 58]" color="amber" />
                    <x-lnx-ui::trend-card class="col-span-12 md:col-span-6 xl:col-span-4" :label="__('lnx-ui::design-gallery.sales_profit')" value="2.368" :change="__('lnx-ui::design-gallery.change_last_week', ['change' => '+0.9%'])" :series="[31, 78, 46, 50, 55, 29, 23, 18, 15, 22]" color="rose" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="trend-card" />
                @endif
            </div>
            <div id="chart-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::chart-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.order')" :description="__('lnx-ui::design-gallery.last_week')" value="124k" change="+12.6%" :series="[40, 55, 35, 60, 45, 75, 90]" chart="bar" color="violet" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" :description="__('lnx-ui::design-gallery.sales_last_year')" value="175k" change="-16.2%" :series="[28, 16, 34, 42, 51, 75, 78, 80, 72, 21]" chart="line" color="emerald" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue_growth')" :description="__('lnx-ui::design-gallery.weekly_report')" value="$4,673" change="+15.2%" :series="[30, 45, 25, 55, 60, 95, 70]" chart="bar" :labels="__('lnx-ui::design-gallery.weekdays')" color="emerald" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales')" :description="__('lnx-ui::design-gallery.last_week')" value="230k" change="+3.2%" change-style="badge" :series="[]" color="amber" />
                    <x-lnx-ui::chart-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.sales_profit')" :description="__('lnx-ui::design-gallery.last_week')" :help="__('lnx-ui::design-gallery.chart_help')" value="175k" change="+15.2%" :series="[28, 16, 34, 42, 51, 75, 78, 80, 72, 21]" chart="line" color="emerald" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="chart-card" />
                @endif
            </div>
            <div id="metric-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::metric-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.total_profit')" :description="__('lnx-ui::design-gallery.last_week')" value="1.28k" change="-12.2%" icon="banknotes" color="rose" />
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.total_sales')" :description="__('lnx-ui::design-gallery.last_week')" value="24.67k" change="+24.5%" icon="shopping-bag" color="emerald" />
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.customers')" :description="__('lnx-ui::design-gallery.last_week')" value="8.549k" change="+4.1%" change-style="text" icon="users" color="blue" />
                    <x-lnx-ui::metric-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.revenue')" :description="__('lnx-ui::design-gallery.last_week')" :help="__('lnx-ui::design-gallery.metric_help')" value="24.67k" change="+24.5%" icon="shopping-bag" color="violet" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="metric-card" />
                @endif
            </div>
            <div id="summary-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::summary-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.store_sales')" value="$5,345.43" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '5k'])" change="+5.7%" icon="building-storefront" color="violet" />
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.website_sales')" value="$674,347.12" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '21k'])" change="+12.4%" icon="computer-desktop" color="blue" />
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.discount')" value="$14,235.12" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '6k'])" icon="gift" color="amber" />
                    <x-lnx-ui::summary-card class="col-span-12 md:col-span-6 xl:col-span-3" :label="__('lnx-ui::design-gallery.affiliate')" value="$8,345.23" :caption="__('lnx-ui::design-gallery.orders_count', ['count' => '150'])" change="-3.5%" icon="share" color="emerald" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="summary-card" />
                @endif
            </div>
