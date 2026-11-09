<?php

use Illuminate\Support\Facades\Blade;

it('renders kanban columns and cards with a drag hook', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::kanban>
            <x-lnx-ui::kanban.column title="Cita" column-id="3" :count="2" meta="1.200.000 CLP">
                <x-lnx-ui::kanban.card card-id="9">Licencia anual</x-lnx-ui::kanban.card>
                <x-slot:footer>
                    <button type="button">Añadir una tarjeta</button>
                </x-slot:footer>
            </x-lnx-ui::kanban.column>
        </x-lnx-ui::kanban>
        BLADE);

    expect($html)
        ->toContain('x-data="lnxKanban()"')
        ->toContain('data-kanban-column="3"')
        ->toContain('data-kanban-card="9"')
        ->toContain('data-kanban-list')
        ->toContain('Cita')
        ->toContain('Licencia anual')
        ->toContain('Añadir una tarjeta')
        ->toContain('Sortable')
        ->toContain('kanban-move')
        ->toContain('bindPan')
        ->toContain('cursor-grab')
        ->toContain('scrollSensitivity')
        ->toContain('lnx-kanban-ghost');
});
