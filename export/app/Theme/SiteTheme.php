<?php

namespace App\Theme;

use Statamic\Facades\GlobalSet;
use Statamic\Facades\User;

/**
 * The theme a request is shown in: the Theme global's settings, and on top of
 * them a preview from the theme switcher (the `penang_theme` cookie) where
 * previews are allowed: for someone signed in to the control panel, and for
 * everyone on a demo site (`PENANG_THEME_PREVIEW=true`). The cookie only
 * holds choices; each is checked against the options before it is used.
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

    /** @return array<string, string|null> the Theme global's settings, custom colours as hex */
    public static function saved(): array
    {
        $values = GlobalSet::findByHandle('theme')?->inCurrentSite()?->data()->all() ?? [];

        foreach (['primary', 'secondary'] as $key) {
            if (($values[$key] ?? null) === 'custom') {
                $values[$key] = $values["{$key}_custom"] ?? null;
            }
        }

        return array_intersect_key($values, array_flip(['preset', 'mode', ...Options::SETTINGS]));
    }

    /** Whether the switcher shows, and its cookie counts, for this request. */
    public static function previewing(): bool
    {
        return (bool) config('penang.theme_preview') || (bool) User::current()?->can('access cp');
    }

    /** @return array<string, string> the switcher's choices that are valid */
    public static function preview(): array
    {
        if (! self::previewing()) {
            return [];
        }

        $choices = json_decode((string) request()->cookie(self::COOKIE), true);
        if (! is_array($choices)) {
            return [];
        }

        // A preset chosen in the switcher replaces the saved settings, as
        // choosing it in the control panel with every setting cleared would.
        $base = isset($choices['preset']) && Theme::valid('preset', $choices['preset'])
            ? array_fill_keys(Options::SETTINGS, null)
            : [];

        return [
            ...$base,
            ...array_filter($choices, fn ($value, $key) => Theme::valid($key, $value), ARRAY_FILTER_USE_BOTH),
        ];
    }

    /** Whether the visitor may switch between light and dark. */
    public static function modeToggle(): bool
    {
        $value = GlobalSet::findByHandle('theme')?->inCurrentSite()?->get('mode_toggle');

        return $value === null ? true : (bool) $value;
    }
}
