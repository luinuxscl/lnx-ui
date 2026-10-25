<?php

use Illuminate\Support\Facades\Blade;

it('renders the property labels and values in a description list', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::properties-card :items="[
            ['label' => 'Owner', 'value' => 'Ana Ruiz'],
            ['label' => 'Industry', 'value' => 'Software'],
        ]" />
        BLADE);

    expect($html)
        ->toContain('<dl')
        ->toContain('<dt')
        ->toContain('<dd')
        ->toContain('Owner')
        ->toContain('Ana Ruiz')
        ->toContain('Industry')
        ->toContain('Software')
        ->and(substr_count($html, '<dt'))->toBe(2);
});

it('renders an em dash for blank values', function () {
    $html = Blade::render('<x-lnx-ui::properties-card :items="$items" />', ['items' => [['label' => 'Phone', 'value' => null]]]);

    expect($html)
        ->toContain('Phone')
        ->toContain('—');
});

it('links a value when a href is given', function () {
    $html = Blade::render('<x-lnx-ui::properties-card :items="$items" />', ['items' => [['label' => 'Company', 'value' => 'Acme', 'href' => '/companies/1']]]);

    expect($html)
        ->toContain('href="/companies/1"')
        ->toContain('Acme');
});

it('renders the header, actions and extra slot content', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::properties-card title="About" description="Key details." :items="[['label' => 'Owner', 'value' => 'Ana']]">
            <x-slot:actions><button>Edit</button></x-slot:actions>
            <span>Extra row</span>
        </x-lnx-ui::properties-card>
        BLADE);

    expect($html)
        ->toContain('About')
        ->toContain('Key details.')
        ->toContain('Edit')
        ->toContain('Extra row')
        ->toContain('Owner');
});

it('lays out two columns when requested', function () {
    $single = Blade::render('<x-lnx-ui::properties-card :items="$items" />', ['items' => [['label' => 'A', 'value' => 'B']]]);
    $double = Blade::render('<x-lnx-ui::properties-card :columns="2" :items="$items" />', ['items' => [['label' => 'A', 'value' => 'B']]]);

    expect($single)->not->toContain('sm:grid-cols-2');
    expect($double)->toContain('sm:grid-cols-2');
});

it('renders the empty slot when there are no properties', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::properties-card title="About">
            <x-slot:empty>No properties yet.</x-slot:empty>
        </x-lnx-ui::properties-card>
        BLADE);

    expect($html)
        ->toContain('No properties yet.')
        ->not->toContain('<dl');
});

it('skips properties without a label', function () {
    $html = Blade::render('<x-lnx-ui::properties-card :items="$items" />', ['items' => [['value' => 'Orphan'], ['label' => 'Owner', 'value' => 'Ana']]]);

    expect($html)
        ->not->toContain('Orphan')
        ->toContain('Owner')
        ->and(substr_count($html, '<dt'))->toBe(1);
});
