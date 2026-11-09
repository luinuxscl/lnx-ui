<?php

namespace Luinuxscl\LnxUi;

/**
 * Reads the kanban scripts shipped with the package.
 */
final class KanbanAssets
{
    public static function sortableSource(): string
    {
        return self::read('sortable.min.js');
    }

    public static function behaviorSource(): string
    {
        return self::read('kanban.js');
    }

    private static function read(string $filename): string
    {
        $path = dirname(__DIR__).'/resources/js/'.$filename;

        if (! is_file($path)) {
            return '';
        }

        return (string) file_get_contents($path);
    }
}
