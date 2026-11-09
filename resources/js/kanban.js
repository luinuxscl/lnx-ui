(function () {
    function register() {
        if (!window.Alpine || window.Alpine.__lnxKanban) {
            return;
        }

        window.Alpine.__lnxKanban = true;

        window.Alpine.data('lnxKanban', () => ({
            sortables: [],
            init() {
                this.boot();

                if (!window.Livewire || typeof window.Livewire.hook !== 'function') {
                    return;
                }

                window.Livewire.hook('morph.updated', ({ el }) => {
                    if (!this.$root || el === undefined) {
                        return;
                    }

                    if (el === this.$root || this.$root.contains(el)) {
                        this.boot();
                    }
                });
            },
            destroy() {
                this.teardown();
            },
            teardown() {
                this.sortables.forEach((sortable) => sortable.destroy());
                this.sortables = [];
            },
            boot() {
                this.teardown();

                if (typeof window.Sortable === 'undefined' || !this.$root) {
                    return;
                }

                this.$root.querySelectorAll('[data-kanban-list]').forEach((list) => {
                    this.sortables.push(window.Sortable.create(list, {
                        group: 'lnx-kanban',
                        animation: 180,
                        easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
                        draggable: '[data-kanban-card]',
                        ghostClass: 'lnx-kanban-ghost',
                        chosenClass: 'lnx-kanban-chosen',
                        dragClass: 'lnx-kanban-drag',
                        forceFallback: true,
                        fallbackOnBody: true,
                        fallbackTolerance: 4,
                        emptyInsertThreshold: 56,
                        delayOnTouchOnly: true,
                        delay: 120,
                        filter: 'button, input, select, textarea',
                        preventOnFilter: false,
                        onEnd: (event) => {
                            const card = event.item;
                            const to = event.to.closest('[data-kanban-column]');
                            const from = event.from.closest('[data-kanban-column]');

                            if (!card || !to) {
                                return;
                            }

                            this.$dispatch('kanban-move', {
                                cardId: card.getAttribute('data-kanban-card'),
                                fromColumnId: from ? from.getAttribute('data-kanban-column') : null,
                                toColumnId: to.getAttribute('data-kanban-column'),
                                index: event.newIndex,
                            });
                        },
                    }));
                });
            },
        }));
    }

    document.addEventListener('alpine:init', register);

    if (window.Alpine) {
        register();
    }
})();
