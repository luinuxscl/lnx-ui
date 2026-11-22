<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ViewErrorBag;

beforeEach(function () {
    view()->share('errors', new ViewErrorBag);
});

it('renders the filter chip with its trigger and options', function () {
    $html = Blade::render(
        '<x-lnx-ui::filter-chip name="status" icon="funnel" label="Status" :options="[\'active\' => \'Active\', \'inactive\' => \'Inactive\']" any-label="All" />'
    );

    expect($html)
        ->toContain('aria-label="Status"')
        ->toContain('All')
        ->toContain('Active')
        ->toContain('Inactive')
        ->toContain('wire:model.live="status"');
});

it('marks an active filter chip with the accent dot', function () {
    $active = Blade::render(
        '<x-lnx-ui::filter-chip name="status" icon="funnel" label="Status" :options="[\'active\' => \'Active\']" active />'
    );
    $inactive = Blade::render(
        '<x-lnx-ui::filter-chip name="status" icon="funnel" label="Status" :options="[\'active\' => \'Active\']" />'
    );

    expect($active)->toContain('bg-accent');
    expect($inactive)->not->toContain('bg-accent');
});

it('omits the empty option when anyLabel is null', function () {
    $html = Blade::render(
        '<x-lnx-ui::filter-chip name="pipeline" icon="funnel" label="Pipeline" :options="[\'a\' => \'Alpha\']" />'
    );

    expect($html)->not->toContain('<option value="">');
});

it('renders the filter bar row', function () {
    $html = Blade::render(
        '<x-lnx-ui::filter-bar><div>controls</div></x-lnx-ui::filter-bar>'
    );

    expect($html)
        ->toContain('flex flex-wrap items-center gap-2')
        ->toContain('controls');
});

it('renders the collapsible filter bar toggle', function () {
    $html = Blade::render(
        '<x-lnx-ui::filter-bar collapsible toggle-label="Filters" :active-count="2"><div>controls</div></x-lnx-ui::filter-bar>'
    );

    expect($html)
        ->toContain('Filters')
        ->toContain('· 2')
        ->toContain('max-sm:hidden');
});

it('renders the filter control width wrapper', function () {
    $html = Blade::render(
        '<x-lnx-ui::filter-control width="w-64"><input type="text" /></x-lnx-ui::filter-control>'
    );

    expect($html)
        ->toContain('w-64')
        ->toContain('max-w-64')
        ->toContain('<input type="text" />');
});

it('renders the per page selector bound to the perPage property', function () {
    $html = Blade::render(
        '<x-lnx-ui::table-per-page :options="[10, 25, 50]" aria-label="Per page" />'
    );

    expect($html)
        ->toContain('wire:model.live="perPage"')
        ->toContain('aria-label="Per page"')
        ->toContain('value="10"')
        ->toContain('value="50"');
});
