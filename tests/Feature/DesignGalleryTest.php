<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\ViewErrorBag;

beforeEach(function () {
    view()->share('errors', new ViewErrorBag);
});

it('renders the shared design gallery with component anchors', function () {
    App::setLocale('en');

    $html = view('lnx-ui::design-gallery')->render();

    expect($html)
        ->toContain('id="stat"')
        ->toContain('id="trend-card"')
        ->toContain('x-lnx-ui::stat')
        ->toContain('Shared library (lnx-ui)')
        ->toContain('Design gallery');
});

it('translates the shared design gallery', function () {
    App::setLocale('es');

    $html = view('lnx-ui::design-gallery')->render();

    expect($html)
        ->toContain('Biblioteca compartida (lnx-ui)')
        ->toContain('Galería de diseño');
});
