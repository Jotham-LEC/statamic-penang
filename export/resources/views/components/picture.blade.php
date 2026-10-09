{{-- An image from the asset library, resized by Glide for each screen
     (srcset), cropped by CSS around the focal point set in the control panel.
     Its alt text is the asset's, unless the caller passes `alt` ("" for a
     decorative picture). Without an image it prints nothing. --}}
@props([
    'image' => null,
    'widths' => [480, 800, 1200, 1600],
    'sizes' => '100vw',
    'alt' => null,
    'eager' => false,
])
@php
    use Statamic\Contracts\Assets\Asset;
    use Statamic\Statamic;

    $image = \Statamic\View\Blade\value($image);
    if ($image instanceof \Illuminate\Support\Collection) {
        $image = $image->first();
    } elseif (is_array($image)) {
        $image = $image[0] ?? null;
    }
@endphp
@if ($image instanceof Asset && ($image->isImage() || $image->isSvg()))
    @php
        $vector = $image->isSvg();
        $widths = collect($widths)->filter(fn ($w) => $vector || ! $image->width() || $w <= $image->width() * 1.1)->whenEmpty(fn ($c) => $c->push($image->width() ?: 800))->values();
        $url = fn (int $w) => Statamic::tag('glide')->params(['src' => $image, 'width' => $w, 'quality' => 80, 'fm' => 'webp'])->fetch();
        [$x, $y] = array_pad(explode('-', (string) ($image->get('focus') ?: '50-50')), 2, 50);
    @endphp
    <img
        src="{{ $vector ? $image->url() : $url($widths->last()) }}"
        @unless ($vector)
            srcset="{{ $widths->map(fn ($w) => $url($w)." {$w}w")->implode(', ') }}"
            sizes="{{ $sizes }}"
        @endunless
        alt="{{ $alt ?? ($image->get('alt') ?? '') }}"
        @if ($image->width() && $image->height())
            width="{{ $image->width() }}"
            height="{{ $image->height() }}"
        @endif
        loading="{{ $eager ? 'eager' : 'lazy' }}"
        @if ($eager) fetchpriority="high" @endif
        decoding="async"
        style="object-position: {{ (float) $x }}% {{ (float) $y }}%"
        {{ $attributes }}
    />
@endif
