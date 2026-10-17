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
        ->toContain('id="summary-card"')
        ->toContain('id="media-cell"')
        ->toContain('id="chip"')
        ->toContain('id="data-table"')
        ->toContain('id="page-header"')
        ->toContain('id="mail-list-item"')
        ->toContain('id="attachment-card"')
        ->toContain('id="presence-list"')
        ->toContain('id="mail-viewer"')
        ->toContain('x-lnx-ui::stat')
        ->toContain('x-lnx-ui::data-table')
        ->toContain('x-lnx-ui::page-header')
        ->toContain('x-lnx-ui::mail-list-item')
        ->toContain('x-lnx-ui::mail-viewer')
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
