<?php

use Illuminate\Support\Facades\Blade;

it('renders the timeline entries with title, description, meta and time', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::timeline :items="[
            ['title' => 'Contact created', 'description' => 'Created by Ana', 'time' => '2 days ago', 'datetime' => '2026-10-23T10:00:00Z', 'meta' => 'owner'],
            ['title' => 'Company updated', 'description' => 'Domain changed', 'time' => '1 hour ago'],
        ]" />
        BLADE);

    expect($html)
        ->toContain('<ol')
        ->toContain('Contact created')
        ->toContain('Created by Ana')
        ->toContain('owner')
        ->toContain('Company updated')
        ->toContain('Domain changed')
        ->toContain('datetime="2026-10-23T10:00:00Z"')
        ->toContain('2 days ago')
        ->toContain('1 hour ago')
        ->and(substr_count($html, '<li'))->toBe(2);
});

it('renders the timeline header and actions slot', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::timeline title="History" description="Everything that happened." :items="[['title' => 'Created']]">
            <x-slot:actions><button>Filter</button></x-slot:actions>
        </x-lnx-ui::timeline>
        BLADE);

    expect($html)
        ->toContain('History')
        ->toContain('Everything that happened.')
        ->toContain('Filter')
        ->toContain('Created');
});

it('renders the empty slot when there are no entries', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::timeline title="History">
            <x-slot:empty>No activity yet.</x-slot:empty>
        </x-lnx-ui::timeline>
        BLADE);

    expect($html)
        ->toContain('No activity yet.')
        ->not->toContain('<ol');
});

it('renders custom content when no entries are given', function () {
    $html = Blade::render('<x-lnx-ui::timeline><p>Custom row</p></x-lnx-ui::timeline>');

    expect($html)
        ->toContain('Custom row')
        ->not->toContain('<ol');
});

it('renders nothing but the card shell when it has no content', function () {
    $html = Blade::render('<x-lnx-ui::timeline />');

    expect($html)
        ->not->toContain('<ol')
        ->not->toContain('<li');
});

it('uses the default icon and tone for entries without explicit values', function () {
    $html = Blade::render('<x-lnx-ui::timeline :items="$items" />', ['items' => [['title' => 'Created']]]);

    expect($html)
        ->toContain('bg-accent/10')
        ->not->toContain('rounded-full bg-violet');
});

it('accepts collections of entries', function () {
    $html = Blade::render(
        '<x-lnx-ui::timeline :items="$items" />',
        ['items' => collect([['title' => 'From collection']])],
    );

    expect($html)->toContain('From collection');
});
