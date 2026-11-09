(function () {
    function register() {
        if (!window.Alpine || window.Alpine.__lnxKanban) {
            return;
        }

        window.Alpine.__lnxKanban = true;

        window.Alpine.data('lnxKanban', () => ({
            sortables: [],
            pan: null,
            init() {
                this.boot();
                this.bindPan();

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
            isPanTarget(target) {
                const root = this.$root;

                if (!root || !root.contains(target)) {
                    return false;
                }

                if (target.closest('[data-kanban-card]')) {
                    return false;
                }

                if (target.closest('a, button, input, select, textarea, [contenteditable="true"]')) {
                    return false;
                }

                return true;
            },
            bindPan() {
                const root = this.$root;

                if (!root) {
                    return;
                }

                const threshold = 4;

                const resetPan = () => {
                    root.classList.remove('lnx-kanban-grabbing');
                    this.pan = null;
                };

                root.addEventListener('pointerdown', (event) => {
                    if (event.pointerType !== 'mouse' || event.button !== 0) {
                        return;
                    }

                    if (!this.isPanTarget(event.target)) {
                        return;
                    }

                    this.pan = {
                        pointerId: event.pointerId,
                        startX: event.clientX,
                        startY: event.clientY,
                        scrollLeft: root.scrollLeft,
                        mode: null,
                    };

                    if (typeof root.setPointerCapture === 'function') {
                        root.setPointerCapture(event.pointerId);
                    }
                });

                root.addEventListener('pointermove', (event) => {
                    if (!this.pan || event.pointerId !== this.pan.pointerId) {
                        return;
                    }

                    const dx = event.clientX - this.pan.startX;
                    const dy = event.clientY - this.pan.startY;

                    if (this.pan.mode === null) {
                        if (Math.abs(dx) < threshold && Math.abs(dy) < threshold) {
                            return;
                        }

                        if (Math.abs(dy) > Math.abs(dx)) {
                            resetPan();

                            if (typeof root.releasePointerCapture === 'function') {
                                root.releasePointerCapture(event.pointerId);
                            }

                            return;
                        }

                        this.pan.mode = 'pan';
                        root.classList.add('lnx-kanban-grabbing');
                    }

                    if (this.pan.mode === 'pan') {
                        event.preventDefault();
                        root.scrollLeft = this.pan.scrollLeft - dx;
                    }
                });

                const endPan = (event) => {
                    if (!this.pan || event.pointerId !== this.pan.pointerId) {
                        return;
                    }

                    resetPan();

                    if (typeof root.releasePointerCapture === 'function' && root.hasPointerCapture(event.pointerId)) {
                        root.releasePointerCapture(event.pointerId);
                    }
                };

                root.addEventListener('pointerup', endPan);
                root.addEventListener('pointercancel', endPan);
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
