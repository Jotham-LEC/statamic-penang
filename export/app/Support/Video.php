<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Statamic\Contracts\Assets\Asset;
use Statamic\Fields\Value;

/**
 * A video's player address, from a YouTube or Vimeo link (any of the forms
 * their Share buttons and address bars give) or an uploaded file. YouTube
 * plays from youtube-nocookie.com, which sets no cookies until played.
 */
final class Video
{
    /** @return array{type: 'embed'|'file', src: string}|null */
    public static function player(string $source, string $url, mixed $file = null): ?array
    {
        if ($source === 'file') {
            $file = $file instanceof Value ? $file->value() : $file;
            $file = $file instanceof Collection ? $file->first() : $file;

            return $file instanceof Asset ? ['type' => 'file', 'src' => $file->url()] : null;
        }

        $url = trim($url);
        if ($source === 'vimeo' && preg_match('#vimeo\.com/(?:video/|channels/[\w-]+/|groups/[\w-]+/videos/)?(\d+)#', $url, $m)) {
            return ['type' => 'embed', 'src' => "https://player.vimeo.com/video/{$m[1]}?autoplay=1&dnt=1"];
        }
        if ($source === 'youtube' && preg_match('#(?:youtu\.be/|youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/|v/))([\w-]{11})#', $url, $m)) {
            return ['type' => 'embed', 'src' => "https://www.youtube-nocookie.com/embed/{$m[1]}?autoplay=1&rel=0"];
        }

        return null;
    }
}
