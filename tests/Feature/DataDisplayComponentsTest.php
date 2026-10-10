<?php

use Illuminate\Support\Facades\Blade;

it('renders the media cell with icon, title and description', function () {
    $html = Blade::render('<x-lnx-ui::media-cell title="Amelia Chen" description="Design lead" icon="user" color="violet" />');

    expect($html)
        ->toContain('Amelia Chen')
        ->toContain('Design lead')
        ->toContain('bg-violet-100')
        ->toContain('<svg');
});

it('renders a media cell image when provided', function () {
    $html = Blade::render('<x-lnx-ui::media-cell title="Noah" image="/storage/avatar.webp" />');

    expect($html)
        ->toContain('<img')
        ->toContain('src="/storage/avatar.webp"')
        ->toContain('alt=""');
});

it('links the media cell only when an href is given', function () {
    $html = Blade::render('<x-lnx-ui::media-cell title="Noah" href="/people/1" />');

    expect($html)
        ->toContain('href="/people/1"')
        ->toContain('wire:navigate');
});

it('renders the chip with icon and label', function () {
    $html = Blade::render('<x-lnx-ui::chip label="Design" icon="swatch" color="violet" />');

    expect($html)
        ->toContain('Design')
        ->toContain('bg-violet-100');
});

it('renders the chip slot as fallback', function () {
    $html = Blade::render('<x-lnx-ui::chip>Engineering</x-lnx-ui::chip>');

    expect($html)->toContain('Engineering');
});

it('renders the summary card with label, value, caption and change', function () {
    $html = Blade::render('<x-lnx-ui::summary-card label="Sales" value="$5,345" caption="5k orders" change="+5.7%" icon="building-storefront" color="violet" />');

    expect($html)
        ->toContain('Sales')
        ->toContain('$5,345')
        ->toContain('5k orders')
        ->toContain('+5.7%')
        ->toContain('bg-emerald-100');
});

it('colors a negative summary change with the rose tone', function () {
    $html = Blade::render('<x-lnx-ui::summary-card label="Affiliate" value="$8k" change="-3.5%" icon="share" />');

    expect($html)->toContain('bg-rose-100');
});

it('omits the summary footer when there is no caption or change', function () {
    $html = Blade::render('<x-lnx-ui::summary-card label="Sales" value="$8k" icon="share" />');

    expect($html)
        ->toContain('$8k')
        ->not->toContain('bg-emerald-100')
        ->not->toContain('bg-rose-100');
});

it('renders the data table with filters, toolbar, actions and rows', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::data-table title="Directory" filters-label="Filter">
            <x-slot:filters><select name="status"></select></x-slot:filters>
            <x-slot:toolbar><input type="search" /></x-slot:toolbar>
            <x-slot:actions><button>Add</button></x-slot:actions>
            <flux:table.columns><flux:table.column>Item</flux:table.column></flux:table.columns>
            <flux:table.rows><flux:table.row><flux:table.cell>Row</flux:table.cell></flux:table.row></flux:table.rows>
        </x-lnx-ui::data-table>
        BLADE);

    expect($html)
        ->toContain('Directory')
        ->toContain('Filter')
        ->toContain('name="status"')
        ->toContain('type="search"')
        ->toContain('Add')
        ->toContain('Item')
        ->toContain('Row')
        ->toContain('data-flux-table')
        ->toContain('w-full');
});

it('omits the optional data table sections when no slots are given', function () {
    $html = Blade::render('<x-lnx-ui::data-table><flux:table.rows><flux:table.row><flux:table.cell>Only</flux:table.cell></flux:table.row></flux:table.rows></x-lnx-ui::data-table>');

    expect($html)
        ->toContain('Only')
        ->toContain('data-flux-table');
});

it('forwards the container class to the table scroll container', function () {
    $html = Blade::render('<x-lnx-ui::data-table container-class="max-h-96 overflow-auto"><flux:table.rows><flux:table.row><flux:table.cell>Only</flux:table.cell></flux:table.row></flux:table.rows></x-lnx-ui::data-table>');

    expect($html)->toContain('max-h-96 overflow-auto');
});
