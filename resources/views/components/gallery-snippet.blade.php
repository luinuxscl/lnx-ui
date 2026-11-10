@props(['name'])

@php
    $snippetPath = dirname(__DIR__).'/gallery/snippets/'.$name.'.blade.txt';
    $snippet = is_file($snippetPath) ? trim((string) file_get_contents($snippetPath)) : '';
@endphp

@if ($snippet !== '')
    <div {{ $attributes->class('mt-3 space-y-1') }} data-gallery-snippet="{{ $name }}">
        <flux:text size="sm" class="font-medium text-zinc-500 dark:text-zinc-400">{{ __('lnx-ui::design-gallery.snippet_label') }}</flux:text>
        <div class="relative rounded-lg border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900">
            <pre class="overflow-x-auto p-3 font-mono text-xs leading-relaxed text-zinc-800 dark:text-zinc-200"><code>{{ $snippet }}</code></pre>
        </div>
    </div>
@endif
