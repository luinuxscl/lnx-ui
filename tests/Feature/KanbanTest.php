<?php

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets;
use Livewire\Livewire;

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
        ->toContain('cursor-grab');
});

it('marks locked cards as non draggable while unlocked cards stay draggable', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::kanban>
            <x-lnx-ui::kanban.column title="Cita" column-id="3">
                <x-lnx-ui::kanban.card card-id="9" :locked="true">Tarjeta ajena</x-lnx-ui::kanban.card>
                <x-lnx-ui::kanban.card card-id="10">Tarjeta propia</x-lnx-ui::kanban.card>
            </x-lnx-ui::kanban.column>
        </x-lnx-ui::kanban>
        BLADE);

    $stripped = preg_replace('/\s+/', '', $html);

    expect($stripped)
        ->toContain('data-kanban-card="9"data-kanban-locked="true"')
        ->toContain('cursor-default')
        ->toContain('data-kanban-card="10"')
        ->not->toContain('data-kanban-card="10"data-kanban-locked');
});

it('renders a lone locked card without the grab cursor', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::kanban>
            <x-lnx-ui::kanban.column title="Cita" column-id="3">
                <x-lnx-ui::kanban.card card-id="9" :locked="true">Tarjeta ajena</x-lnx-ui::kanban.card>
            </x-lnx-ui::kanban.column>
        </x-lnx-ui::kanban>
        BLADE);

    $stripped = preg_replace('/\s+/', '', $html);

    // El artículo bloqueado cierra su clase con cursor-default, sin grab/grabbing.
    expect($stripped)
        ->toContain('data-kanban-locked="true"')
        ->toContain('cursor-default">')
        ->not->toContain('cursor-grab">');
});

it('registers kanban assets via the Livewire asset pipeline on a later render', function () {
    // Reproduce el toggle tabla→tablero: el kanban monta en un update posterior
    // (morph). El payload de la respuesta lee getAssets() al deshidratar, antes
    // del flush de estado, así que la captura se hace en ese mismo punto.
    $assetsRendered = '';

    Livewire::listen('dehydrate', function () use (&$assetsRendered) {
        $assetsRendered = collect(SupportScriptsAndAssets::getAssets())->implode("\n");
    });

    $component = new class extends Component
    {
        public bool $board = false;

        public function render(): string
        {
            return <<<'BLADE'
                <div>
                    @if ($board)
                        <x-lnx-ui::kanban>
                            <x-lnx-ui::kanban.column title="Cita" column-id="3" :count="2">
                                <x-lnx-ui::kanban.card card-id="9">Licencia anual</x-lnx-ui::kanban.card>
                            </x-lnx-ui::kanban.column>
                        </x-lnx-ui::kanban>
                    @endif
                </div>
                BLADE;
        }
    };

    Livewire::test($component)
        ->set('board', true)
        ->assertSee('Licencia anual');

    expect($assetsRendered)
        ->toContain('lnxKanban')
        ->toContain('kanban-move')
        ->toContain('scrollSensitivity')
        ->toContain('Sortable')
        ->toContain('lnx-kanban-ghost')
        ->toContain('data-kanban-locked');
});
