<?php

use Illuminate\Support\Facades\Blade;

beforeEach(function () {
    app()->setLocale('en');
});

it('renders the mail list item with sender, subject and states', function () {
    $html = Blade::render('<x-lnx-ui::mail-list-item sender="Sujika" subject="Hello" preview="Body" time="10:27AM" unread starred selected />');

    expect($html)
        ->toContain('Sujika')
        ->toContain('Hello')
        ->toContain('Body')
        ->toContain('10:27AM')
        ->toContain('data-selected')
        ->toContain('starred: true')
        ->toContain(':aria-pressed="starred ? \'true\' : \'false\'"');
});

it('renders the mail list item badge and checkbox label', function () {
    $html = Blade::render('<x-lnx-ui::mail-list-item sender="King Berunda" :badge="[\'label\' => \'Promotion\', \'color\' => \'emerald\']" />');

    expect($html)
        ->toContain('King Berunda')
        ->toContain('Promotion')
        ->toContain('Select message from King Berunda');
});

it('renders the attachment card as a link when href is given', function () {
    $link = Blade::render('<x-lnx-ui::attachment-card name="Report.pdf" size="0.85MB" icon="document-text" color="blue" href="/files/report.pdf" />');
    $plain = Blade::render('<x-lnx-ui::attachment-card name="Notes.docx" />');

    expect($link)
        ->toContain('Report.pdf')
        ->toContain('0.85MB')
        ->toContain('href="/files/report.pdf"')
        ->toContain('download');

    expect($plain)
        ->toContain('Notes.docx')
        ->not->toContain('<a ');
});

it('renders the presence list with users and online state', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::presence-list
            title="Online users"
            :users="[
                ['name' => 'Angelica', 'line' => 'Hello'],
                ['name' => 'Rexha', 'online' => false],
            ]"
        />
        BLADE);

    expect($html)
        ->toContain('Online users')
        ->toContain('Angelica')
        ->toContain('Hello')
        ->toContain('Rexha')
        ->toContain('bg-emerald-500');
});

it('renders the mail viewer with header, body and slots', function () {
    $html = Blade::render(<<<'BLADE'
        <x-lnx-ui::mail-viewer sender="Michael Jeremy" email="michael@example.com" subject="History" date="Oct-22">
            <x-slot:actions><button>Star</button></x-slot:actions>
            <x-slot:attachments><p>files</p></x-slot:attachments>
            <x-slot:reply><p>reply</p></x-slot:reply>
            <x-slot:footer><p>footer</p></x-slot:footer>
            <p>body</p>
        </x-lnx-ui::mail-viewer>
    BLADE);

    expect($html)
        ->toContain('Michael Jeremy')
        ->toContain('michael@example.com')
        ->toContain('History')
        ->toContain('Oct-22')
        ->toContain('Star')
        ->toContain('body')
        ->toContain('files')
        ->toContain('reply')
        ->toContain('footer');
});
