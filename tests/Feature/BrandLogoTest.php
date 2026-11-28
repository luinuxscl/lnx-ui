<?php

use Illuminate\Support\Facades\Blade;

it('renders a vendorized brand logo through the wrapper', function () {
    $html = Blade::render('<x-lnx-ui::brand-logo name="google-calendar" class="size-6" />');

    expect($html)
        ->toContain('<svg')
        ->toContain('viewBox="0 0 192 192"')
        ->toContain('class="size-6"')
        ->toContain('aria-hidden="true"')
        ->not->toContain('width="192"');
});

it('renders brand logos directly by namespaced slug', function () {
    $html = Blade::render('<x-lnx-ui::brand-logos.google-meet class="size-8" />');

    expect($html)
        ->toContain('<svg')
        ->toContain('class="size-8"')
        ->toContain('aria-hidden="true"')
        ->not->toContain('width="192"');
});

it('keeps the multicolor fills of the brand', function () {
    $html = Blade::render('<x-lnx-ui::brand-logo name="google-meet" />');

    expect($html)->toContain('stop-color="#ffe921"');
});

it('merges extra attributes into the svg root', function () {
    $html = Blade::render('<x-lnx-ui::brand-logo name="google-calendar" title="Google Calendar" />');

    expect($html)->toContain('title="Google Calendar"');
});

it('renders the gmail logo through the wrapper', function () {
    $html = Blade::render('<x-lnx-ui::brand-logo name="gmail" class="size-4" />');

    expect($html)
        ->toContain('<svg')
        ->toContain('viewBox="0 0 192 192"')
        ->toContain('class="size-4"')
        ->toContain('aria-hidden="true"')
        ->toContain('url(#gmail-a)')
        ->not->toContain('width="192"');
});

it('keeps the multicolor fills of gmail', function () {
    $html = Blade::render('<x-lnx-ui::brand-logos.gmail />');

    expect($html)->toContain('fill="#fc413d"');
});
