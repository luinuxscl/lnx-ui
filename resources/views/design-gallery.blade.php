<section class="flex w-full flex-col gap-8">
    <div>
        <flux:heading level="1">{{ __('lnx-ui::design-gallery.title') }}</flux:heading>
        <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.intro') }}</flux:text>
    </div>

    {{-- Component index: each entry links to its stable anchor (#name). --}}
    <nav aria-label="{{ __('lnx-ui::design-gallery.index') }}" class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
        <flux:heading level="2" size="sm">{{ __('lnx-ui::design-gallery.index') }}</flux:heading>
        <ul class="mt-3 grid grid-cols-2 gap-x-4 gap-y-1 font-mono text-sm sm:grid-cols-3 lg:grid-cols-4">
            @foreach (['page-header', 'stat', 'stat-card', 'statistics-panel', 'widget', 'trend-card', 'chart-card', 'metric-card', 'summary-card', 'tool-card', 'resource-card', 'properties-card', 'timeline', 'media-cell', 'chip', 'data-table', 'data-table-inline', 'kanban', 'placeholder-pattern', 'auth-header', 'auth-session-status', 'mail-list-item', 'attachment-card', 'presence-list', 'mail-viewer', 'rich-text-editor', 'sam', 'loading', 'empty-state', 'error-state', 'validation', 'actions-statuses', 'messaging'] as $anchor)
                <li><a href="#{{ $anchor }}" class="text-accent-content hover:underline">{{ $anchor }}</a></li>
            @endforeach
        </ul>
    </nav>

    <section class="space-y-8" aria-label="{{ __('lnx-ui::design-gallery.library_title') }}">
        <div>
            <flux:heading level="2">{{ __('lnx-ui::design-gallery.library_title') }}</flux:heading>
            <flux:text class="mt-1">{{ __('lnx-ui::design-gallery.library_intro') }}</flux:text>
        </div>

        @include('lnx-ui::gallery.categories.pagina', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.metricas', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.catalogo', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.datos', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.kanban', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.correo', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.editor', ['showSnippets' => $showSnippets ?? false])
        @include('lnx-ui::gallery.categories.auth', ['showSnippets' => $showSnippets ?? false])
    </section>

    @include('lnx-ui::gallery.categories.estados', ['showSnippets' => $showSnippets ?? false])
    @include('lnx-ui::gallery.categories.sam', ['showSnippets' => $showSnippets ?? false])
</section>
