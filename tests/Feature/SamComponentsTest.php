<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ViewErrorBag;

beforeEach(function () {
    view()->share('errors', new ViewErrorBag);
    App::setLocale('en');
});

it('renders the sam trigger with its accessible label and shortcut', function () {
    $html = Blade::render('<x-lnx-ui::sam-trigger />');

    expect($html)
        ->toContain('sam-open')
        ->toContain('aria-label="Open Sam"')
        ->toContain('⌘J');
});

it('renders the sam panel as a responsive dialog with slots', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-panel title="Sam" open="$wire.open" close="$wire.set('open', false)">
            <x-slot:context><span>context</span></x-slot:context>
            <p>conversation</p>
            <x-slot:footer><p>composer</p></x-slot:footer>
        </x-lnx-ui::sam-panel>
    BLADE);

    expect($html)
        ->toContain('role="dialog"')
        ->toContain('aria-modal="true"')
        ->toContain('max-w-md')
        ->toContain('w-full')
        ->toContain('dark:bg-zinc-900')
        ->toContain('context')
        ->toContain('conversation')
        ->toContain('composer')
        ->toContain('x-on:click')
        ->and(html_entity_decode($html))->toContain('$wire.set(\'open\', false)');
});

it('renders the sam panel in preview mode without an overlay', function () {
    $html = Blade::render('<x-lnx-ui::sam-panel preview title="Sam"><p>conversation</p></x-lnx-ui::sam-panel>');

    expect($html)
        ->toContain('relative h-[34rem]')
        ->toContain('conversation')
        ->not->toContain('bg-zinc-950/40');
});

it('renders user and assistant message bubbles', function () {
    $user = Blade::render('<x-lnx-ui::sam-message role="user">hello</x-lnx-ui::sam-message>');
    $assistant = Blade::render('<x-lnx-ui::sam-message>hi</x-lnx-ui::sam-message>');

    expect($user)->toContain('bg-violet-600')->toContain('hello')->toContain('justify-end')
        ->and($assistant)->toContain('bg-zinc-100')->toContain('hi')->toContain('justify-start');
});

it('renders the context chip with label and source', function () {
    $html = Blade::render('<x-lnx-ui::sam-context-chip label="Contact · Ada" source="crm" />');

    expect($html)
        ->toContain('Contact · Ada')
        ->toContain('crm')
        ->toContain('Current screen');
});

it('renders suggestion chips that dispatch a browser event', function () {
    $html = Blade::render('<x-lnx-ui::sam-suggestions :items="[\'One\', \'Two\']" />');

    expect($html)
        ->toContain('sam-suggestion')
        ->toContain('One')
        ->toContain('Two');
});

it('renders the empty state with its default copy and actions', function () {
    $html = Blade::render('<x-lnx-ui::sam-empty-state><button>start</button></x-lnx-ui::sam-empty-state>');

    expect($html)
        ->toContain('How can I help?')
        ->toContain('You confirm them.')
        ->toContain('start')
        ->toContain('role="status"');
});

it('renders a notice for the unconfigured state', function () {
    $html = Blade::render('<x-lnx-ui::sam-notice variant="warning">not configured</x-lnx-ui::sam-notice>');

    expect($html)->toContain('not configured')->toContain('data-flux-callout');
});

it('renders the typing indicator accessibly', function () {
    $html = Blade::render('<x-lnx-ui::sam-typing />');

    expect($html)->toContain('role="status"')->toContain('Sam is typing');
});

it('renders a proposal card with diff, expiry and a phrase field', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-1"
            title="Update phone"
            summary="Changes the phone."
            :changes="[['field' => 'phone', 'label' => 'Phone', 'old' => '+56 9 1111', 'new' => '+56 9 2222']]"
            status="pending"
            :expires-at="now()->addMinutes(30)"
            record-url="/crm/contacts/1"
            :can-confirm="true"
        />
    BLADE);

    expect($html)
        ->toContain('Update phone')
        ->toContain('+56 9 1111')
        ->toContain('+56 9 2222')
        ->toContain('Pending')
        ->toContain('Expires')
        ->toContain('View record')
        ->toContain('Confirmation phrase')
        ->toContain('sam-confirm')
        ->toContain('sam-phrase-consumed')
        ->not->toContain('CONFIRM ABC12345');
});

it('rejects confirmation input for an expired proposal', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-2"
            title="Update phone"
            :changes="[]"
            status="pending"
            :expires-at="now()->subMinute()"
            :can-confirm="true"
        />
    BLADE);

    expect($html)
        ->toContain('Expired')
        ->not->toContain('sam-confirm')
        ->not->toContain('Confirm</');
});

it('documents the sam surface in the design gallery', function () {
    $html = view('lnx-ui::design-gallery')->render();

    expect($html)
        ->toContain('id="sam"')
        ->toContain('data-sam-panel')
        ->toContain('sam-open')
        ->toContain('data-sam-proposal')
        ->toContain('x-lnx-ui::sam-panel')
        ->toContain('x-lnx-ui::sam-trigger')
        ->toContain('x-lnx-ui::sam-proposal-card')
        ->toContain('Sam surface');
});
