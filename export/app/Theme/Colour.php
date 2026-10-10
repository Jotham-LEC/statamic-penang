<?php

namespace App\Theme;

/**
 * A colour in OKLCH (lightness 0–1, chroma, hue in degrees), with the sums the
 * theme needs: WCAG contrast, mixing as CSS's color-mix(in oklab) does, and
 * reading a hex value an editor picks.
 */
final readonly class Colour
{
    public function __construct(
        public float $l,
        public float $c,
        public float $h,
    ) {}

    /** @param  array{0: float, 1: float, 2: float}  $lch */
    public static function lch(array $lch): self
    {
        return new self(...$lch);
    }

    public static function white(): self
    {
        return new self(1, 0, 0);
    }

    public static function black(): self
    {
        return new self(0, 0, 0);
    }

    public static function fromHex(string $hex): self
    {
        $hex = ltrim(trim($hex), '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        [$r, $g, $b] = array_map(
            fn (string $pair) => self::toLinear(hexdec($pair) / 255),
            str_split(substr(str_pad($hex, 6, '0'), 0, 6), 2),
        );

        // Linear sRGB → OKLab (Björn Ottosson's matrices).
        $l = 0.4122214708 * $r + 0.5363325363 * $g + 0.0514459929 * $b;
        $m = 0.2119034982 * $r + 0.6806995451 * $g + 0.1073969566 * $b;
        $s = 0.0883024619 * $r + 0.2817188376 * $g + 0.6299787005 * $b;
        [$l, $m, $s] = [self::cbrt($l), self::cbrt($m), self::cbrt($s)];

        $L = 0.2104542553 * $l + 0.7936177850 * $m - 0.0040720468 * $s;
        $a = 1.9779984951 * $l - 2.4285922050 * $m + 0.4505937099 * $s;
        $bb = 0.0259040371 * $l + 0.7827717662 * $m - 0.8086757660 * $s;

        $c = sqrt($a * $a + $bb * $bb);
        $h = $c < 0.0001 ? 0.0 : fmod(rad2deg(atan2($bb, $a)) + 360, 360);

        return new self(round($L, 4), round($c, 4), round($h, 3));
    }

    public static function isHex(?string $value): bool
    {
        return is_string($value) && preg_match('/^#?([0-9a-f]{3}|[0-9a-f]{6})$/i', trim($value)) === 1;
    }

    /** Linear-light sRGB, unclamped: a channel outside 0–1 is out of gamut. */
    public function linearRgb(): array
    {
        $a = $this->c * cos(deg2rad($this->h));
        $b = $this->c * sin(deg2rad($this->h));

        $l = ($this->l + 0.3963377774 * $a + 0.2158037573 * $b) ** 3;
        $m = ($this->l - 0.1055613458 * $a - 0.0638541728 * $b) ** 3;
        $s = ($this->l - 0.0894841775 * $a - 1.2914855480 * $b) ** 3;

        return [
            4.0767416621 * $l - 3.3077115913 * $m + 0.2309699292 * $s,
            -1.2684380046 * $l + 2.6097574011 * $m - 0.3413193965 * $s,
            -0.0041960863 * $l - 0.7034186147 * $m + 1.7076147010 * $s,
        ];
    }

    public function inGamut(): bool
    {
        foreach ($this->linearRgb() as $channel) {
            if ($channel < -0.0001 || $channel > 1.0001) {
                return false;
            }
        }

        return true;
    }

    /** The same lightness and hue with as much of the chroma as sRGB can show. */
    public function toGamut(): self
    {
        if ($this->inGamut()) {
            return $this;
        }

        [$low, $high] = [0.0, $this->c];
        for ($i = 0; $i < 20; $i++) {
            $mid = ($low + $high) / 2;
            (new self($this->l, $mid, $this->h))->inGamut() ? $low = $mid : $high = $mid;
        }

        return new self($this->l, round($low, 4), $this->h);
    }

    /**
     * WCAG 2 relative luminance, of the colour as an sRGB screen shows it:
     * Tailwind's palette reaches into Display P3, and browsers bring such a
     * colour into sRGB by lowering its chroma, keeping its lightness.
     */
    public function luminance(): float
    {
        [$r, $g, $b] = array_map(fn (float $v) => min(1, max(0, $v)), $this->toGamut()->linearRgb());

        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    }

    public function contrast(self $other): float
    {
        [$light, $dark] = [max($this->luminance(), $other->luminance()), min($this->luminance(), $other->luminance())];

        return ($light + 0.05) / ($dark + 0.05);
    }

    /**
     * $this with $amount (0–1) of $other, as `color-mix(in oklab, this, other
     * amount)` does: lightness and the two colour axes each interpolated, so
     * a little green in an off-white is a green tint, whatever the hues.
     */
    public function mix(self $other, float $amount): self
    {
        [$a1, $b1] = [$this->c * cos(deg2rad($this->h)), $this->c * sin(deg2rad($this->h))];
        [$a2, $b2] = [$other->c * cos(deg2rad($other->h)), $other->c * sin(deg2rad($other->h))];
        $a = $a1 + ($a2 - $a1) * $amount;
        $b = $b1 + ($b2 - $b1) * $amount;
        $c = sqrt($a * $a + $b * $b);

        return new self(
            $this->l + ($other->l - $this->l) * $amount,
            $c,
            $c < 0.0001 ? 0.0 : fmod(rad2deg(atan2($b, $a)) + 360, 360),
        );
    }

    /**
     * A grey's hue is written `none`, "missing", as CSS writes a colour
     * without one.
     */
    public function css(): string
    {
        $hue = $this->c < 0.0001 ? 'none' : self::number($this->h, 2);

        return sprintf('oklch(%s%% %s %s)', self::number($this->l * 100, 2), self::number($this->c, 4), $hue);
    }

    private static function number(float $value, int $decimals): string
    {
        return rtrim(rtrim(number_format($value, $decimals, '.', ''), '0'), '.') ?: '0';
    }

    private static function toLinear(float $channel): float
    {
        return $channel <= 0.04045 ? $channel / 12.92 : (($channel + 0.055) / 1.055) ** 2.4;
    }

    private static function cbrt(float $value): float
    {
        return $value < 0 ? -((-$value) ** (1 / 3)) : $value ** (1 / 3);
    }
}
