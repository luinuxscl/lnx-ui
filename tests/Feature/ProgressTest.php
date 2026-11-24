<?php

use Illuminate\Support\Facades\Blade;

it('renders the progress bar with label, hint and aria values', function () {
    $html = Blade::render('<x-lnx-ui::progress label="Processing import" value="3" max="8" hint="3 of 8" />');

    expect($html)
        ->toContain('Processing import')
        ->toContain('3 of 8')
        ->toContain('role="progressbar"')
        ->toContain('aria-valuenow="3"')
        ->toContain('aria-valuemax="8"')
        ->toContain('width: 38%')
        ->toContain('bg-accent');
});

it('clamps the percent to the 0-100 range', function () {
    $html = Blade::render('<x-lnx-ui::progress value="250" max="100" />');

    expect($html)->toContain('width: 100%');

    $html = Blade::render('<x-lnx-ui::progress value="-4" max="100" />');

    expect($html)->toContain('width: 0%');
});

it('computes the percent from the given max', function () {
    $html = Blade::render('<x-lnx-ui::progress value="5" max="50" />');

    expect($html)->toContain('width: 10%');
});

it('omits the header when there is no label or hint', function () {
    $html = Blade::render('<x-lnx-ui::progress value="4" max="10" />');

    expect($html)
        ->toContain('role="progressbar"')
        ->not->toContain('text-sm font-medium');
});

it('renders an empty track when the max is zero', function () {
    $html = Blade::render('<x-lnx-ui::progress value="3" max="0" />');

    expect($html)
        ->toContain('role="progressbar"')
        ->toContain('width: 0%');
});
