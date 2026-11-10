            <div id="auth-header" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::auth-header</code></flux:heading>

                <flux:card>
                    <x-lnx-ui::auth-header :title="__('lnx-ui::design-gallery.login_title')" :description="__('lnx-ui::design-gallery.login_description')" />
                </flux:card>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="auth-header" />
                @endif
            </div>
            <div id="auth-session-status" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::auth-session-status</code></flux:heading>

                <flux:card>
                    <x-lnx-ui::auth-session-status :status="__('lnx-ui::design-gallery.password_reset')" />
                </flux:card>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="auth-session-status" />
                @endif
            </div>
            <div id="placeholder-pattern" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::placeholder-pattern</code></flux:heading>

                <div class="size-32 rounded-lg border border-zinc-200 text-zinc-300 dark:border-zinc-800 dark:text-zinc-700">
                    <x-lnx-ui::placeholder-pattern class="size-full [&_path]:fill-none [&_path]:stroke-current" />
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="placeholder-pattern" />
                @endif
            </div>
