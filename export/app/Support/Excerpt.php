<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Card text for an entry: its summary as written, or else the start of its
 * body (Bard or Markdown) as plain text, cut at a word.
 */
final class Excerpt
{
    public static function of(mixed $entry, string $summary, string $body = 'content', int $words = 30): ?string
    {
        $written = trim((string) $entry->get($summary));
        if ($written !== '') {
            return $written;
        }

        $html = (string) $entry->augmentedValue($body);
        // Block ends become spaces, so "Heading" and "Text" don't run together.
        $text = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags(preg_replace('#</(p|h\d|li|blockquote)>|<br\s*/?>#i', ' ', $html)), ENT_QUOTES | ENT_HTML5)));

        return $text === '' ? null : Str::words($text, $words, '…');
    }

    /** A stored Bard value (its nodes) or a plain string, as plain text. */
    public static function plain(mixed $value): ?string
    {
        $text = is_array($value) ? self::nodeText($value) : strip_tags((string) $value);
        $text = trim(preg_replace('/\s+/u', ' ', $text));

        return $text === '' ? null : $text;
    }

    private static function nodeText(array $nodes): string
    {
        return collect($nodes)->map(fn ($node) => match (true) {
            ! is_array($node) => '',
            ($node['type'] ?? null) === 'text' => (string) ($node['text'] ?? ''),
            ($node['type'] ?? null) === 'hardBreak' => ' ',
            default => self::nodeText($node['content'] ?? []).' ',
        })->implode('');
    }
}
