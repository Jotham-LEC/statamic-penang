<?php

namespace App\Theme;

use InvalidArgumentException;

/**
 * The site's look, from the Theme global: the chosen preset with any setting
 * the editor changed, turned into the CSS custom properties the layout prints
 * and Tailwind's `@theme inline` reads (resources/css/site.css).
 *
 * Every colour token comes in light and dark (`light-dark()`), and in the
 * tones a section can take (`data-tone`): the page's own, muted, primary,
 * inverted, and overlay for text on a photo. Each tone sets the same tokens, so a section's buttons, cards and
 * text keep their contrast whatever it sits on. Each `*-foreground` is chosen
 * here, for WCAG AA against its background, and so is the shade of the
 * primary colour: a shade too light to read as a link is passed over.
 */
final class Theme
{
    public const TONES = ['default', 'muted', 'primary', 'inverted', 'overlay'];

    public const MODES = ['light', 'dark'];

    /** WCAG AA for body text. */
    public const AA = 4.5;

    /** WCAG AA for the edges of controls (1.4.11). */
    public const NON_TEXT = 3.0;

    /** @var array<string, string> */
    public readonly array $settings;

    /** @var array<string, array<string, array<string, Colour|Mix>>>|null */
    private ?array $palette = null;

    /** The theme's lightest and darkest colours: an off-white and a deep grey, toned. */
    private Colour $paper;

    private Colour $ink;

    /**
     * @param  array<string, string|null>  $settings  a preset and any of Options::SETTINGS
     *                                                (a colour may be a name or a hex value);
     *                                                empty values take the preset's
     */
    public function __construct(array $settings = [])
    {
        $preset = $settings['preset'] ?? null;
        $preset = isset(Options::PRESETS[$preset]) ? $preset : 'default';
        $resolved = ['preset' => $preset];

        foreach (Options::SETTINGS as $key) {
            $value = $settings[$key] ?? null;
            $resolved[$key] = self::valid($key, $value) ? strtolower(trim($value)) : Options::PRESETS[$preset][$key];
        }

        // A preset may give dark mode a primary colour of its own (a hex value);
        // one is also accepted here, to try a preset before adding it.
        $dark = $settings['primary_dark'] ?? null;
        $resolved['primary_dark'] = Colour::isHex($dark) ? strtolower(trim($dark)) : (Options::PRESETS[$preset]['primary_dark'] ?? null);

        $mode = $settings['mode'] ?? null;
        $resolved['mode'] = isset(Options::MODES[$mode]) ? $mode : 'system';

        $this->settings = $resolved;
    }

    /**
     * The text colours and what they're read on, in every tone and mode, that
     * fall short of WCAG AA, and the field edges short of 3:1: an empty list
     * for a readable theme. tests/Feature/Theme/ContrastTest.php checks the
     * presets the same way.
     *
     * @return list<string>
     */
    public function contrastFailures(): array
    {
        $pairs = [
            ['foreground', 'background'], ['muted-foreground', 'background'], ['muted-foreground', 'muted'],
            ['card-foreground', 'card'], ['muted-foreground', 'card'], ['primary', 'background'],
            ['primary-foreground', 'primary'], ['primary-foreground', 'primary-hover'], ['secondary-foreground', 'secondary'],
            ['secondary-foreground', 'secondary-hover'], ['accent-foreground', 'accent'], ['destructive', 'background'],
            ['destructive', 'card'], ['destructive-foreground', 'destructive'],
        ];
        $colour = fn (Colour|Mix $c) => $c instanceof Mix ? $c->colour() : $c;
        $failures = [];

        foreach ($this->palette() as $tone => $modes) {
            foreach ($modes as $mode => $tokens) {
                foreach ($pairs as [$text, $on]) {
                    $ratio = $colour($tokens[$text])->contrast($colour($tokens[$on]));
                    if ($ratio < self::AA) {
                        $failures[] = sprintf('%s on %s (%s, %s): %.2f', $text, $on, $tone, $mode, $ratio);
                    }
                }
                $edge = $colour($tokens['input'])->contrast($colour($tokens['background']));
                if ($edge < self::NON_TEXT) {
                    $failures[] = sprintf('input on background (%s, %s): %.2f', $tone, $mode, $edge);
                }
            }
        }

        return $failures;
    }

    /** Whether a value is one the setting offers: anything else is ignored. */
    public static function valid(string $key, mixed $value): bool
    {
        if (! is_string($value) || $value === '') {
            return false;
        }

        return match ($key) {
            'heading_font', 'body_font' => isset(Options::FONTS[$value]),
            'radius' => isset(Options::RADII[$value]),
            'base' => isset(Options::BASES[$value]),
            'primary', 'secondary' => in_array($value, Options::COLOURS, true) || Colour::isHex($value),
            'preset' => isset(Options::PRESETS[$value]),
            'mode' => isset(Options::MODES[$value]),
            default => false,
        };
    }

