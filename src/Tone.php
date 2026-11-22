<?php

declare(strict_types=1);

namespace Luinuxscl\LnxUi;

/**
 * Tone classes of the shared color variants used by lnx-ui components.
 *
 * Single source for the icon-chip and tone-fill classes previously
 * duplicated as match blocks across components. Colors not declared here
 * fall back to the accent tone, which resolves against the host app's
 * CSS custom properties.
 */
class Tone
{
    /**
     * Classes per supported color variant (light and dark).
     *
     * @var array<string, string>
     */
    protected const CLASSES = [
        'violet' => 'bg-violet-100 text-violet-600 dark:bg-violet-500/15 dark:text-violet-400',
        'cyan' => 'bg-cyan-100 text-cyan-600 dark:bg-cyan-500/15 dark:text-cyan-400',
        'rose' => 'bg-rose-100 text-rose-600 dark:bg-rose-500/15 dark:text-rose-400',
        'emerald' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400',
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400',
        'amber' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
        'zinc' => 'bg-zinc-100 text-zinc-600 dark:bg-zinc-500/15 dark:text-zinc-400',
    ];

    public static function classes(string $color): string
    {
        return self::CLASSES[$color] ?? 'bg-accent/10 text-accent-content';
    }
}
