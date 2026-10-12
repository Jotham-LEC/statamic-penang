<?php

namespace App\Boost\Tools;

use App\Theme\Colour;
use App\Theme\Mix;
use App\Theme\Options;
use App\Theme\Theme;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

/**
 * A Laravel Boost tool for Penang (registered by App\Providers\PenangServiceProvider when Boost
 * is installed): checks a theme preset, or one proposed for a client's brand, as the site would
 * draw it. It reads only; a preset is added by hand to app/Theme/Options.php.
 */
#[IsReadOnly]
class PenangThemeCheck extends Tool
{
    protected string $description = 'Check a Penang theme preset, or a proposed one for a client\'s brand, before adding it to app/Theme/Options.php: every text colour against WCAG AA in each section background and in light and dark mode, the colours the site will actually use (a hex brand colour is kept exactly where it reads, else stepped to a shade of itself), and the preset entry to paste. Give an existing `preset`, or the settings of a new one.';

    public function schema(JsonSchema $schema): array
    {
        return [
            'preset' => $schema->string()->description('An existing preset to check ('.implode(', ', array_keys(Options::PRESETS)).'), or the one the settings below start from.'),
            'heading_font' => $schema->string()->description('A font key for headings: '.implode(', ', array_keys(Options::FONTS)).'.'),
            'body_font' => $schema->string()->description('A font key for text.'),
            'radius' => $schema->string()->description('Corners: '.implode(', ', array_keys(Options::RADII)).'.'),
            'base' => $schema->string()->description('The greys: '.implode(', ', array_keys(Options::BASES)).'.'),
            'primary' => $schema->string()->description('Buttons and links: a Tailwind colour name ('.implode(', ', Options::COLOURS).') or a hex value such as #5a2850.'),
            'secondary' => $schema->string()->description('Badges and highlights: a colour name or a hex value.'),
            'primary_dark' => $schema->string()->description('Optional: dark mode\'s primary, a hex value, where the primary would only turn pale in the dark.'),
        ];
    }

    public function handle(Request $request): Response
    {
        $given = array_filter($request->all(), fn ($value) => is_string($value) && $value !== '');
        $ignored = array_keys(array_filter($given, fn ($value, $key) => in_array($key, Options::SETTINGS, true) && ! Theme::valid($key, $value), ARRAY_FILTER_USE_BOTH));
        $theme = new Theme($given);
        $hex = fn (Colour|Mix $c) => ($c instanceof Mix ? $c->colour() : $c)->hex();
        $palette = $theme->palette()['default'];
        $settings = $theme->settings;

        $used = [];
        foreach (['light', 'dark'] as $mode) {
            foreach (['background', 'foreground', 'muted-foreground', 'primary', 'primary-foreground', 'secondary', 'secondary-foreground', 'border'] as $token) {
                $used[$mode][$token] = $hex($palette[$mode][$token]);
            }
        }

        $entry = array_filter([
            'label' => 'Client name',
            'heading_font' => $settings['heading_font'],
            'body_font' => $settings['body_font'],
            'radius' => $settings['radius'],
            'base' => $settings['base'],
            'primary' => $settings['primary'],
            'secondary' => $settings['secondary'],
            'primary_dark' => $settings['primary_dark'],
        ]);

        return Response::json([
            'readable' => $theme->contrastFailures() === [],
            'contrast_failures' => $theme->contrastFailures(),
            'ignored_settings' => $ignored,
            'settings' => $settings,
            'colours_used' => $used,
            // A picked brand colour is used exactly where it reads: say where it isn't.
            'exact_brand_colours' => collect(['primary', 'secondary'])
                ->filter(fn ($key) => Colour::isHex($settings[$key]))
                ->mapWithKeys(fn ($key) => [$key => [
                    'light' => strtolower($settings[$key]) === $used['light'][$key],
                    'dark' => strtolower($settings[$key === 'primary' && $settings['primary_dark'] ? 'primary_dark' : $key]) === $used['dark'][$key],
                ]])->all(),
            'preset_entry' => "'client' => ".var_export($entry, true).',',
            'next_steps' => 'Add the entry to PRESETS in app/Theme/Options.php (a short handle as its key), add the handle to the Preset options in resources/blueprints/globals/theme.yaml, choose it under Globals → Theme, and look at /components in light and dark.',
        ]);
    }
}
