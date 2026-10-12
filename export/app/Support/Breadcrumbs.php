<?php

namespace App\Support;

use Statamic\Contracts\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Statamic\Structures\Page;

/**
 * The trail to a page, as the Marketing Toolkit builds its BreadcrumbList:
 * home, each published entry at a parent of the page's address, then the
 * page. A visitor sees the same trail search engines read.
 */
final class Breadcrumbs
{
    /** @return list<array{title: string, url: string}> */
    public static function trail(mixed $content): array
    {
        $content = $content instanceof Page ? $content->entry() : $content;
        if (! $content || ! method_exists($content, 'uri') || ! $content->uri() || $content->uri() === '/') {
            return [];
        }

        $trail = [['title' => Labels::get('home'), 'url' => '/']];
        $segments = array_values(array_filter(explode('/', (string) $content->uri())));
        $site = method_exists($content, 'locale') ? $content->locale() : null;
        $path = '';

        foreach (array_slice($segments, 0, -1) as $segment) {
            $path .= '/'.$segment;
            $ancestor = Entries::findByUri($path, $site);
            $ancestor = $ancestor instanceof Page ? $ancestor->entry() : $ancestor;
            if ($ancestor instanceof Entry && $ancestor->status() === 'published') {
                $trail[] = ['title' => (string) $ancestor->value('title'), 'url' => $ancestor->url()];
            }
        }

        $trail[] = ['title' => (string) ($content->value('title') ?? $content->title()), 'url' => $content->url()];

        return $trail;
    }
}
