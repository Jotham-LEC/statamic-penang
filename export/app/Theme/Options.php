<?php

namespace App\Theme;

/**
 * What the Theme global offers: the fonts, corners, base colours, colours and
 * presets. The global's blueprint lists the same keys (Theme\Blueprint), and
 * the theme accepts nothing else, from the control panel or a preview cookie.
 */
final class Options
{
    /**
     * Self-hosted fonts (SIL Open Font Licence, from Fontsource), in
     * resources/fonts/{key}: the Latin subset, upright and, where the family
     * has one, italic. Variable where the family is; `preload` names the file
     * the layout preloads when it isn't {key}-latin-wght-normal.woff2.
     */
    public const FONTS = [
        'inter' => ['label' => 'Inter', 'family' => 'Inter Variable', 'kind' => 'sans', 'italic' => true],
        'manrope' => ['label' => 'Manrope', 'family' => 'Manrope Variable', 'kind' => 'sans', 'italic' => false],
        'plus-jakarta-sans' => ['label' => 'Plus Jakarta Sans', 'family' => 'Plus Jakarta Sans Variable', 'kind' => 'sans', 'italic' => true],
        'figtree' => ['label' => 'Figtree', 'family' => 'Figtree Variable', 'kind' => 'sans', 'italic' => true],
        'outfit' => ['label' => 'Outfit', 'family' => 'Outfit Variable', 'kind' => 'sans', 'italic' => false],
        'montserrat' => ['label' => 'Montserrat', 'family' => 'Montserrat Variable', 'kind' => 'sans', 'italic' => true],
        'poppins' => ['label' => 'Poppins', 'family' => 'Poppins', 'kind' => 'sans', 'italic' => true, 'preload' => 'poppins-latin-400-normal.woff2'],
        'dm-sans' => ['label' => 'DM Sans', 'family' => 'DM Sans Variable', 'kind' => 'sans', 'italic' => true],
        'lora' => ['label' => 'Lora (serif)', 'family' => 'Lora Variable', 'kind' => 'serif', 'italic' => true],
        'fraunces' => ['label' => 'Fraunces (serif)', 'family' => 'Fraunces Variable', 'kind' => 'serif', 'italic' => true],
        'source-serif-4' => ['label' => 'Source Serif (serif)', 'family' => 'Source Serif 4 Variable', 'kind' => 'serif', 'italic' => true],
        'cormorant-garamond' => ['label' => 'Cormorant Garamond (serif, for headings)', 'family' => 'Cormorant Garamond Variable', 'kind' => 'serif', 'italic' => true],
        'playfair-display' => ['label' => 'Playfair Display (serif, for headings)', 'family' => 'Playfair Display Variable', 'kind' => 'serif', 'italic' => true],
        'dm-serif-display' => ['label' => 'DM Serif Display (serif, for headings)', 'family' => 'DM Serif Display', 'kind' => 'serif', 'italic' => true, 'preload' => 'dm-serif-display-latin-400-normal.woff2'],
    ];

    public const FALLBACKS = [
        'sans' => 'ui-sans-serif, system-ui, sans-serif',
        'serif' => 'ui-serif, Georgia, Cambria, "Times New Roman", serif',
    ];

    /** Cards and panels (`--radius`) and buttons and inputs (`--control-radius`). */
    public const RADII = [
        'none' => ['label' => 'None', 'radius' => '0rem', 'control' => '0rem'],
        'small' => ['label' => 'Small', 'radius' => '0.375rem', 'control' => '0.25rem'],
        'medium' => ['label' => 'Medium', 'radius' => '0.625rem', 'control' => '0.5rem'],
        'large' => ['label' => 'Large', 'radius' => '1rem', 'control' => '0.75rem'],
        'full' => ['label' => 'Full', 'radius' => '1.5rem', 'control' => '9999px'],
    ];

    /** The neutral scales: backgrounds, text and borders. */
    public const BASES = [
        'stone' => 'Stone (warm)',
        'zinc' => 'Zinc (cool)',
        'slate' => 'Slate (blue-grey)',
        'neutral' => 'Neutral (pure grey)',
        'gray' => 'Gray',
    ];

    /** The colours offered for primary and secondary, by Tailwind's names. */
    public const COLOURS = [
        'red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal',
        'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose',
    ];

    public const MODES = [
        'system' => 'Follow the visitor’s device',
        'light' => 'Light',
        'dark' => 'Dark',
    ];

    /**
     * Ready-made themes. A setting left empty in the Theme global takes the
     * chosen preset's value.
     */
    public const PRESETS = [
        'default' => [
            'label' => 'Default',
            'heading_font' => 'inter', 'body_font' => 'inter', 'radius' => 'medium',
            'base' => 'zinc', 'primary' => 'blue', 'secondary' => 'amber',
        ],
        'kopitiam' => [
            'label' => 'Kopitiam (warm)',
            'heading_font' => 'fraunces', 'body_font' => 'figtree', 'radius' => 'small',
            'base' => 'stone', 'primary' => 'amber', 'secondary' => 'emerald',
        ],
        'pantai' => [
            'label' => 'Pantai (sea)',
            'heading_font' => 'outfit', 'body_font' => 'manrope', 'radius' => 'large',
            'base' => 'slate', 'primary' => 'cyan', 'secondary' => 'orange',
        ],
        'hutan' => [
            'label' => 'Hutan (forest)',
            'heading_font' => 'lora', 'body_font' => 'inter', 'radius' => 'medium',
            'base' => 'stone', 'primary' => 'emerald', 'secondary' => 'lime',
        ],
        'batik' => [
            'label' => 'Batik (indigo and gold)',
            'heading_font' => 'source-serif-4', 'body_font' => 'plus-jakarta-sans', 'radius' => 'full',
            'base' => 'zinc', 'primary' => 'indigo', 'secondary' => 'amber',
        ],
    ];

    public const SETTINGS = ['heading_font', 'body_font', 'radius', 'base', 'primary', 'secondary'];
}
