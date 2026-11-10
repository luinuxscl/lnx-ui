        <section class="space-y-4" aria-label="{{ __('lnx-ui::design-gallery.states_title') }}">
            <flux:heading level="2">{{ __('lnx-ui::design-gallery.states_title') }}</flux:heading>

            <div class="grid gap-6 lg:grid-cols-2">
                <flux:card id="loading" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.loading') }}</flux:heading>
                    <flux:skeleton class="h-5 w-2/3" />
                    <flux:skeleton class="h-5 w-full" />
                    <flux:skeleton class="h-9 w-28" />
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="loading" />
                @endif
                </flux:card>
                <flux:card id="empty-state" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.empty_state') }}</flux:heading>
                    <flux:text>{{ __('lnx-ui::design-gallery.no_invitations') }}</flux:text>
                    <flux:button href="#" wire:navigate>{{ __('lnx-ui::design-gallery.invite_user') }}</flux:button>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="empty-state" />
                @endif
                </flux:card>
                <flux:card id="error-state" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.error_state') }}</flux:heading>
                    <flux:callout variant="danger" icon="x-circle">
                        <flux:callout.heading>{{ __('lnx-ui::design-gallery.invitation_failed') }}</flux:callout.heading>
                        <flux:callout.text>{{ __('lnx-ui::design-gallery.try_again') }}</flux:callout.text>
                    </flux:callout>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="error-state" />
                @endif
                </flux:card>
                <flux:card id="validation" class="scroll-mt-24 space-y-4">
                    <flux:heading level="3">{{ __('lnx-ui::design-gallery.validation') }}</flux:heading>
                    <flux:field>
                        <flux:label>{{ __('lnx-ui::design-gallery.email') }}</flux:label>
                        <flux:input type="email" value="invalid-email" aria-invalid="true" />
                        <flux:error name="email" :message="__('lnx-ui::design-gallery.invalid_email')" />
                    </flux:field>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="validation" />
                @endif
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
