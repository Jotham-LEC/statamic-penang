<?php

namespace App\Providers;

use App\Boost\Tools\PenangSections;
use App\Boost\Tools\PenangThemeCheck;
use App\Support\Excerpt;
use Illuminate\Support\ServiceProvider;
use Laravel\Boost\BoostServiceProvider;
use Statamic\Facades\Collection;

/**
 * Penang's additions to Statamic, registered in bootstrap/app.php: the
 * words of a page's sections, for site search, and, with Laravel Boost
 * installed, Penang's read-only tools for AI coding agents.
 */
class PenangServiceProvider extends ServiceProvider
{
    /** Penang's tools for Laravel Boost's MCP server, named so as not to clash with Boost's or the Marketing Toolkit's. */
    public const BOOST_TOOLS = [PenangThemeCheck::class, PenangSections::class];

    public function boot(): void
    {
        if (class_exists(BoostServiceProvider::class) && config('penang.boost_tools', true)) {
            config(['boost.mcp.tools.include' => array_values(array_unique([...(array) config('boost.mcp.tools.include', []), ...self::BOOST_TOOLS]))]);
        }

        // A page's words for site search (config/statamic/search.php): the
        // headings and text of its sections, as plain text. Bard keeps its
        // words as `text` nodes, which the walk collects.
        Collection::computed('pages', 'search_text', function ($entry) {
            $words = [];
            $blocks = (array) $entry->value('blocks');
            array_walk_recursive($blocks, function ($value, $key) use (&$words) {
                if (is_string($value) && in_array($key, ['heading', 'eyebrow', 'intro', 'text', 'title', 'question', 'answer', 'quote', 'label', 'name', 'value', 'description'], true)) {
                    $words[] = $value;
                }
            });

            return Excerpt::plain(implode(' ', $words));
        });
    }
}
