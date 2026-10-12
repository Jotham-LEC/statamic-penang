<?php

namespace App\Support;

use Statamic\Facades\GlobalSet;

/**
 * The wording the templates write themselves (links, badges, buttons), which
 * editors can change under Globals → Site settings → Labels. A label left
 * empty is the default here, translated (lang/{locale}.json).
 */
final class Labels
{
    /** The Labels tab's sections, each label's key and its default. */
    public const GROUPS = [
        'Products' => [
            'all_products' => 'All products',
            'all_categories' => 'All',
            'ask_for_price' => 'Ask for a price',
            'out_of_stock' => 'Out of stock',
            'ask_on_whatsapp' => 'Ask on WhatsApp',
            'send_enquiry' => 'Send an enquiry',
            'related_products' => 'You may also like',
            'from_price' => 'From :price',
            'new' => 'New',
            'sale' => 'Sale',
            'details' => 'Details',
            'featured_in' => 'Featured: :category',
            'see_all' => 'See all',
        ],
        'Blog' => [
            'all_articles' => 'All articles',
            'more_articles' => 'More articles',
        ],
        'Search' => [
            'search' => 'Search',
            'search_placeholder' => 'What are you looking for?',
            'no_results' => 'Nothing found for “:query”.',
        ],
        'Breadcrumbs and legal pages' => [
            'home' => 'Home',
            'contents' => 'Contents',
        ],
        'WhatsApp' => [
            'whatsapp' => 'Chat on WhatsApp',
        ],
        'Menus' => [
            'menu' => 'Menu',
            'close_menu' => 'Close menu',
            'footer_links' => 'Explore',
            'footer_contact' => 'Contact',
        ],
        'Page not found' => [
            'not_found_title' => 'Page not found',
            'not_found_text' => 'The page you’re looking for has moved or no longer exists.',
            'not_found_home' => 'Go to the home page',
            'not_found_contact' => 'Contact us',
        ],
    ];

    public static function get(string $key): string
    {
        $value = GlobalSet::findByHandle('settings')?->inCurrentSite()?->get('label_'.$key);

        return is_string($value) && trim($value) !== '' ? trim($value) : __(self::defaults()[$key] ?? $key);
    }

    /** @return array<string, string> */
    public static function defaults(): array
    {
        return array_merge(...array_values(self::GROUPS));
    }
}
