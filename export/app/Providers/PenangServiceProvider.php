<?php

namespace App\Providers;

use App\Support\Excerpt;
use Illuminate\Support\ServiceProvider;
use Statamic\Facades\Collection;

/**
 * Penang's additions to Statamic, registered in bootstrap/app.php: the
 * words of a page's sections, for site search.
 */
class PenangServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
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
