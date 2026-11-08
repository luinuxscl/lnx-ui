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
        ->toContain('⌘J')
        ->toContain('data-sam-trigger-badge');
});

it('renders the proactive badge count when provided', function () {
    $html = Blade::render('<x-lnx-ui::sam-trigger :count="3" />');

    expect($html)
        ->toContain('data-sam-trigger-badge')
        ->toContain('x-text="badge > 9');
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

it('renders the sam panel actions slot next to the title', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-panel title="Sam" close="close()">
            <x-slot:actions><button data-test-action>settings</button></x-slot:actions>
            <p>conversation</p>
        </x-lnx-ui::sam-panel>
    BLADE);

    expect($html)->toContain('data-test-action')->toContain('settings');
});

it('renders a timestamp on a message', function () {
    $html = Blade::render('<x-lnx-ui::sam-message :time="now()->setTime(9, 5)">hello</x-lnx-ui::sam-message>');

    expect($html)
        ->toContain('data-sam-message-time')
        ->toContain('datetime="')
        ->toContain('09:05');
});

it('renders the sam panel in preview mode without an overlay', function () {
    $html = Blade::render('<x-lnx-ui::sam-panel preview title="Sam"><p>conversation</p></x-lnx-ui::sam-panel>');

    expect($html)
        ->toContain('relative h-[34rem]')
        ->toContain('conversation')
        ->not->toContain('bg-zinc-950/40');
});

it('renders the sam panel as a non-modal dock for the persistent sidecar', function () {
    $html = Blade::render('<x-lnx-ui::sam-panel dock title="Sam"><p>conversation</p></x-lnx-ui::sam-panel>');

    expect($html)
        ->toContain('role="complementary"')
        ->toContain('conversation')
        ->toContain('fixed inset-y-0 right-0')
        ->not->toContain('aria-modal')
        ->not->toContain('role="dialog"')
        ->not->toContain('bg-zinc-950/40');
});

it('renders user and assistant message bubbles', function () {
    $user = Blade::render('<x-lnx-ui::sam-message role="user">hello</x-lnx-ui::sam-message>');
    $assistant = Blade::render('<x-lnx-ui::sam-message>hi</x-lnx-ui::sam-message>');

    expect($user)->toContain('bg-accent')->toContain('text-accent-foreground')->toContain('hello')->toContain('justify-end')->toContain('data-sam-message')
        ->and($assistant)->toContain('bg-zinc-100')->toContain('hi')->toContain('justify-start')->toContain('data-sam-message');
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

it('defaults the risk to irreversible and labels it', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-3"
            title="Create contact"
            :changes="[]"
            status="pending"
            :can-confirm="true"
        />
    BLADE);

    expect($html)
        ->toContain('data-sam-proposal-risk="irreversible"')
        ->toContain('Irreversible')
        ->toContain('Confirmation phrase');
});

it('confirms a reversible proposal with one click and no phrase field', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-4"
            title="Update phone"
            :changes="[]"
            status="pending"
            risk="reversible"
            :requires-phrase="false"
            :can-confirm="true"
        />
    BLADE);

    expect($html)
        ->toContain('data-sam-proposal-risk="reversible"')
        ->toContain('Reversible')
        ->toContain('Confirms with one click')
        ->toContain('sam-confirm')
        ->not->toContain('Confirmation phrase')
        ->not->toContain('sam-phrase-consumed');
});

it('keeps the phrase for a bulk proposal', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-5"
            title="Archive contacts"
            :changes="[]"
            status="pending"
            risk="bulk"
            :can-confirm="true"
        />
    BLADE);

    expect($html)
        ->toContain('data-sam-proposal-risk="bulk"')
        ->toContain('Bulk change')
        ->toContain('Confirmation phrase');
});

it('offers a one-shot undo on a confirmed proposal', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-6"
            title="Update phone"
            :changes="[]"
            status="confirmed"
            risk="reversible"
            :can-undo="true"
            :undo-expires-at="now()->addMinutes(30)"
        />
    BLADE);

    expect($html)
        ->toContain('data-sam-proposal-undo')
        ->toContain('Undo available')
        ->toContain('sam-undo')
        ->toContain('used = true')
        ->toContain('Undo');
});

it('hides the undo when it is unavailable or the window elapsed', function () {
    $withoutUndo = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-7"
            title="Update phone"
            :changes="[]"
            status="confirmed"
            risk="reversible"
        />
    BLADE);

    $expiredUndo = Blade::render(<<<'BLADE'
        <x-lnx-ui::sam-proposal-card
            source="crm"
            id="draft-8"
            title="Update phone"
            :changes="[]"
            status="confirmed"
            risk="reversible"
            :can-undo="true"
            :undo-expires-at="now()->subMinute()"
        />
    BLADE);

    expect($withoutUndo)
        ->not->toContain('data-sam-proposal-undo')
        ->not->toContain('sam-undo');

    expect($expiredUndo)
        ->not->toContain('data-sam-proposal-undo')
        ->not->toContain('sam-undo');
});

