<?php

use Illuminate\Support\Facades\Blade;

it('renders the metric card with its icon, text and change badge', function () {
    $html = Blade::render(
        '<x-lnx-ui::metric-card label="Total Sales" description="Last week" value="24.67k" change="+24.5%" icon="shopping-bag" color="emerald" />'
    );

    expect($html)
        ->toContain('Total Sales')
        ->toContain('Last week')
        ->toContain('24.67k')
        ->toContain('+24.5%')
        ->toContain('bg-emerald-100')
        ->toContain('<svg');
});

it('colors a decrease with the rose tone', function () {
    $html = Blade::render('<x-lnx-ui::metric-card label="Total Profit" value="1.28k" change="-12.2%" icon="banknotes" />');

    expect($html)->toContain('bg-rose-100');
});

it('lets an explicit trend override the change sign', function () {
    $html = Blade::render('<x-lnx-ui::metric-card label="Total Profit" value="1.28k" change="+1%" trend="down" icon="banknotes" />');

    expect($html)->toContain('bg-rose-100');
});

it('renders the change as text when requested', function () {
    $html = Blade::render('<x-lnx-ui::metric-card label="Customers" value="8.549k" change="+4.1%" change-style="text" icon="users" />');

    expect($html)
        ->toContain('text-emerald-600')
        ->not->toContain('bg-emerald-100');
});

it('omits the change when none is given', function () {
    $html = Blade::render('<x-lnx-ui::metric-card label="Total Sales" value="24.67k" icon="shopping-bag" />');

    expect($html)
        ->toContain('24.67k')
        ->not->toContain('bg-emerald-100')
        ->not->toContain('bg-rose-100');
});

it('renders inline help and wires it for assistive technology', function () {
    $html = Blade::render('<x-lnx-ui::metric-card label="Total Sales" value="24.67k" icon="shopping-bag" help="Compared with last week." />');

    preg_match('/aria-labelledby="([^"]+)"/', $html, $label);
    preg_match('/aria-describedby="([^"]+)"/', $html, $help);

    expect($html)
        ->toContain('role="group"')
        ->toContain('Compared with last week.');

    expect($label[1] ?? null)->not->toBeNull();
    expect($help[1] ?? null)->not->toBeNull();
    expect($html)->toContain('id="'.$label[1].'"');
    expect($html)->toContain('id="'.$help[1].'"');
});

it('omits the help markup when no help is given', function () {
    $html = Blade::render('<x-lnx-ui::metric-card label="Total Sales" value="24.67k" icon="shopping-bag" />');

    expect($html)
        ->not->toContain('role="group"')
        ->not->toContain('aria-describedby')
        ->not->toContain('id="lnx-');
});