    public function font(string $which): array
    {
        $key = $this->settings[$which.'_font'];

        return ['key' => $key, ...Options::FONTS[$key]];
    }

    public function fontStack(string $which): string
    {
        $font = $this->font($which);

        return '"'.$font['family'].'", '.Options::FALLBACKS[$font['kind']];
    }

    /**
     * Each tone's tokens in each mode.
     *
     * @return array<string, array<string, array<string, Colour|Mix>>> tone → mode → token → colour
     */
    public function palette(): array
    {
        if ($this->palette !== null) {
            return $this->palette;
        }

        $base = self::scale($this->settings['base']);
        $primary = self::scale($this->settings['primary']);
        $secondary = self::scale($this->settings['secondary']);
        [$this->paper, $this->ink] = [$this->tone($base, $primary, 0.99, 50, 0.005), $this->tone($base, $primary, 0.22, 950, 0.016)];

        $default = [
            'light' => $this->surface($base, $primary, $secondary, 'light'),
            'dark' => $this->surface($base, $this->settings['primary_dark'] ? self::scale($this->settings['primary_dark']) : $primary, $secondary, 'dark'),
        ];

        $palette = ['default' => $default];
        foreach (self::MODES as $mode) {
            $palette['muted'][$mode] = $this->mutedTone($default[$mode]);
            $palette['primary'][$mode] = $this->primaryTone($default[$mode]);
        }
        // Inverted is the other mode's page: a dark band on a light page, and
        // the other way round.
        $palette['inverted'] = ['light' => $default['dark'], 'dark' => $default['light']];
        // Text on a photo, over the dark scrim (--overlay): the dark page's
        // tokens in either mode.
        $palette['overlay'] = ['light' => $default['dark'], 'dark' => $default['dark']];

        return $this->palette = $palette;
    }

    /** The CSS the layout prints in its <head>. */
    public function css(): string
    {
        $radius = Options::RADII[$this->settings['radius']];
        $base = self::scale($this->settings['base']);

        $root = [
            '--heading-font' => $this->fontStack('heading'),
            '--body-font' => $this->fontStack('body'),
            '--radius' => $radius['radius'],
            '--control-radius' => $radius['control'],
            // Behind text on a photo, in either mode: the dark page's colour.
            '--overlay' => $this->palette()['default']['dark']['background']->css(),
            '--overlay-foreground' => $this->paper->css(),
            // Shadows in the theme's own dark, never black.
            '--shadow' => $this->ink->css(),
            // A fill that carries light text in either mode (the light mode's
            // primary): the floating WhatsApp button, white on colour in dark mode too.
            '--solid' => $this->palette()['default']['light']['primary']->css(),
            '--solid-foreground' => $this->palette()['default']['light']['primary-foreground']->css(),
            '--solid-hover' => $this->palette()['default']['light']['primary-hover']->css(),
        ];

        $css = ':root{color-scheme:light dark;'.self::declarations($root).self::declarations($this->tokens('default')).'}';
        $css .= ':root[data-theme=light]{color-scheme:light}:root[data-theme=dark]{color-scheme:dark}';
        foreach (['muted', 'primary', 'inverted', 'overlay'] as $tone) {
            $css .= "[data-tone={$tone}]{".self::declarations($this->tokens($tone)).'}';
        }

        return $css;
    }

    /** @return array<string, string> one tone's tokens as CSS values */
    public function tokens(string $tone): array
    {
        $palette = $this->palette()[$tone];
        $tokens = [];
        foreach ($palette['light'] as $name => $light) {
            $tokens["--{$name}"] = sprintf('light-dark(%s, %s)', $light->css(), $palette['dark'][$name]->css());
        }

        return $tokens;
    }

    /**
     * A colour's shades, 50–950: Tailwind's, or for a hex value, a scale of
     * its hue and chroma at Tailwind's average lightness for each shade, with
     * the colour itself at the shade nearest its lightness.
     *
     * @return array<int, Colour>
     */
    public static function scale(string $colour): array
    {
        if (isset(Palette::COLOURS[$colour])) {
            return array_map(Colour::lch(...), Palette::COLOURS[$colour]);
        }

        if (! Colour::isHex($colour)) {
            throw new InvalidArgumentException("Not a colour: {$colour}");
        }

        $picked = Colour::fromHex($colour);
        $ladder = self::ladder();
        $nearest = array_reduce(array_keys($ladder), fn ($best, $shade) => $best === null || abs($ladder[$shade]['l'] - $picked->l) < abs($ladder[$best]['l'] - $picked->l) ? $shade : $best);

        $scale = [];
        foreach ($ladder as $shade => ['l' => $l, 'c' => $c]) {
            $scale[$shade] = $shade === $nearest
                ? $picked
                : (new Colour($l, $picked->c * $c / $ladder[$nearest]['c'], $picked->h))->toGamut();
        }

        return $scale;
    }

