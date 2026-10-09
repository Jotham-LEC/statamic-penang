<?php

namespace App\Support;

use Statamic\Contracts\Data\Augmentable;
use Statamic\Fields\Value;

/**
 * A link field's value as an address: the field gives a URL as text, or the
 * entry it points to (which keeps working when the entry moves).
 */
final class Link
{
    public static function url(mixed $link): ?string
    {
        if ($link instanceof Value) {
            $link = $link->value();
        }

        if (is_object($link) && method_exists($link, 'url')) {
            return $link->url() ?: null;
        }

        if ($link instanceof Augmentable) {
            return null;
        }

        return is_string($link) && trim($link) !== '' ? trim($link) : null;
    }
}