it('renders a copy action on an assistant message', function () {
    $html = Blade::render('<x-lnx-ui::sam-message copy>Hello there</x-lnx-ui::sam-message>');

    expect($html)
        ->toContain('data-sam-copy')
        ->toContain('navigator.clipboard')
        ->toContain('Copy')
        ->toContain('Hello there');
});

it('renders no copy action by default', function () {
    expect(Blade::render('<x-lnx-ui::sam-message>Hello there</x-lnx-ui::sam-message>'))
        ->not->toContain('data-sam-copy');
});

it('renders markdown in assistant messages', function () {
    $html = Blade::render('<x-lnx-ui::sam-message>**Bold** and a [link](https://example.test)</x-lnx-ui::sam-message>');

    expect($html)
        ->toContain('<strong>Bold</strong>')
        ->toContain('<a href="https://example.test"')
        ->not->toContain('**Bold**')
        ->not->toContain('whitespace-pre-line');
});

it('keeps user messages as plain text', function () {
    $html = Blade::render('<x-lnx-ui::sam-message role="user">**Not bold**</x-lnx-ui::sam-message>');

    expect($html)
        ->toContain('**Not bold**')
        ->toContain('whitespace-pre-line')
        ->not->toContain('<strong>');
});

it('strips raw html and unsafe links from markdown messages', function () {
    $html = Blade::render('<x-lnx-ui::sam-message><script>alert(1)</script>[x](javascript:alert(1))</x-lnx-ui::sam-message>');

    expect($html)
        ->not->toContain('<script>')
        ->not->toContain('javascript:');
});

it('renders clickable citations on an assistant message', function () {
    $citations = [
        ['type' => 'help', 'slug' => 'invitar', 'title' => 'How to invite people', 'url' => 'https://example.test/help/invitar'],
        ['type' => 'web', 'title' => 'Laravel docs', 'url' => 'https://laravel.com/docs'],
    ];

    $html = Blade::render(
        '<x-lnx-ui::sam-message :citations="$citations">Answer</x-lnx-ui::sam-message>',
        ['citations' => $citations],
    );

    expect($html)
        ->toContain('data-sam-citations')
        ->toContain('Sources')
        ->toContain('href="https://example.test/help/invitar"')
        ->toContain('How to invite people')
        ->toContain('target="_blank"')
        ->toContain('rel="noopener noreferrer"');
});

it('hides the citations when sources are disabled', function () {
    $citations = [['type' => 'help', 'title' => 'Help', 'url' => 'https://example.test/help']];

    expect(Blade::render(
        '<x-lnx-ui::sam-message :citations="$citations" :sources="false">Answer</x-lnx-ui::sam-message>',
        ['citations' => $citations],
    ))->not->toContain('data-sam-citations');
});

it('drops citations without a web url', function () {
    $citations = [['type' => 'help', 'title' => 'Broken', 'url' => 'javascript:alert(1)']];

    expect(Blade::render(
        '<x-lnx-ui::sam-message :citations="$citations">Answer</x-lnx-ui::sam-message>',
        ['citations' => $citations],
    ))->not->toContain('data-sam-citations');
});

it('renders the turn trace with its entries and activity link', function () {
    $trace = (object) [
        'activityUrl' => 'https://example.test/crm/agent-activity?turn=abc',
        'entries' => [
            (object) ['tool' => 'crm_get_contact', 'label' => 'Ada Lovelace', 'kind' => 'read', 'status' => 'read', 'resource' => 'contact', 'count' => 1, 'url' => 'https://example.test/crm/contacts/1'],
            (object) ['tool' => 'sam_confirm', 'label' => 'Acme', 'kind' => 'denied', 'status' => 'denied', 'resource' => 'company', 'count' => null, 'url' => null],
        ],
    ];

    $html = Blade::render('<x-lnx-ui::sam-trace :trace="$trace" />', ['trace' => $trace]);

    expect($html)
        ->toContain('data-sam-trace')
        ->toContain('What I read in this turn')
        ->toContain('Ada Lovelace')
        ->toContain('1 result')
        ->toContain('Denied')
        ->toContain('Open record')
        ->toContain('See activity')
        ->toContain('turn=abc');
});

it('renders no trace when the turn has no entries', function () {
    $trace = (object) ['activityUrl' => null, 'entries' => []];

    expect(Blade::render('<x-lnx-ui::sam-trace :trace="$trace" />', ['trace' => $trace]))
        ->not->toContain('data-sam-trace');
});

it('renders the shared signals block for observations and actions', function () {
    $actions = [
        (object) ['label' => 'Complete profile', 'description' => 'Missing owner.', 'url' => '#'],
    ];

    $html = Blade::render(
        '<x-lnx-ui::sam-signals :observations="$observations" :actions="$actions" :observation-limit="1" />',
        ['observations' => ['No company.', 'No owner.'], 'actions' => $actions],
    );

    expect($html)
        ->toContain('What I see')
        ->toContain('No company.')
        ->not->toContain('No owner.')
        ->toContain('and 1 more')
        ->toContain('What you can do')
        ->toContain('Complete profile')
        ->toContain('text-accent-content');
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
        ->toContain('x-lnx-ui::sam-trace')
        ->toContain('x-lnx-ui::sam-signals')
        ->toContain('data-sam-streaming-sample')
        ->toContain('Sam surface');
});
