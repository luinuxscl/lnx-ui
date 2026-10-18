@props([
    'value' => '',
    'label' => null,
    'placeholder' => null,
    'disabled' => false,
])

@php
    $editorId = 'lnx-rich-text-'.str_replace('.', '', uniqid('', true));
    $labelId = filled($label) ? $editorId.'-label' : null;
    $options = [
        'initial' => (string) $value,
        'placeholder' => $placeholder,
        'disabled' => (bool) $disabled,
        'ariaLabel' => filled($labelId) ? null : __('lnx-ui::components.rich_text_editor'),
        'ariaLabelledby' => $labelId,
    ];
@endphp

<div
    x-data="lnxRichText(@js($options))"
    x-modelable="html"
    {{ $attributes->class(['flex w-full flex-col gap-2']) }}
>
    @if (filled($label))
        <label id="{{ $labelId }}" x-on:click="focus()" class="text-sm font-medium text-zinc-800 dark:text-zinc-200">
            {{ $label }}
        </label>
    @endif

    <div class="rounded-lg border border-zinc-200 bg-white shadow-xs transition focus-within:border-accent focus-within:ring-2 focus-within:ring-accent/30 dark:border-zinc-700 dark:bg-zinc-900">
        <div class="flex flex-wrap items-center gap-1 border-b border-zinc-200 px-2 py-1.5 dark:border-zinc-700">
            <div role="toolbar" aria-label="{{ __('lnx-ui::components.rich_text_toolbar') }}" class="flex flex-wrap items-center gap-0.5">
                <button
                    type="button"
                    x-on:click="toggle('toggleBold')"
                    x-bind:aria-pressed="active.bold ? 'true' : 'false'"
                    x-bind:data-active="active.bold ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_bold') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_bold') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="bold" class="size-4" />
                </button>

                <button
                    type="button"
                    x-on:click="toggle('toggleItalic')"
                    x-bind:aria-pressed="active.italic ? 'true' : 'false'"
                    x-bind:data-active="active.italic ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_italic') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_italic') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="italic" class="size-4" />
                </button>

                <span class="mx-1 h-5 w-px bg-zinc-200 dark:bg-zinc-700" aria-hidden="true"></span>

                <button
                    type="button"
                    x-on:click="heading(2)"
                    x-bind:aria-pressed="active.heading2 ? 'true' : 'false'"
                    x-bind:data-active="active.heading2 ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_heading_2') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_heading_2') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <span class="text-xs font-semibold">H2</span>
                </button>

                <button
                    type="button"
                    x-on:click="heading(3)"
                    x-bind:aria-pressed="active.heading3 ? 'true' : 'false'"
                    x-bind:data-active="active.heading3 ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_heading_3') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_heading_3') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <span class="text-xs font-semibold">H3</span>
                </button>

                <span class="mx-1 h-5 w-px bg-zinc-200 dark:bg-zinc-700" aria-hidden="true"></span>

                <button
                    type="button"
                    x-on:click="toggle('toggleBulletList')"
                    x-bind:aria-pressed="active.bulletList ? 'true' : 'false'"
                    x-bind:data-active="active.bulletList ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_bullet_list') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_bullet_list') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="list-bullet" class="size-4" />
                </button>

                <button
                    type="button"
                    x-on:click="toggle('toggleOrderedList')"
                    x-bind:aria-pressed="active.orderedList ? 'true' : 'false'"
                    x-bind:data-active="active.orderedList ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_ordered_list') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_ordered_list') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="numbered-list" class="size-4" />
                </button>

                <button
                    type="button"
                    x-on:click="toggle('toggleBlockquote')"
                    x-bind:aria-pressed="active.blockquote ? 'true' : 'false'"
                    x-bind:data-active="active.blockquote ? 'true' : 'false'"
                    x-bind:disabled="disabled"
                    title="{{ __('lnx-ui::components.rich_text_quote') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_quote') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="chat-bubble-bottom-center-text" class="size-4" />
                </button>

                <div class="relative" x-data="{ open: false, linkUrl: '' }" x-on:keydown.escape="open = false">
                    <button
                        type="button"
                        x-on:click="open = ! open; if (open) linkUrl = currentLink()"
                        x-bind:aria-expanded="open ? 'true' : 'false'"
                        x-bind:aria-pressed="active.link ? 'true' : 'false'"
                        x-bind:data-active="active.link ? 'true' : 'false'"
                        x-bind:disabled="disabled"
                        title="{{ __('lnx-ui::components.rich_text_link') }}"
                        aria-label="{{ __('lnx-ui::components.rich_text_link') }}"
                        class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 data-[active=true]:bg-accent/10 data-[active=true]:text-accent-content dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                    >
                        <flux:icon icon="link" class="size-4" />
                    </button>

                    <div
                        x-show="open"
                        x-cloak
                        x-on:click.outside="open = false"
                        class="absolute left-0 top-full z-20 mt-2 w-72 space-y-2 rounded-lg border border-zinc-200 bg-white p-3 shadow-lg dark:border-zinc-700 dark:bg-zinc-900"
                    >
                        <flux:input
                            x-model="linkUrl"
                            type="url"
                            :label="__('lnx-ui::components.rich_text_link_url')"
                            placeholder="https://"
                            x-on:keydown.enter.prevent="applyLink(linkUrl); open = false"
                        />

                        <div class="flex justify-end gap-2">
                            <flux:button size="sm" variant="ghost" type="button" x-on:click="removeLink(); open = false">
                                {{ __('lnx-ui::components.rich_text_link_remove') }}
                            </flux:button>
                            <flux:button size="sm" variant="primary" type="button" x-on:click="applyLink(linkUrl); open = false">
                                {{ __('lnx-ui::components.rich_text_link_apply') }}
                            </flux:button>
                        </div>
                    </div>
                </div>

                <span class="mx-1 h-5 w-px bg-zinc-200 dark:bg-zinc-700" aria-hidden="true"></span>

                <button
                    type="button"
                    x-on:click="toggle('undo')"
                    x-bind:disabled="disabled || ! canUndo"
                    title="{{ __('lnx-ui::components.rich_text_undo') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_undo') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="arrow-uturn-left" class="size-4" />
                </button>

                <button
                    type="button"
                    x-on:click="toggle('redo')"
                    x-bind:disabled="disabled || ! canRedo"
                    title="{{ __('lnx-ui::components.rich_text_redo') }}"
                    aria-label="{{ __('lnx-ui::components.rich_text_redo') }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-40 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                >
                    <flux:icon icon="arrow-uturn-right" class="size-4" />
                </button>
            </div>

            @isset($actions)
                <div class="ms-auto flex flex-wrap items-center gap-1">
                    {{ $actions }}
                </div>
            @endisset
        </div>

        <div class="relative">
            <div
                x-ref="editor"
                id="{{ $editorId }}"
                wire:ignore
                @if (filled($labelId))
                    aria-labelledby="{{ $labelId }}"
                @else
                    aria-label="{{ __('lnx-ui::components.rich_text_editor') }}"
                @endif
                class="min-h-64 w-full px-4 py-3 text-sm leading-7 text-zinc-900 outline-none [&_a]:text-accent-content [&_a]:underline [&_a]:underline-offset-2 [&_blockquote]:my-3 [&_blockquote]:border-s-4 [&_blockquote]:border-accent/40 [&_blockquote]:ps-4 [&_blockquote]:italic [&_blockquote]:text-zinc-600 [&_em]:italic [&_h2]:mb-2 [&_h2]:mt-5 [&_h2]:text-xl [&_h2]:font-semibold [&_h3]:mb-2 [&_h3]:mt-4 [&_h3]:text-lg [&_h3]:font-semibold [&_li]:mb-1 [&_ol]:mb-3 [&_ol]:list-decimal [&_ol]:ps-6 [&_p]:mb-3 [&_p:last-child]:mb-0 [&_strong]:font-semibold [&_ul]:mb-3 [&_ul]:list-disc [&_ul]:ps-6 dark:text-zinc-100 dark:[&_blockquote]:text-zinc-300"
            ></div>

            @if (filled($placeholder))
                <div
                    x-show="isEmpty"
                    x-cloak
                    class="pointer-events-none absolute inset-x-0 top-0 px-4 py-3 text-sm leading-7 text-zinc-400 dark:text-zinc-500"
                >
                    {{ $placeholder }}
                </div>
            @endif
        </div>
    </div>
</div>
