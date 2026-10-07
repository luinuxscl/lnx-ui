<?php

use Illuminate\Support\Facades\Blade;

it('renders the shared trend card with its props and chart', function () {
    $html = Blade::render(
        '<x-lnx-ui::trend-card label="Sales" value="2.968" change="+3.2%" :series="[10, 20, 30]" color="emerald" />'
    );

    expect($html)
        ->toContain('Sales')
        ->toContain('2.968')
        ->toContain('+3.2%')
        ->toContain('<svg');
});

it('renders without a chart when the series has fewer than two points', function () {
    $html = Blade::render(
        '<x-lnx-ui::trend-card label="Sales" value="2.968" change="+3.2%" :series="[]" />'
    );

    expect($html)->not->toContain('<svg');
});

it('lets the application override the package view', function () {
    $this->app['view']->prependNamespace('lnx-ui', [__DIR__.'/../Fixtures/views']);

    $html = Blade::render(
        '<x-lnx-ui::trend-card label="Sales" value="1" change="0" />'
    );

    expect($html)->toContain('OVERRIDDEN TREND CARD');
});
