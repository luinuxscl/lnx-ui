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

                    {{-- No forced min-width: on narrow screens columns are hidden by breakpoint so the table always fits without horizontal scroll. --}}
                    <flux:table.columns>
                        <flux:table.column class="w-10 max-sm:hidden"><flux:checkbox :aria-label="__('lnx-ui::design-gallery.col_item')" /></flux:table.column>
                        <flux:table.column class="xl:w-72">{{ __('lnx-ui::design-gallery.col_item') }}</flux:table.column>
                        <flux:table.column class="max-sm:hidden">{{ __('lnx-ui::design-gallery.col_category') }}</flux:table.column>
                        <flux:table.column class="max-lg:hidden">{{ __('lnx-ui::design-gallery.col_stock') }}</flux:table.column>
                        <flux:table.column class="max-md:hidden">{{ __('lnx-ui::design-gallery.col_reference') }}</flux:table.column>
                        <flux:table.column class="max-xl:hidden">{{ __('lnx-ui::design-gallery.col_price') }}</flux:table.column>
                        <flux:table.column class="max-xl:hidden">{{ __('lnx-ui::design-gallery.col_quantity') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_status') }}</flux:table.column>
                        <flux:table.column align="end" class="w-20">{{ __('lnx-ui::design-gallery.col_actions') }}</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($people as $person)
                            <flux:table.row :key="$person['name']">
                                <flux:table.cell class="max-sm:hidden"><flux:checkbox :aria-label="$person['name']" /></flux:table.cell>
                                <flux:table.cell>
                                    <x-lnx-ui::media-cell :title="$person['name']" :description="$person['role']" icon="user" :color="$person['category']['color']" />
                                </flux:table.cell>
                                <flux:table.cell class="max-sm:hidden">
                                    <x-lnx-ui::chip :label="$person['category']['label']" :icon="$person['category']['icon']" :color="$person['category']['color']" />
                                </flux:table.cell>
                                <flux:table.cell class="max-lg:hidden"><flux:switch :checked="$person['active']" :aria-label="__('lnx-ui::design-gallery.col_stock')" /></flux:table.cell>
                                <flux:table.cell class="max-md:hidden">{{ $person['reference'] }}</flux:table.cell>
                                <flux:table.cell class="max-xl:hidden">{{ $person['price'] }}</flux:table.cell>
                                <flux:table.cell class="max-xl:hidden">{{ $person['quantity'] }}</flux:table.cell>
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
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="data-table" />
                @endif
            </div>
            <div id="data-table-inline" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::data-table-inline</code></flux:heading>

                <x-lnx-ui::data-table-inline :title="__('lnx-ui::design-gallery.directory_title')">
                    <x-slot:filters>
                        <div class="w-full sm:w-52">
                            <flux:select :aria-label="__('lnx-ui::design-gallery.filter_status')">
                                <flux:select.option value="">{{ __('lnx-ui::design-gallery.filter_all') }}</flux:select.option>
                                <flux:select.option value="active">{{ __('lnx-ui::design-gallery.status_active') }}</flux:select.option>
                                <flux:select.option value="inactive">{{ __('lnx-ui::design-gallery.status_inactive') }}</flux:select.option>
                            </flux:select>
                        </div>
                    </x-slot:filters>

                    <x-slot:filtersActions>
                        <flux:button variant="ghost" icon="x-mark">{{ __('lnx-ui::design-gallery.clear_filters') }}</flux:button>
                        <flux:button icon="arrow-down-tray">{{ __('lnx-ui::design-gallery.export') }}</flux:button>
                    </x-slot:filtersActions>

                    <flux:table.columns>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_item') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_category') }}</flux:table.column>
                        <flux:table.column>{{ __('lnx-ui::design-gallery.col_status') }}</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        <flux:table.row>
                            <flux:table.cell>{{ __('lnx-ui::design-gallery.no_records') }}</flux:table.cell>
                            <flux:table.cell>—</flux:table.cell>
                            <flux:table.cell>—</flux:table.cell>
                        </flux:table.row>
                    </flux:table.rows>
                </x-lnx-ui::data-table-inline>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="data-table-inline" />
                @endif
            </div>