    /**
     * A neutral at lightness $l, in the base colour's tone: its own chroma at
     * that shade, at least $minChroma, so even "neutral" isn't a dead grey,
     * and at most 0.025, so a page stays a grey with a tone, not a colour.
     * A base without a hue of its own takes the primary colour's.
     */
    private function tone(array $base, array $primary, float $l, int $shade, float $minChroma): Colour
    {
        $hue = $base[500]->c > 0.01 ? $base[500]->h : $primary[500]->h;

        return (new Colour($l, min(max($base[$shade]->c, $minChroma), 0.025), $hue))->toGamut();
    }

    /**
     * The page's tokens in one mode. Nothing is pure white or black: the light
     * page is an off-white in the base colour's tone (cream with stone, cool
     * with slate), the dark page a deep toned grey, and text on fills is the
     * theme's paper or ink.
     *
     * @return array<string, Colour|Mix>
     */
    private function surface(array $base, array $primary, array $secondary, string $mode): array
    {
        $light = $mode === 'light';
        $tone = fn (float $l, int $shade, float $min) => $this->tone($base, $primary, $l, $shade, $min);

        $background = $light ? $tone(0.98, 50, 0.006) : $tone(0.2, 950, 0.012);
        $card = $light ? $this->paper : $tone(0.24, 900, 0.014);
        $muted = $light ? $tone(0.953, 100, 0.008) : $tone(0.255, 900, 0.014);
        $foreground = $light ? $this->ink : $tone(0.95, 50, 0.008);
        $foregrounds = $light ? [$this->paper, $this->ink] : [$this->ink, $this->paper];

        // The primary is a button's fill and the colour of links, so it must
        // read on the page and on a muted band, and carry its own text. A
        // brand colour picked by hand is used as it is wherever it passes.
        $primaryFill = self::firstShade(
            $primary,
            $light ? [600, 700, 800, 900, 950] : [400, 300, 500, 200, 100],
            fn (Colour $c) => $c->contrast($background) >= self::AA
                && $c->contrast($muted) >= self::AA
                && self::readableOn($c, $foregrounds)->contrast($c) >= self::AA,
            $this->picked($light || ! $this->settings['primary_dark'] ? 'primary' : 'primary_dark'),
        );
        // The secondary is a fill only (badges, highlights): near its 500 shade,
        // with whichever text reads on it.
        $secondaryFill = self::firstShade(
            $secondary,
            [500, 400, 600, 300, 700, 200, 800],
            fn (Colour $c) => self::readableOn($c, [$this->paper, $this->ink])->contrast($c) >= self::AA,
            $this->picked('secondary'),
        );
        // Errors, as text on the page and as a fill.
        $red = self::scale('red');
        $destructive = self::firstShade(
            $red,
            $light ? [600, 700, 800] : [400, 300, 200],
            fn (Colour $c) => $c->contrast($background) >= self::AA && $c->contrast($muted) >= self::AA,
        );
        $primaryText = self::readableOn($primaryFill, $foregrounds);
        $secondaryText = self::readableOn($secondaryFill, [$this->paper, $this->ink]);

        return [
            'background' => $background,
            'foreground' => $foreground,
            'card' => $card,
            'card-foreground' => $foreground,
            'muted' => $muted,
            'muted-foreground' => $light ? $base[600] : $base[400],
            'primary' => $primaryFill,
            'primary-foreground' => $primaryText,
            'primary-hover' => $this->hover($primaryFill, $primaryText),
            'secondary' => $secondaryFill,
            'secondary-foreground' => $secondaryText,
            'secondary-hover' => $this->hover($secondaryFill, $secondaryText),
            'destructive' => $destructive,
            'destructive-foreground' => self::readableOn($destructive, $foregrounds),
            'accent' => new Mix($background, $primaryFill, 0.1),
            'accent-foreground' => $foreground,
            'border' => $light ? $tone(0.905, 200, 0.01) : $tone(0.32, 800, 0.014),
            // A field's edge: 3:1 against the page (WCAG 1.4.11).
            'input' => self::firstShade($base, $light ? [400, 500, 600] : [600, 500, 400], fn (Colour $c) => $c->contrast($background) >= self::NON_TEXT && $c->contrast($muted) >= self::NON_TEXT),
            'ring' => $primaryFill,
        ];
    }

    /** A muted band: the page's tokens on the muted background, cards on the page's. */
    private function mutedTone(array $page): array
    {
        return [
            ...$page,
            'background' => $page['muted'],
            'card' => $page['background'],
            'muted' => $page['background'],
            'accent' => new Mix($page['muted'], $page['primary'], 0.12),
        ];
    }

