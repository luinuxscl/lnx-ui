@php
    $currency = __('lnx-ui::design-gallery.kanban_opportunities_currency');

  $stageColors = [
      'sky' => [
          'column' => 'border-t-2 border-t-sky-500 dark:border-t-sky-500/80',
          'header' => 'bg-sky-500/10 dark:bg-sky-500/15',
          'card' => 'border-s-2 border-s-sky-500 dark:border-s-sky-500/80',
      ],
      'teal' => [
          'column' => 'border-t-2 border-t-teal-500 dark:border-t-teal-500/80',
          'header' => 'bg-teal-500/10 dark:bg-teal-500/15',
          'card' => 'border-s-2 border-s-teal-500 dark:border-s-teal-500/80',
      ],
      'amber' => [
          'column' => 'border-t-2 border-t-amber-500 dark:border-t-amber-500/80',
          'header' => 'bg-amber-500/10 dark:bg-amber-500/15',
          'card' => 'border-s-2 border-s-amber-500 dark:border-s-amber-500/80',
      ],
      'violet' => [
          'column' => 'border-t-2 border-t-violet-500 dark:border-t-violet-500/80',
          'header' => 'bg-violet-500/10 dark:bg-violet-500/15',
          'card' => 'border-s-2 border-s-violet-500 dark:border-s-violet-500/80',
      ],
      'orange' => [
          'column' => 'border-t-2 border-t-orange-500 dark:border-t-orange-500/80',
          'header' => 'bg-orange-500/10 dark:bg-orange-500/15',
          'card' => 'border-s-2 border-s-orange-500 dark:border-s-orange-500/80',
      ],
      'emerald' => [
          'column' => 'border-t-2 border-t-emerald-500 dark:border-t-emerald-500/80',
          'header' => 'bg-emerald-500/10 dark:bg-emerald-500/15',
          'card' => 'border-s-2 border-s-emerald-500 dark:border-s-emerald-500/80',
      ],
  ];

    $stages = [
        ['id' => 's1', 'color' => 'sky', 'name' => __('lnx-ui::design-gallery.kanban_op_stage_1'), 'count' => 2, 'meta' => '12.400.000'],
        ['id' => 's2', 'color' => 'teal', 'name' => __('lnx-ui::design-gallery.kanban_op_stage_2'), 'count' => 1, 'meta' => '8.250.000'],
        ['id' => 's3', 'color' => 'amber', 'name' => __('lnx-ui::design-gallery.kanban_op_stage_3'), 'count' => 2, 'meta' => '18.900.000'],
        ['id' => 's4', 'color' => 'violet', 'name' => __('lnx-ui::design-gallery.kanban_op_stage_4'), 'count' => 0, 'meta' => '—'],
        ['id' => 's5', 'color' => 'emerald', 'name' => __('lnx-ui::design-gallery.kanban_op_stage_5'), 'count' => 1, 'meta' => '3.600.000'],
    ];

    $cardsByStage = [
        's1' => [
            [
                'id' => '101',
                'title' => __('lnx-ui::design-gallery.kanban_op_card_1_title'),
                'amount' => '6.200.000',
                'company' => __('lnx-ui::design-gallery.kanban_op_company_a'),
                'close' => '15/11/2026',
                'overdue' => false,
                'owner' => 'Ana Rivas',
            ],
            [
                'id' => '102',
                'title' => __('lnx-ui::design-gallery.kanban_op_card_2_title'),
                'amount' => '6.200.000',
                'company' => __('lnx-ui::design-gallery.kanban_op_company_b'),
                'close' => '02/11/2026',
                'overdue' => true,
                'owner' => 'Luis Castro',
            ],
        ],
        's2' => [
            [
                'id' => '103',
                'title' => __('lnx-ui::design-gallery.kanban_op_card_3_title'),
                'amount' => '8.250.000',
                'company' => __('lnx-ui::design-gallery.kanban_op_company_c'),
                'close' => null,
                'overdue' => false,
                'owner' => 'María Soto',
            ],
        ],
        's3' => [
            [
                'id' => '104',
                'title' => __('lnx-ui::design-gallery.kanban_op_card_4_title'),
                'amount' => '11.400.000',
                'company' => __('lnx-ui::design-gallery.kanban_op_company_a'),
                'close' => '20/12/2026',
                'overdue' => false,
                'owner' => 'Ana Rivas',
            ],
            [
                'id' => '105',
                'title' => __('lnx-ui::design-gallery.kanban_op_card_5_title'),
                'amount' => '7.500.000',
                'company' => __('lnx-ui::design-gallery.kanban_op_company_d'),
                'close' => '05/01/2027',
                'overdue' => false,
                'owner' => 'Tomás Vera',
            ],
        ],
        's4' => [],
        's5' => [
            [
                'id' => '106',
                'title' => __('lnx-ui::design-gallery.kanban_op_card_6_title'),
                'amount' => '3.600.000',
                'company' => __('lnx-ui::design-gallery.kanban_op_company_b'),
                'close' => null,
                'overdue' => false,
                'owner' => 'Luis Castro',
            ],
        ],
    ];
@endphp

