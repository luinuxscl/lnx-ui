            <div id="mail-list-item" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::mail-list-item</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 xl:col-span-6">
                        <flux:card class="divide-y divide-zinc-200 p-0 dark:divide-zinc-700">
                            <x-lnx-ui::mail-list-item
                                sender="Sujika"
                                email="sujika@example.com"
                                :subject="__('lnx-ui::design-gallery.mail_subject_project')"
                                :preview="__('lnx-ui::design-gallery.mail_preview')"
                                time="1:32PM"
                                unread
                                starred
                                href="#"
                            />
                            <x-lnx-ui::mail-list-item
                                sender="Michael Jeremy"
                                email="michaeljeremy2194@gmail.com"
                                :subject="__('lnx-ui::design-gallery.mail_subject_history')"
                                :preview="__('lnx-ui::design-gallery.mail_preview')"
                                time="10:27AM"
                                unread
                                selected
                                href="#"
                            />
                            <x-lnx-ui::mail-list-item
                                sender="King Berunda"
                                :subject="__('lnx-ui::design-gallery.mail_subject_return')"
                                :preview="__('lnx-ui::design-gallery.mail_preview')"
                                time="Yesterday, 10:27AM"
                                :badge="['label' => __('lnx-ui::design-gallery.mail_badge_promotion'), 'color' => 'emerald']"
                                href="#"
                            />
                            <x-lnx-ui::mail-list-item
                                sender="Samantha May"
                                :subject="__('lnx-ui::design-gallery.mail_subject_work')"
                                :preview="__('lnx-ui::design-gallery.mail_preview')"
                                time="24 Oct, 5:45PM"
                                :badge="['label' => __('lnx-ui::design-gallery.mail_badge_social'), 'color' => 'violet']"
                                starred
                                href="#"
                            />
                            <x-lnx-ui::mail-list-item
                                sender="Dawn Bradshaw"
                                :subject="__('lnx-ui::design-gallery.mail_subject_personal')"
                                :preview="__('lnx-ui::design-gallery.mail_preview')"
                                time="11 Sep, 10:32AM"
                                :badge="['label' => __('lnx-ui::design-gallery.mail_badge_personal'), 'color' => 'rose']"
                                href="#"
                            />
                        </flux:card>
                    </div>
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="mail-list-item" />
                @endif
            </div>
            <div id="attachment-card" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::attachment-card</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
                        <x-lnx-ui::attachment-card name="Earth_Archeology_Report.pdf" size="0.85MB" icon="document-text" color="blue" href="#" />
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
                        <x-lnx-ui::attachment-card name="Planets_Image_Archive.zip" size="457KB" icon="photo" color="violet" href="#" />
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
                        <x-lnx-ui::attachment-card name="Project_Brief_Notes.docx" size="120KB" icon="document" color="amber">
                            <x-slot:action>
                                <flux:button size="sm" variant="ghost" icon="x-mark" :aria-label="__('lnx-ui::design-gallery.action_delete')" />
                            </x-slot:action>
                        </x-lnx-ui::attachment-card>
                    </div>
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="attachment-card" />
                @endif
            </div>
            <div id="presence-list" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::presence-list</code></flux:heading>

                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
                        <flux:card>
                            <x-lnx-ui::presence-list
                                :title="__('lnx-ui::design-gallery.mail_online_users')"
                                :users="[
                                    ['name' => 'Angelica', 'line' => __('lnx-ui::design-gallery.mail_line_status_1')],
                                    ['name' => 'Rexha', 'line' => __('lnx-ui::design-gallery.mail_line_status_2')],
                                ]"
                            />
                        </flux:card>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
                        <flux:card>
                            <x-lnx-ui::presence-list
                                :title="__('lnx-ui::design-gallery.mail_team')"
                                :users="[
                                    ['name' => 'Amelia Chen', 'line' => __('lnx-ui::design-gallery.mail_role_design'), 'online' => false],
                                    ['name' => 'Noah Patel', 'line' => __('lnx-ui::design-gallery.mail_role_operations')],
                                    ['name' => 'Sofia Rossi', 'line' => __('lnx-ui::design-gallery.mail_role_support')],
                                ]"
                            />
                        </flux:card>
                    </div>
                </div>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="presence-list" />
                @endif
            </div>
            <div id="mail-viewer" class="scroll-mt-24 space-y-3">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::mail-viewer</code></flux:heading>

                <x-lnx-ui::mail-viewer
                    sender="Michael Jeremy"
                    email="michaeljeremy2194@gmail.com"
                    :subject="__('lnx-ui::design-gallery.mail_subject_history')"
                    date="Oct-22-2022, 03:05PM"
                >
                    <x-slot:actions>
                        <flux:button size="sm" variant="ghost" icon="star" :aria-label="__('lnx-ui::design-gallery.mail_action_star')" />
                        <flux:button size="sm" variant="ghost" icon="folder" :aria-label="__('lnx-ui::design-gallery.mail_action_move')" />
                        <flux:button size="sm" variant="ghost" icon="information-circle" :aria-label="__('lnx-ui::design-gallery.mail_action_info')" />
                        <flux:button size="sm" variant="ghost" icon="trash" :aria-label="__('lnx-ui::design-gallery.mail_action_delete')" />
                        <flux:button size="sm" variant="ghost" icon="arrow-uturn-left" :aria-label="__('lnx-ui::design-gallery.mail_action_reply')" />
                    </x-slot:actions>

                    <x-slot:attachments>
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <flux:heading level="3">{{ __('lnx-ui::design-gallery.mail_attachments', ['size' => '1.8mb']) }}</flux:heading>
                            <flux:button size="sm" variant="filled" icon="arrow-down-tray">{{ __('lnx-ui::design-gallery.mail_download_all') }}</flux:button>
                        </div>

                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-12 sm:col-span-6">
                                <x-lnx-ui::attachment-card name="Earth_Archeology_Report.pdf" size="0.85MB" icon="document-text" color="blue" href="#" />
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <x-lnx-ui::attachment-card name="Planets_Image_Archive.zip" size="457KB" icon="photo" color="violet" href="#" />
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex items-center gap-3 rounded-lg border border-dashed border-zinc-300 p-2.5 dark:border-zinc-600">
                                    <span class="flex size-9 shrink-0 items-center justify-center rounded-md bg-zinc-100 text-zinc-500 dark:bg-white/10 dark:text-zinc-400" aria-hidden="true">
                                        <flux:icon icon="paper-clip" class="size-5" />
                                    </span>
                                    <flux:text class="text-sm">{{ __('lnx-ui::design-gallery.mail_attach_file') }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </x-slot:attachments>

                    <x-slot:reply>
                        <flux:heading level="3">{{ __('lnx-ui::design-gallery.mail_reply_heading') }}</flux:heading>

                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-1">
                                @foreach (['arrow-uturn-left', 'arrow-uturn-right', 'bold', 'underline', 'italic', 'strikethrough', 'list-bullet', 'numbered-list', 'paper-clip', 'photo', 'code-bracket', 'table-cells'] as $tool)
                                    <flux:button size="sm" variant="ghost" :icon="$tool" :aria-label="$tool" />
                                @endforeach
                            </div>

                            <flux:textarea rows="4" :placeholder="__('lnx-ui::design-gallery.mail_reply_placeholder')" />
                        </div>
                    </x-slot:reply>

                    <x-slot:footer>
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div class="flex items-center gap-1">
                                <flux:button size="sm" variant="ghost" icon="paper-clip" :aria-label="__('lnx-ui::design-gallery.mail_attach_file')" />
                                <flux:button size="sm" variant="ghost" icon="photo" :aria-label="__('lnx-ui::design-gallery.mail_attach_file')" />
                                <flux:button size="sm" variant="ghost" icon="arrow-path" :aria-label="__('lnx-ui::design-gallery.mail_reply')" />
                            </div>

                            <div class="flex items-center gap-2">
                                <flux:button size="sm" variant="filled" icon="arrow-uturn-right" color="blue">{{ __('lnx-ui::design-gallery.mail_forward') }}</flux:button>
                                <flux:button size="sm" variant="primary" icon="arrow-uturn-left" color="rose">{{ __('lnx-ui::design-gallery.mail_reply') }}</flux:button>
                            </div>
                        </div>
                    </x-slot:footer>

                    <p>{{ __('lnx-ui::design-gallery.mail_body_greeting') }}</p>
                    <p>{{ __('lnx-ui::design-gallery.mail_body_1') }}</p>
                    <p>{{ __('lnx-ui::design-gallery.mail_body_2') }}</p>
                    <p>
                        {{ __('lnx-ui::design-gallery.mail_regards') }}<br>
                        Michael Jeremy
                    </p>
                </x-lnx-ui::mail-viewer>
                @if ($showSnippets ?? false)
                    <x-lnx-ui::gallery-snippet name="mail-viewer" />
                @endif
            </div>