    /**
     * A band in the primary colour: its text in the primary's foreground, and
     * its buttons the other way round.
     */
    private function primaryTone(array $page): array
    {
        $fill = $page['primary'];
        $text = $page['primary-foreground'];
        // Cards and highlights on the band step away from its text (darker
        // under white text), which only adds contrast.
        $away = $text->luminance() > $fill->luminance() ? $this->ink : $this->paper;
        $surface = new Mix($fill, $away, 0.12);

        // Quieter text, as close to the band as AA allows on the band and on
        // its cards.
        $quiet = $text;
        foreach ([0.3, 0.25, 0.2, 0.15, 0.1] as $amount) {
            $candidate = new Mix($text, $fill, $amount);
            if ($candidate->colour()->contrast($fill) >= self::AA && $candidate->colour()->contrast($surface->colour()) >= self::AA) {
                $quiet = $candidate;
                break;
            }
        }

        return [
            ...$page,
            'background' => $fill,
            'foreground' => $text,
            'card' => $surface,
            'card-foreground' => $text,
            'muted' => $surface,
            'muted-foreground' => $quiet,
            'primary' => $text,
            'primary-foreground' => $fill,
            'primary-hover' => $this->hover($text, $fill),
            'accent' => $surface,
            'accent-foreground' => $text,
            // An error on the band is in the band's own text colour.
            'destructive' => $text,
            'destructive-foreground' => $fill,
            'border' => new Mix($fill, $text, 0.25),
            'input' => self::edge($fill, $text),
            'ring' => $text,
        ];
    }

    /**
     * A fill's hover: towards the ink or the paper, whichever adds contrast with its
     * text; for a fill already at the end (a white button), a little towards
     * its text, as far as AA allows.
     */
    private function hover(Colour $fill, Colour $text): Mix
    {
        $away = $text->luminance() > $fill->luminance() ? $this->ink : $this->paper;
        $hover = new Mix($fill, $away, 0.15);
        if (abs($hover->colour()->l - $fill->l) >= 0.03) {
            return $hover;
        }

        foreach ([0.12, 0.1, 0.08, 0.06] as $amount) {
            $towards = new Mix($fill, $text, $amount);
            if ($towards->colour()->contrast($text) >= self::AA) {
                return $towards;
            }
        }

        return $hover;
    }

    /** A field's edge on a band: towards the text until it stands out 3:1. */
    private static function edge(Colour $fill, Colour $text): Mix
    {
        foreach ([0.6, 0.7, 0.8, 0.9] as $amount) {
            if ((new Mix($fill, $text, $amount))->colour()->contrast($fill) >= self::NON_TEXT) {
                return new Mix($fill, $text, $amount);
            }
        }

        return new Mix($fill, $text, 1.0);
    }

    /** Whichever of the candidates reads best on the fill. */
    private static function readableOn(Colour $fill, array $candidates): Colour
    {
        usort($candidates, fn (Colour $a, Colour $b) => $b->contrast($fill) <=> $a->contrast($fill));

        return $candidates[0];
    }

    /**
     * A custom colour exactly as picked (a hex value), or null for a named
     * one, and for pure white or black, which the theme never uses.
     */
    private function picked(string $which): ?Colour
    {
        $value = $this->settings[$which] ?? null;
        $colour = Colour::isHex($value) ? Colour::fromHex($value) : null;

        return $colour && $colour->l > 0.001 && $colour->l < 0.999 ? $colour : null;
    }

    /**
     * The first shade, in order, that passes; failing all, the best of them.
     * A colour given first (a picked brand colour) is tried before the scale.
     */
    private static function firstShade(array $scale, array $order, callable $passes, ?Colour $first = null): Colour
    {
        if ($first && $passes($first)) {
            return $first;
        }

        foreach ($order as $shade) {
            if ($passes($scale[$shade])) {
                return $scale[$shade];
            }
        }

        return $scale[$order[array_key_last($order)]];
    }

    /** Tailwind's average lightness and chroma per shade, over its chromatic colours. */
    private static function ladder(): array
    {
        static $ladder;

        if ($ladder === null) {
            foreach (Options::COLOURS as $name) {
                foreach (Palette::COLOURS[$name] as $shade => [$l, $c]) {
                    $ladder[$shade]['l'][] = $l;
                    $ladder[$shade]['c'][] = $c;
                }
            }
            $ladder = array_map(fn ($v) => ['l' => array_sum($v['l']) / count($v['l']), 'c' => array_sum($v['c']) / count($v['c'])], $ladder);
        }

        return $ladder;
    }

    private static function declarations(array $properties): string
    {
        return implode('', array_map(fn ($name, $value) => "{$name}:{$value};", array_keys($properties), $properties));
    }
}
