<?php

namespace App\Theme;

use Statamic\Facades\GlobalSet;
use Statamic\Facades\User;

/**
 * The theme a request is shown in: the Theme global's preset and light/dark
 * setting, or a preset chosen in the theme switcher (the `penang_theme`
 * cookie) where previews are allowed: for someone signed in to the control
 * panel, and for everyone on a demo site (`PENANG_THEME_PREVIEW=true`). A
 * preset is the whole look (fonts, corners and colours): nothing else is
 * read, so a preset is never mixed with settings of another.
 */
final class SiteTheme
{
    public const COOKIE = 'penang_theme';

    /** Worked out once per request. */
    public static function current(): Theme
    {
        $attributes = request()->attributes;
        if (! $attributes->has('penang.theme')) {
            $attributes->set('penang.theme', new Theme([...self::saved(), ...self::preview()]));
        }

        return $attributes->get('penang.theme');
    }

    /** @return array<string, string|null> the Theme global's preset and light/dark setting */
    public static function saved(): array
    {
        $values = GlobalSet::findByHandle('theme')?->inCurrentSite()?->data()->all() ?? [];

        return array_intersect_key($values, array_flip(['preset', 'mode']));
    }

    /** Whether the switcher shows, and its cookie counts, for this request. */
    public static function previewing(): bool
    {
        return (bool) config('penang.theme_preview') || (bool) User::current()?->can('access cp');
    }

    /** @return array<string, string> the preset chosen in the switcher, if it is one */
    public static function preview(): array
    {
        if (! self::previewing()) {
            return [];
        }

        $choices = json_decode((string) request()->cookie(self::COOKIE), true);
        $preset = is_array($choices) ? ($choices['preset'] ?? null) : null;

        return Theme::valid('preset', $preset) ? ['preset' => $preset] : [];
    }

    /** Whether the visitor may switch between light and dark. */
    public static function modeToggle(): bool
    {
        $value = GlobalSet::findByHandle('theme')?->inCurrentSite()?->get('mode_toggle');

        return $value === null ? true : (bool) $value;
    }
}
