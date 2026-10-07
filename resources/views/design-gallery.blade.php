<section class="flex w-full flex-col gap-8">
        <div>
            <flux:heading level="1">{{ __('lnx-ui::design-gallery.title') }}</flux:heading>
            <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.intro') }}</flux:text>
        </div>

        {{-- Component index: each entry links to its stable anchor (#name). --}}
        <nav aria-label="{{ __('lnx-ui::design-gallery.index') }}" class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
            <flux:heading level="2" size="sm">{{ __('lnx-ui::design-gallery.index') }}</flux:heading>
            <ul class="mt-3 grid grid-cols-2 gap-x-4 gap-y-1 font-mono text-sm sm:grid-cols-3 lg:grid-cols-4">
                @foreach (['stat', 'stat-card', 'statistics-panel', 'trend-card', 'tool-card', 'placeholder-pattern', 'auth-header', 'auth-session-status', 'loading', 'empty-state', 'error-state', 'validation', 'actions-statuses', 'messaging'] as $anchor)
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

            {{-- tool-card --}}
            <div id="tool-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::tool-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.chat')" :description="__('lnx-ui::design-gallery.chat_description')" icon="chat-bubble-left-right" color="violet" href="#" />
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.users')" :description="__('lnx-ui::design-gallery.users_description')" icon="users" color="blue" href="#" />
                    <x-lnx-ui::tool-card class="col-span-12 sm:col-span-6 xl:col-span-4" :title="__('lnx-ui::design-gallery.repository')" :description="__('lnx-ui::design-gallery.repository_description')" icon="code-bracket" external href="https://github.com/luinuxscl/lnx" />
                </div>
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
