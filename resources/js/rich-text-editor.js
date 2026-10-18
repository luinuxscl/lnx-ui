import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import { DOMSerializer } from '@tiptap/pm/model';

/**
 * Registers the Alpine component behind <x-lnx-ui::rich-text-editor>.
 *
 * The Blade component exposes the editor state through `x-modelable="html"`,
 * so it works with `wire:model` in Livewire and with `x-model` in plain
 * Alpine. AI actions are intentionally not implemented here: the consumer
 * renders its own buttons in the `actions` slot and calls `assist(action)`,
 * then answers with `lnx-rich-text:assist-complete`.
 */
function registerLnxRichText() {
    if (! window.Alpine || window.Alpine.__lnxRichTextRegistered) {
        return;
    }

    window.Alpine.__lnxRichTextRegistered = true;

    window.Alpine.data('lnxRichText', (options = {}) => {
        let editor = null;

        return {
        html: options.initial ?? '',
        placeholder: options.placeholder ?? null,
        disabled: Boolean(options.disabled),
        active: {
            bold: false,
            italic: false,
            heading2: false,
            heading3: false,
            bulletList: false,
            orderedList: false,
            blockquote: false,
            link: false,
        },
        canUndo: false,
        canRedo: false,
        isEmpty: true,
        initialized: false,
        pendingSelection: null,
        assistTimer: null,
        cleanups: [],
        wireModelName: null,

        init() {
            const modelAttribute = Array.from(this.$el.attributes).find(
                (attribute) => attribute.name === 'wire:model' || attribute.name.startsWith('wire:model.'),
            );

            this.wireModelName = modelAttribute?.value ?? null;

            editor = new Editor({
                element: this.$refs.editor,
                extensions: [
                    StarterKit.configure({
                        heading: { levels: [2, 3] },
                        code: false,
                        codeBlock: false,
                        horizontalRule: false,
                        trailingNode: false,
                        strike: false,
                        underline: false,
                        link: {
                            openOnClick: false,
                            autolink: true,
                            linkOnPaste: true,
                        },
                    }),
                ],
                content: this.html || '',
                editable: ! this.disabled,
                editorProps: {
                    attributes: {
                        role: 'textbox',
                        'aria-multiline': 'true',
                        ...(options.ariaLabelledby ? { 'aria-labelledby': options.ariaLabelledby } : {}),
                        ...(options.ariaLabel ? { 'aria-label': options.ariaLabel } : {}),
                    },
                },
                onCreate: () => this.refreshState(),
                onUpdate: ({ editor: instance }) => {
                    this.html = instance.getHTML();
                    this.syncModel(this.html);
                    this.refreshState();
                },
                onSelectionUpdate: () => this.refreshState(),
                onTransaction: () => this.refreshState(),
            });

            this.initialized = true;
            editor.view.dom.__lnxRichTextEditor = editor;

            this.refreshState();

            this.$watch('html', (value) => {
                if (! editor) {
                    return;
                }

                const next = value ?? '';

                if (next === editor.getHTML()) {
                    return;
                }

                editor.commands.setContent(next, { emitUpdate: false });
                this.refreshState();
            });

            const wire = this.$wire;

            if (wire && typeof wire.$on === 'function') {
                this.cleanups.push(
                    wire.$on('lnx-rich-text:set-content', (payload) => this.setHtml(this.eventDetail(payload)?.html)),
                );

                this.cleanups.push(
                    wire.$on('lnx-rich-text:assist-complete', (payload) => this.finishAssist(this.eventDetail(payload)?.html)),
                );
            }
        },

        destroy() {
            this.clearAssistTimer();
            this.cleanups.forEach((cleanup) => {
                if (typeof cleanup === 'function') {
                    cleanup();
                }
            });
            this.cleanups = [];
            if (editor?.view?.dom?.__lnxRichTextEditor === editor) {
                editor.view.dom.__lnxRichTextEditor = null;
            }

            editor?.destroy();
            editor = null;
            this.initialized = false;
        },

        /**
         * Push the editor HTML into the bound Livewire property without a
         * request. `x-modelable` covers plain Alpine; Livewire needs the
         * explicit `$set` so the next request carries the current body.
         */
        syncModel(html) {
            const wire = this.$wire;

            if (! this.wireModelName || ! wire || typeof wire.$set !== 'function') {
                return;
            }

            wire.$set(this.wireModelName, html, false);
        },

        /**
         * Livewire wraps dispatched payloads in a CustomEvent; global Alpine
         * listeners receive them directly. Accept both shapes.
         */
        eventDetail(payload) {
            if (payload && typeof payload === 'object' && 'detail' in payload) {
                return payload.detail;
            }

            return payload;
        },

        refreshState() {
            if (! editor) {
                return;
            }

            this.active = {
                bold: editor.isActive('bold'),
                italic: editor.isActive('italic'),
                heading2: editor.isActive('heading', { level: 2 }),
                heading3: editor.isActive('heading', { level: 3 }),
                bulletList: editor.isActive('bulletList'),
                orderedList: editor.isActive('orderedList'),
                blockquote: editor.isActive('blockquote'),
                link: editor.isActive('link'),
            };

            this.canUndo = editor.can().undo();
            this.canRedo = editor.can().redo();
            this.isEmpty = editor.isEmpty;
        },

        focus() {
            editor?.chain().focus().run();
        },

        toggle(command) {
            if (! editor || this.disabled) {
                return;
            }

            editor.chain().focus()[command]().run();
        },

        heading(level) {
            if (! editor || this.disabled) {
                return;
            }

            editor.chain().focus().toggleHeading({ level }).run();
        },

        currentLink() {
            return editor?.getAttributes('link').href ?? '';
        },

        applyLink(url) {
            if (! editor || this.disabled) {
                return;
            }

            const href = String(url ?? '').trim();

            if (href === '') {
                this.removeLink();

                return;
            }

            try {
                editor.chain().focus().extendMarkRange('link').setLink({ href }).run();
            } catch {
                // The Link extension rejects unsafe schemes; the server
                // sanitizer is still the authoritative boundary.
            }
        },

        removeLink() {
            if (! editor || this.disabled) {
                return;
            }

            editor.chain().focus().extendMarkRange('link').unsetLink().run();
        },

        setHtml(html) {
            if (! editor) {
                return;
            }

            const next = html == null ? '' : String(html);

            if (next === editor.getHTML()) {
                return;
            }

            editor.commands.setContent(next, { emitUpdate: true });
            this.refreshState();
        },

        selectionHtml() {
            if (! editor) {
                return '';
            }

            const { from, to } = editor.state.selection;

            if (from === to) {
                return '';
            }

            const slice = editor.state.doc.cut(from, to);
            const fragment = DOMSerializer.fromSchema(editor.schema).serializeFragment(slice.content);
            const container = document.createElement('div');
            container.appendChild(fragment);

            return container.innerHTML;
        },

        /**
         * Hand the current selection to the consumer's AI action. The
         * consumer answers with `lnx-rich-text:assist-complete` and the
         * selection is replaced with the sanitized HTML.
         */
        assist(action) {
            if (! editor || this.disabled) {
                return;
            }

            const wire = this.$wire;

            if (! wire || typeof wire.$dispatch !== 'function') {
                return;
            }

            const { from, to } = editor.state.selection;

            if (from === to) {
                return;
            }

            const html = this.selectionHtml();

            if (html.trim() === '') {
                return;
            }

            this.pendingSelection = { from, to };
            editor.setEditable(false);
            this.clearAssistTimer();
            this.assistTimer = window.setTimeout(() => this.finishAssist(null), 60000);

            wire.$dispatch('lnx-rich-text:assist', { action, html });
        },

        finishAssist(html) {
            this.clearAssistTimer();

            if (! editor) {
                return;
            }

            const pending = this.pendingSelection;
            this.pendingSelection = null;

            if (pending && typeof html === 'string' && html !== '') {
                const documentSize = editor.state.doc.content.size;

                if (pending.from <= pending.to && pending.to <= documentSize) {
                    editor.chain()
                        .focus()
                        .setTextSelection({ from: pending.from, to: pending.to })
                        .deleteSelection()
                        .insertContent(html)
                        .run();
                } else {
                    editor.chain().focus().insertContent(html).run();
                }
            }

            editor.setEditable(! this.disabled);
            this.refreshState();
        },

        clearAssistTimer() {
            if (this.assistTimer !== null) {
                window.clearTimeout(this.assistTimer);
                this.assistTimer = null;
            }
        },
        };
    });
}

function initPendingEditors() {
    if (! window.Alpine) {
        return;
    }

    document.querySelectorAll('[x-data^="lnxRichText("]').forEach((element) => {
        if (element.querySelector('.ProseMirror')?.__lnxRichTextEditor) {
            return;
        }

        // Rebuild only the editor root: this processes wire:ignore and
        // wire:model again now that lnxRichText exists.
        window.Alpine.destroyTree(element);
        window.Alpine.initTree(element);
    });
}

function scheduleInit() {
    window.setTimeout(initPendingEditors, 0);
    window.requestAnimationFrame(initPendingEditors);
}

document.addEventListener('DOMContentLoaded', scheduleInit);
window.addEventListener('load', scheduleInit);
document.addEventListener('livewire:navigated', scheduleInit);

if (window.Livewire?.hook) {
    window.Livewire.hook('morph.added', scheduleInit);
    window.Livewire.hook('morph.updated', scheduleInit);
}

if (window.Alpine) {
    registerLnxRichText();
    scheduleInit();
} else {
    document.addEventListener('alpine:init', () => {
        registerLnxRichText();
        initPendingEditors();
    }, { once: true });
}
