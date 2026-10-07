<?php

use Illuminate\Support\Facades\Blade;

it('renders the stat component', function () {
    $html = Blade::render('<x-lnx-ui::stat label="Users" value="1,234" icon="users" color="blue" />');

    expect($html)
        ->toContain('Users')
        ->toContain('1,234');
});

it('renders the stat card wrapping the stat component', function () {
    $html = Blade::render('<x-lnx-ui::stat-card label="Users" value="1,234" icon="users" />');

    expect($html)
        ->toContain('Users')
        ->toContain('1,234');
});

it('renders the statistics panel with its title, accessible group and slot', function () {
    $html = Blade::render(
        '<x-lnx-ui::statistics-panel title="Statistics"><p>metric</p></x-lnx-ui::statistics-panel>'
    );

    expect($html)
        ->toContain('Statistics')
        ->toContain('metric')
        ->toContain('role="group"')
        ->toContain('aria-label="Statistics"');
});

it('shows the update metadata only when a label is given', function () {
    $withLabel = Blade::render(
        '<x-lnx-ui::statistics-panel title="Statistics" updated-label="Updated 1 month ago" updated-icon="clock" />'
    );
    $withoutLabel = Blade::render('<x-lnx-ui::statistics-panel title="Statistics" />');

    expect($withLabel)
        ->toContain('Updated 1 month ago')
        ->toContain('aria-label="Updated 1 month ago"')
        ->toContain('cursor-help');

    expect($withoutLabel)->not->toContain('cursor-help');
});

it('renders the header actions slot and the empty state', function () {
    $actions = Blade::render(
        '<x-lnx-ui::statistics-panel title="Statistics"><x-slot:actions><button>Export</button></x-slot:actions><p>metric</p></x-lnx-ui::statistics-panel>'
    );
    $empty = Blade::render(
        '<x-lnx-ui::statistics-panel title="Statistics"><x-slot:empty><p>no data</p></x-slot:empty></x-lnx-ui::statistics-panel>'
    );

    expect($actions)->toContain('Export');
    expect($empty)
        ->toContain('no data')
        ->not->toContain('grid-cols-12');
});

it('renders the tool card and marks external links', function () {
    $internal = Blade::render('<x-lnx-ui::tool-card title="Chat" description="Talk" icon="chat-bubble-left-right" href="/chat" />');
    $external = Blade::render('<x-lnx-ui::tool-card title="Repo" description="Code" icon="users" href="https://example.com" external />');

    expect($internal)
        ->toContain('Chat')
        ->toContain('wire:navigate')
        ->not->toContain('target="_blank"');

    expect($external)
        ->toContain('target="_blank"')
        ->toContain('rel="noopener noreferrer"');
});

it('renders the placeholder pattern', function () {
    $html = Blade::render('<x-lnx-ui::placeholder-pattern id="demo" />');

    expect($html)->toContain('pattern-demo');
});

it('renders the auth header', function () {
    $html = Blade::render('<x-lnx-ui::auth-header title="Log in" description="Welcome back" />');

    expect($html)
        ->toContain('Log in')
        ->toContain('Welcome back');
});

it('renders the auth session status only when a status exists', function () {
    $withStatus = Blade::render('<x-lnx-ui::auth-session-status status="Sent!" />');
    $withoutStatus = Blade::render('<x-lnx-ui::auth-session-status :status="null" />');

    expect($withStatus)->toContain('Sent!');
    expect(trim($withoutStatus))->toBe('');
});