<div id="kanban-opportunities" class="scroll-mt-24 space-y-4">
    <div class="space-y-1">
        <flux:heading level="3">{{ __('lnx-ui::design-gallery.kanban_opportunities_title') }}</flux:heading>
        <flux:text class="text-sm text-zinc-500 dark:text-zinc-400">
            {{ __('lnx-ui::design-gallery.kanban_opportunities_intro') }}
        </flux:text>
    </div>

    <div class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900/40 lg:min-h-[36rem]">
        <div class="flex shrink-0 flex-nowrap items-center gap-3 overflow-x-auto px-0.5 pb-2 pt-1" aria-hidden="true">
            <flux:select class="pointer-events-none min-w-40 max-w-52" size="sm" icon="funnel" disabled>
                <flux:select.option selected>{{ __('lnx-ui::design-gallery.kanban_op_pipeline') }}</flux:select.option>
            </flux:select>

            <flux:button type="button" size="sm" icon="user" variant="ghost" class="pointer-events-none" disabled />

            <flux:select class="pointer-events-none min-w-36 max-w-48" size="sm" icon="users" disabled>
                <flux:select.option selected>{{ __('lnx-ui::design-gallery.kanban_op_filter_all') }}</flux:select.option>
            </flux:select>

            <flux:select class="pointer-events-none min-w-32 max-w-40" size="sm" icon="archive-box" disabled>
                <flux:select.option selected>{{ __('lnx-ui::design-gallery.kanban_op_filter_active') }}</flux:select.option>
            </flux:select>
        </div>

        <div class="flex min-h-0 flex-1 flex-col">
            <x-lnx-ui::kanban class="min-h-0 flex-1 min-h-[28rem]">
                @foreach ($stages as $stage)
                    @php
                        $items = $cardsByStage[$stage['id']] ?? [];
                        $palette = $stageColors[$stage['color']];
                    @endphp
                    <x-lnx-ui::kanban.column
                        :title="$stage['name']"
                        :column-id="$stage['id']"
                        :count="$stage['count']"
                        :meta="$stage['meta']"
                        :meta-title="filled($stage['meta']) && $stage['meta'] !== '—' ? $currency : null"
                        :header-class="$palette['header']"
                        :class="$palette['column']"
                    >
                        @if ($items === [])
                            <p
                                class="pointer-events-none rounded-b-lg rounded-t-none border border-dashed border-zinc-300/80 px-3 py-6 text-center text-xs text-zinc-500 dark:border-zinc-600 dark:text-zinc-400"
                                data-kanban-empty
                            >
                                {{ __('lnx-ui::design-gallery.kanban_op_column_empty') }}
                            </p>
                        @endif
                        @foreach ($items as $card)
                            <x-lnx-ui::kanban.card :card-id="$card['id']" :class="$palette['card']">
                                <span class="line-clamp-2 text-md font-bold font-medium leading-snug text-zinc-900 dark:text-zinc-100">
                                    {{ $card['title'] }}
                                </span>
                                @if (filled($card['amount']))
                                    <p class="mt-1.5 text-m font-semibold tabular-nums text-zinc-900 dark:text-zinc-100" title="{{ $currency }}">
                                        {{ $card['amount'] }}
                                    </p>
                                @endif
                                <div class="mt-2.5 flex items-end justify-between gap-2">
                                    <div class="flex min-w-0 flex-1 flex-wrap items-center gap-x-3 gap-y-1 text-xs text-zinc-500 dark:text-zinc-400">
                                        @if (filled($card['company']))
                                            <span class="flex min-w-0 max-w-[55%] items-center gap-1">
                                                <flux:icon icon="building-office-2" class="size-3.5 shrink-0 text-zinc-400 dark:text-zinc-500" />
                                                <span class="truncate">{{ $card['company'] }}</span>
                                            </span>
                                        @endif
                                        @if (filled($card['close']))
                                            <span @class([
                                                'flex shrink-0 items-center gap-1',
                                                'text-amber-600 dark:text-amber-400' => $card['overdue'],
                                            ])>
                                                <flux:icon
                                                    icon="calendar"
                                                    @class([
                                                        'size-3.5 shrink-0',
                                                        'text-amber-500 dark:text-amber-400' => $card['overdue'],
                                                        'text-zinc-400 dark:text-zinc-500' => ! $card['overdue'],
                                                    ])
                                                />
                                                <span class="tabular-nums">{{ $card['close'] }}</span>
                                            </span>
                                        @endif
                                    </div>
                                    <flux:avatar :name="$card['owner']" size="xs" class="shrink-0" :title="$card['owner']" />
                                </div>
                            </x-lnx-ui::kanban.card>
                        @endforeach
                        <x-slot:footer>
                            <flux:button
                                type="button"
                                variant="ghost"
                                size="sm"
                                icon="plus"
                                class="pointer-events-none w-full justify-start"
                                disabled
                            >
                                {{ __('lnx-ui::design-gallery.kanban_op_add_card') }}
                            </flux:button>
                        </x-slot:footer>
                    </x-lnx-ui::kanban.column>
                @endforeach
            </x-lnx-ui::kanban>
        </div>
    </div>

    @if ($showSnippets ?? false)
        <x-lnx-ui::gallery-snippet name="kanban-opportunities" />
    @endif
</div>

@include('lnx-ui::support.kanban-stage-color-classes')
