<?php

use Illuminate\Support\Facades\Blade;

it('renders a widget shell with its title, description, link and body', function () {
    $html = Blade::render(
        '<x-lnx-ui::widget title="Contacts" description="All contacts" href="/contacts" href-label="View all"><p>Body</p></x-lnx-ui::widget>'
    );

    expect($html)
        ->toContain('Contacts')
        ->toContain('All contacts')
        ->toContain('href="/contacts"')
        ->toContain('aria-label="View all"')
        ->toContain('Body');
});

it('renders the empty state when the widget has no content', function () {
    $html = Blade::render('<x-lnx-ui::widget title="Contacts" empty="No contacts yet." />');

    expect($html)->toContain('No contacts yet.');
});

it('renders the actions slot next to the title', function () {
    $html = Blade::render(
        '<x-lnx-ui::widget title="Contacts"><x-slot:actions><a href="/new">New</a></x-slot:actions><p>Body</p></x-lnx-ui::widget>'
    );

    expect($html)
        ->toContain('New')
        ->toContain('Body');
});
