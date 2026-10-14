<?php

use Illuminate\Support\Facades\Blade;

it('renders the chart card with its props and a line chart', function () {
    $html = Blade::render(
        '<x-lnx-ui::chart-card label="Sales" description="Last Year" value="175k" change="-16.2%" :series="[10, 20, 30]" color="emerald" />'
    );

    expect($html)
        ->toContain('Sales')
        ->toContain('Last Year')
        ->toContain('175k')
        ->toContain('-16.2%')
        ->toContain('<svg');
});

it('renders a bar chart with the given labels and without a line', function () {
    $html = Blade::render(
        '<x-lnx-ui::chart-card label="Revenue Growth" value="$4,673" change="+15.2%" :series="[30, 45, 25]" chart="bar" :labels="[\'Mo\', \'Tu\', \'We\']" />'
    );

    expect($html)
        ->toContain('flex-1 rounded-full')
        ->toContain('Mo')
        ->toContain('We')
        ->not->toContain('<svg');
});

it('omits the line chart when the series has fewer than two points', function () {
    $empty = Blade::render('<x-lnx-ui::chart-card label="Sales" value="1" :series="[]" />');
    $single = Blade::render('<x-lnx-ui::chart-card label="Sales" value="1" :series="[5]" />');

    expect($empty)->not->toContain('<svg');
    expect($single)->not->toContain('<svg');
});

it('colors the change by its direction', function () {
    $up = Blade::render('<x-lnx-ui::chart-card label="Order" value="124k" change="+12.6%" />');
    $down = Blade::render('<x-lnx-ui::chart-card label="Sales" value="175k" change="-16.2%" />');

    expect($up)->toContain('text-emerald-600');
    expect($down)->toContain('text-rose-600');
});

it('renders the change as a badge when requested', function () {
    $html = Blade::render('<x-lnx-ui::chart-card label="Order" value="124k" change="+12.6%" change-style="badge" />');

    expect($html)->toContain('bg-emerald-100');
});

it('omits the change when none is given', function () {
    $html = Blade::render('<x-lnx-ui::chart-card label="Order" value="124k" />');

    expect($html)
        ->toContain('124k')
        ->not->toContain('text-emerald-600')
        ->not->toContain('text-rose-600');
});

it('renders inline help and wires it for assistive technology', function () {
    $html = Blade::render('<x-lnx-ui::chart-card label="Sales" value="175k" :series="[10, 20, 30]" help="Includes pending records." />');

    preg_match('/aria-labelledby="([^"]+)"/', $html, $label);
    preg_match('/aria-describedby="([^"]+)"/', $html, $help);

    expect($html)
        ->toContain('role="group"')
        ->toContain('Includes pending records.');

    expect($label[1] ?? null)->not->toBeNull();
    expect($help[1] ?? null)->not->toBeNull();
    expect($html)->toContain('id="'.$label[1].'"');
    expect($html)->toContain('id="'.$help[1].'"');
});

it('omits the help markup when no help is given', function () {
    $html = Blade::render('<x-lnx-ui::chart-card label="Sales" value="175k" :series="[10, 20, 30]" />');

    expect($html)
        ->not->toContain('role="group"')
        ->not->toContain('aria-describedby')
        ->not->toContain('id="lnx-');
});
