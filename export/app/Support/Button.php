<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Statamic\Contracts\Assets\Asset;
use Statamic\Fields\Value;
use Statamic\Fields\Values;

/**
 * Where a button of the `buttons` fieldset goes, by its type: a page or
 * address, WhatsApp (the Site settings number), a phone call, an email or a
 * file. Null when there is nowhere to go, and the button is left out.
 */
final class Button
{
    /** @return array{href: string, new_tab: bool, icon: string|null}|null */
    public static function target(mixed $button): ?array
    {
        $get = fn (string $key) => self::plain($button instanceof Values ? $button->{$key} : ($button[$key] ?? null));
        // A button group's value is a LabeledValue: its string is the option.
        $text = fn (string $key) => is_scalar($value = $get($key)) || $value instanceof \Stringable ? trim((string) $value) : '';

        $href = match ($text('type') ?: 'link') {
            'whatsapp' => Business::whatsappUrl($text('whatsapp_message') ?: null),
            'phone' => $text('phone') !== '' ? 'tel:'.preg_replace('/[^\d+]/', '', $text('phone')) : Business::phoneHref(),
            'email' => ($email = $text('email') ?: Business::email()) ? 'mailto:'.$email : null,
            'file' => self::file($button instanceof Values ? $button->file : ($button['file'] ?? null)),
            default => Link::url($button instanceof Values ? $button->link : ($button['link'] ?? null)),
        };

        if (! $href) {
            return null;
        }

        return [
            'href' => $href,
            'new_tab' => match ($text('type') ?: 'link') {
                'whatsapp' => true,
                'link', 'file' => (bool) $get('new_tab'),
                default => false,
            },
            'icon' => match ($text('type')) {
                'whatsapp' => 'brands/whatsapp',
                'phone' => 'phone',
                'email' => 'mail',
                'file' => 'download',
                default => null,
            },
        ];
    }

    private static function file(mixed $file): ?string
    {
        $file = self::plain($file);
        $file = $file instanceof Collection ? $file->first() : (is_array($file) ? ($file[0] ?? null) : $file);

        return $file instanceof Asset ? $file->url() : null;
    }

    private static function plain(mixed $value): mixed
    {
        return $value instanceof Value ? $value->value() : $value;
    }
}
