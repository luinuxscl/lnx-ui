        <section id="sam" class="scroll-mt-24 space-y-4" aria-label="{{ __('lnx-ui::design-gallery.sam') }}">
            <div>
                <flux:heading level="2">{{ __('lnx-ui::design-gallery.sam') }}</flux:heading>
                <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.sam_intro') }}</flux:text>
            </div>

            <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-panel</code></flux:heading>

            <x-lnx-ui::sam-panel preview title="Sam" subtitle="Agente de plataforma" open="true" close="true">
                <x-slot:actions>
                    <flux:button variant="ghost" size="sm" square icon="adjustments-horizontal" :aria-label="__('lnx-ui::design-gallery.sam_sample_preferences')" />
                    <flux:button variant="ghost" size="sm" square icon="plus" :aria-label="__('lnx-ui::design-gallery.sam_sample_new')" />
                </x-slot:actions>

                <x-slot:context>
                    <x-lnx-ui::sam-context-chip :label="__('lnx-ui::design-gallery.sam_sample_context')" source="crm" />
                </x-slot:context>

                <div class="space-y-3">
                    <x-lnx-ui::sam-message role="user" :time="now()->subMinutes(3)">
                        {{ __('lnx-ui::design-gallery.sam_sample_user') }}
                    </x-lnx-ui::sam-message>

                    <x-lnx-ui::sam-message copy :time="now()->subMinutes(2)">
                        {{ __('lnx-ui::design-gallery.sam_sample_assistant') }}
                    </x-lnx-ui::sam-message>

                    <div class="flex justify-start" data-sam-streaming-sample>
                        <div class="max-w-[85%] rounded-2xl rounded-tl-xs bg-zinc-100 px-3 py-2 text-sm whitespace-pre-line text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100">
                            {{ __('lnx-ui::design-gallery.sam_sample_streaming') }}
                        </div>
                    </div>

                    <x-lnx-ui::sam-typing />

                    <x-lnx-ui::sam-proposal-card
                        source="crm"
                        id="demo-1"
                        :title="__('lnx-ui::design-gallery.sam_sample_proposal_title')"
                        :summary="__('lnx-ui::design-gallery.sam_sample_proposal_summary')"
                        :changes="[[
                            'field' => 'phone',
                            'label' => __('lnx-ui::design-gallery.sam_sample_field'),
                            'old' => '+56 9 1111',
                            'new' => '+56 9 2222',
                        ]]"
                        status="pending"
                        risk="reversible"
                        :requires-phrase="false"
                        :expires-at="now()->addMinutes(30)"
                        record-url="#"
                        :can-confirm="true"
                    />
                </div>

                <x-slot:footer>
                    <div class="space-y-2">
                        <x-lnx-ui::sam-suggestions :items="[
                            __('lnx-ui::design-gallery.sam_sample_suggestion_1'),
                            __('lnx-ui::design-gallery.sam_sample_suggestion_2'),
                        ]" />

                        <flux:textarea rows="2" :placeholder="__('lnx-ui::components.sam_proposal_phrase_placeholder')" />
                    </div>
                </x-slot:footer>
            </x-lnx-ui::sam-panel>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 space-y-3 rounded-xl border border-zinc-200 p-4 lg:col-span-6 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-trigger</code></flux:heading>
                    <x-lnx-ui::sam-trigger />

                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-notice</code></flux:heading>
                    <x-lnx-ui::sam-notice variant="warning">
                        {{ __('lnx-ui::design-gallery.sam_sample_notice') }}
                    </x-lnx-ui::sam-notice>
                </div>

                <div class="col-span-12 rounded-xl border border-zinc-200 p-4 lg:col-span-6 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-empty-state</code></flux:heading>

                    <x-lnx-ui::sam-empty-state class="mt-3 rounded-xl border border-dashed border-zinc-300 p-4 dark:border-zinc-700">
                        <x-lnx-ui::sam-suggestions :items="[
                            __('lnx-ui::design-gallery.sam_sample_suggestion_1'),
                            __('lnx-ui::design-gallery.sam_sample_suggestion_2'),
                        ]" />
                    </x-lnx-ui::sam-empty-state>
                </div>
            </div>

            <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-proposal-card (caducada)</code></flux:heading>

                <x-lnx-ui::sam-proposal-card
                    class="mt-3"
                    source="crm"
                    id="demo-2"
                    :title="__('lnx-ui::design-gallery.sam_sample_proposal_title')"
                    :summary="__('lnx-ui::design-gallery.sam_sample_proposal_summary')"
                    :changes="[[
                        'field' => 'phone',
                        'label' => __('lnx-ui::design-gallery.sam_sample_field'),
                        'old' => '+56 9 1111',
                        'new' => '+56 9 2222',
                    ]]"
                    status="pending"
                    :expires-at="now()->subMinute()"
                    :can-confirm="true"
                />
            </div>

            <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-proposal-card (confirmada con undo)</code></flux:heading>

                <x-lnx-ui::sam-proposal-card
                    class="mt-3"
                    source="crm"
                    id="demo-3"
                    :title="__('lnx-ui::design-gallery.sam_sample_proposal_title')"
                    :summary="__('lnx-ui::design-gallery.sam_sample_proposal_summary')"
                    :changes="[[
                        'field' => 'phone',
                        'label' => __('lnx-ui::design-gallery.sam_sample_field'),
                        'old' => '+56 9 1111',
                        'new' => '+56 9 2222',
                    ]]"
                    status="confirmed"
                    risk="reversible"
                    :can-undo="true"
                    :undo-expires-at="now()->addMinutes(30)"
                    record-url="#"
                />
            </div>

            @php
                $samSample = __('lnx-ui::design-gallery.sam_sample_brief');
                $samSample['actions'] = array_map(fn (array $action): object => (object) $action, $samSample['actions']);
                $samSampleBrief = (object) $samSample;
                $samSampleInsight = (object) array_merge($samSample, ['deepenUrl' => '#']);
                $samSampleTrace = (object) [
                    'activityUrl' => '#',
                    'entries' => [
                        (object) ['tool' => 'crm_search_crm', 'label' => 'Ada Lovelace', 'kind' => 'read', 'status' => 'read', 'resource' => 'contact', 'count' => 3, 'url' => '#'],
                        (object) ['tool' => 'crm_get_contact', 'label' => 'Ada Lovelace', 'kind' => 'read', 'status' => 'read', 'resource' => 'contact', 'count' => 1, 'url' => '#'],
                        (object) ['tool' => 'sam_confirm', 'label' => 'Acme', 'kind' => 'denied', 'status' => 'denied', 'resource' => 'company', 'count' => null, 'url' => null],
                    ],
                ];
            @endphp

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 rounded-xl border border-zinc-200 p-4 lg:col-span-6 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-brief</code></flux:heading>

                    <x-lnx-ui::sam-brief :brief="$samSampleBrief" class="mt-3" />
                </div>

                <div class="col-span-12 rounded-xl border border-zinc-200 p-4 lg:col-span-6 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-insight</code></flux:heading>

                    <x-lnx-ui::sam-insight :insight="$samSampleInsight" class="mt-3" />
                </div>

                <div class="col-span-12 rounded-xl border border-zinc-200 p-4 lg:col-span-6 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-trace</code></flux:heading>

                    <x-lnx-ui::sam-trace :trace="$samSampleTrace" class="mt-3" />
                </div>

                <div class="col-span-12 rounded-xl border border-zinc-200 p-4 lg:col-span-6 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">x-lnx-ui::sam-signals</code></flux:heading>

                    <x-lnx-ui::sam-signals
                        class="mt-3"
                        :observations="$samSampleBrief->observations"
                        :actions="$samSampleBrief->actions"
                        :observation-limit="2"
                    />
                </div>

                <div class="col-span-12 rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                    <flux:heading level="3"><code class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-sm dark:bg-zinc-800">wire:stream (streaming)</code></flux:heading>

                    <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.sam_sample_streaming_hint') }}</flux:text>
                </div>
            </div>
        </section>
