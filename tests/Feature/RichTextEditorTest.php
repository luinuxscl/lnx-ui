<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ViewErrorBag;

beforeEach(function () {
    view()->share('errors', new ViewErrorBag);
});

it('renders the rich text editor with an accessible toolbar and forwarded attributes', function () {
    App::setLocale('en');

    $html = Blade::render(
        '<x-lnx-ui::rich-text-editor wire:model="body" label="Body" placeholder="Start writing" />'
    );

    expect($html)
        ->toContain('wire:model="body"')
        ->toContain('x-modelable="html"')
        ->toContain('x-data="lnxRichText(')
        ->toContain('Body')
        ->toContain('Start writing')
        ->toContain('role="toolbar"')
        ->toContain('aria-label="Formatting"')
        ->toContain('aria-label="Bold"')
        ->toContain('aria-label="Italic"')
        ->toContain('aria-label="Heading 2"')
        ->toContain('aria-label="Heading 3"')
        ->toContain('aria-label="Bulleted list"')
        ->toContain('aria-label="Numbered list"')
        ->toContain('aria-label="Quote"')
        ->toContain('aria-label="Link"')
        ->toContain('aria-label="Undo"')
        ->toContain('aria-label="Redo"')
        ->toContain('wire:ignore');
});

it('renders the actions slot inside the editor scope', function () {
    App::setLocale('en');

    $html = Blade::render(
        '<x-lnx-ui::rich-text-editor><x-slot:actions><button type="button" x-on:click="assist(\'improve\')">Improve</button></x-slot:actions></x-lnx-ui::rich-text-editor>'
    );

    expect($html)
        ->toContain('Improve')
        ->toContain("assist('improve')");
});

it('falls back to an accessible editor label when no visible label is given', function () {
    App::setLocale('en');

    $html = Blade::render('<x-lnx-ui::rich-text-editor />');

    expect($html)->toContain('aria-label="Rich text editor"');
});

it('translates the editor toolbar', function () {
    App::setLocale('es');

    $html = Blade::render('<x-lnx-ui::rich-text-editor />');

    expect($html)
        ->toContain('Formato')
        ->toContain('Negrita')
        ->toContain('Cursiva');
});
