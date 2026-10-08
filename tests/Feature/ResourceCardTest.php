<?php

use Illuminate\Support\Facades\Blade;

it('renders the resource card title and description', function () {
    $html = Blade::render('<x-lnx-ui::resource-card title="cudaq-guide" description="Set up CUDA-Q." />');

    expect($html)
        ->toContain('cudaq-guide')
        ->toContain('Set up CUDA-Q.');
});

it('renders the optional header and footer content', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::resource-card title="Title" icon="cpu-chip" eyebrow="DGX Spark">
            <x-slot:badges><span>Advanced</span></x-slot:badges>
            <x-slot:tags><span>developer</span></x-slot:tags>
            <x-slot:meta><span>2K</span></x-slot:meta>
            <x-slot:actions><button>Copy</button></x-slot:actions>
        </x-lnx-ui::resource-card>
        BLADE);

    expect($html)
        ->toContain('DGX Spark')
        ->toContain('Advanced')
        ->toContain('developer')
        ->toContain('2K')
        ->toContain('Copy');
});

it('links the whole card when a href is given without footer actions', function () {
    $html = Blade::render('<x-lnx-ui::resource-card title="cudaq-guide" href="/guides/cudaq" />');

    expect($html)
        ->toContain('href="/guides/cudaq"')
        ->toContain('wire:navigate')
        ->and(substr_count($html, '<a'))->toBe(1)
        ->and(str_starts_with(trim($html), '<a'))->toBeTrue();
});

it('links only the title when footer actions are present', function () {
    $html = Blade::render('<x-lnx-ui::resource-card title="cudaq-guide" href="/guides/cudaq"><x-slot:actions><button>Copy</button></x-slot:actions></x-lnx-ui::resource-card>');

    expect(substr_count($html, '<a'))->toBe(1)
        ->and($html)->toContain('wire:navigate')
        ->and($html)->toContain('Copy')
        ->and(str_starts_with(trim($html), '<a'))->toBeFalse();
});

it('marks external links and skips wire:navigate', function () {
    $html = Blade::render('<x-lnx-ui::resource-card title="Repository" href="https://example.com" external />');

    expect($html)
        ->toContain('target="_blank"')
        ->toContain('rel="noopener noreferrer"')
        ->not->toContain('wire:navigate');
});

it('omits the footer when no footer content is given', function () {
    $without = Blade::render('<x-lnx-ui::resource-card title="Title" />');
    $with = Blade::render('<x-lnx-ui::resource-card title="Title"><x-slot:tags><span>tag</span></x-slot:tags></x-lnx-ui::resource-card>');

    expect($without)->not->toContain('mt-auto');
    expect($with)
        ->toContain('mt-auto')
        ->toContain('tag');
});
