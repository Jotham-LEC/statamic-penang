<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site;

/**
 * The business's details, entered once: name, phone, email, address, opening
 * hours, map position and social profiles from the Marketing Toolkit's Brand
 * global (its Publisher tab, `config('marketing-toolkit.global')`), and the
 * WhatsApp number from the Site settings global. The header, footer, contact
 * and map sections all read them here.
 */
final class Business
{
    private const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public static function name(): string
    {
        return self::brand('publisher_name') ?: Site::current()->name();
    }

    public static function logo(): mixed
    {
        $logo = GlobalSet::findByHandle(config('marketing-toolkit.global', 'seo'))?->inCurrentSite()?->augmentedValue('publisher_logo')?->value();

        return $logo instanceof Collection ? $logo->first() : $logo;
    }

    public static function phone(): ?string
    {
        return self::brand('telephone') ?: null;
    }

    public static function phoneHref(): ?string
    {
        $phone = self::phone();

        return $phone ? 'tel:'.preg_replace('/[^\d+]/', '', $phone) : null;
    }

    public static function email(): ?string
    {
        return self::brand('email') ?: null;
    }

    /** @return list<string> the address, one line each, empty lines left out */
    public static function addressLines(): array
    {
        $town = trim(implode(' ', array_filter([self::brand('postal_code'), self::brand('address_locality')])));

        return array_values(array_filter([
            self::brand('street_address'),
            $town,
            self::brand('address_region'),
        ]));
    }

    public static function address(): string
    {
        return implode(', ', self::addressLines());
    }

    /** @return array{lat: float, lng: float}|null */
    public static function coordinates(): ?array
    {
        [$lat, $lng] = [self::brand('latitude'), self::brand('longitude')];

        if (! is_numeric($lat) || ! is_numeric($lng) || abs((float) $lat) > 90 || abs((float) $lng) > 180) {
            return null;
        }

        return ['lat' => (float) $lat, 'lng' => (float) $lng];
    }

    /**
     * Opening hours as rows a visitor reads: consecutive days with the same
     * hours become a range ("Monday – Friday"), and the days with no row are
     * listed as closed.
     *
     * @return list<array{days: string, hours: string}>
     */
    public static function hours(): array
    {
        $rows = GlobalSet::findByHandle(config('marketing-toolkit.global', 'seo'))?->inCurrentSite()?->get('opening_hours') ?? [];

        $byDay = [];
        foreach ($rows as $row) {
            if (empty($row['opens']) || empty($row['closes'])) {
                continue;
            }
            foreach ((array) ($row['days'] ?? []) as $day) {
                $byDay[$day] = self::time($row['opens']).' – '.self::time($row['closes']);
            }
        }

        if ($byDay === []) {
            return [];
        }

        $groups = [];
        foreach (self::DAYS as $day) {
            $hours = $byDay[$day] ?? 'Closed';
            $last = array_key_last($groups);
            if ($last !== null && $groups[$last]['hours'] === $hours) {
                $groups[$last]['to'] = $day;
            } else {
                $groups[] = ['from' => $day, 'to' => $day, 'hours' => $hours];
            }
        }

        return array_map(fn ($g) => [
            'days' => $g['from'] === $g['to'] ? __($g['from']) : __($g['from']).' – '.__($g['to']),
            'hours' => $g['hours'] === 'Closed' ? __('Closed') : $g['hours'],
        ], $groups);
    }

    /** @return list<array{url: string, label: string, icon: string}> */
    public static function socialLinks(): array
    {
        $known = [
            'facebook.com' => ['Facebook', 'brands/facebook'],
            'instagram.com' => ['Instagram', 'brands/instagram'],
            'tiktok.com' => ['TikTok', 'brands/tiktok'],
            'youtube.com' => ['YouTube', 'brands/youtube'],
            'x.com' => ['X', 'brands/x'],
            'twitter.com' => ['X', 'brands/x'],
            'threads.net' => ['Threads', 'brands/threads'],
            'threads.com' => ['Threads', 'brands/threads'],
            'shopee.com.my' => ['Shopee', 'brands/shopee'],
            'linkedin.com' => ['LinkedIn', 'ui/external-link'],
        ];

        $links = [];
        foreach ((array) (GlobalSet::findByHandle(config('marketing-toolkit.global', 'seo'))?->inCurrentSite()?->get('same_as') ?? []) as $url) {
            if (! is_string($url) || ! preg_match('#^https?://#i', $url)) {
                continue;
            }
            $host = preg_replace('/^www\./', '', (string) parse_url($url, PHP_URL_HOST));
            [$label, $icon] = $known[$host] ?? [$host, 'ui/external-link'];
            $links[] = ['url' => $url, 'label' => $label, 'icon' => $icon];
        }

        return $links;
    }

    /** The WhatsApp chat link, from the Site settings global; null without a number. */
    public static function whatsappUrl(?string $message = null): ?string
    {
        $settings = GlobalSet::findByHandle('settings')?->inCurrentSite();
        $number = preg_replace('/\D/', '', (string) $settings?->get('whatsapp_number'));

        if (strlen($number) < 8) {
            return null;
        }

        $message ??= (string) $settings?->get('whatsapp_message');

        return 'https://wa.me/'.$number.($message !== '' ? '?text='.rawurlencode($message) : '');
    }

    /** A price as the shop's currency writes it: "RM 45.00", from Marketing → Brand → Shop. */
    public static function price(mixed $amount): ?string
    {
        if (! is_numeric($amount) || (float) $amount <= 0) {
            return null;
        }

        $code = strtoupper(self::brand('currency') ?: 'MYR');
        $symbol = ['MYR' => 'RM', 'SGD' => 'S$', 'USD' => 'US$', 'AUD' => 'A$', 'GBP' => '£', 'EUR' => '€', 'IDR' => 'Rp', 'THB' => '฿'][$code] ?? $code;

        return $symbol.' '.number_format((float) $amount, 2);
    }

    private static function brand(string $key): string
    {
        $value = GlobalSet::findByHandle(config('marketing-toolkit.global', 'seo'))?->inCurrentSite()?->get($key);

        return is_string($value) ? trim($value) : '';
    }

    private static function time(string $time): string
    {
        $parsed = \DateTimeImmutable::createFromFormat('H:i', substr($time, 0, 5));

        return $parsed ? strtolower($parsed->format('g:i a')) : $time;
    }
}
