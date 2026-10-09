{{-- Where to find the business: a map (OpenStreetMap, from the map position in
     Marketing → Brand → Publisher; loaded only when scrolled to), the
     address and hours, and directions in Google Maps and Waze. --}}
@php
    use App\Support\Business;

    $at = Business::coordinates();
    $address = Business::address();
    $zoom = max(10, min(19, (int) ($block->zoom ?: 16)));
    if ($at) {
        $span = 180 / (2 ** $zoom) * 1.6;
        $bbox = implode(',', [$at['lng'] - $span, $at['lat'] - $span / 2, $at['lng'] + $span, $at['lat'] + $span / 2]);
        $map = 'https://www.openstreetmap.org/export/embed.html?'.http_build_query(['bbox' => $bbox, 'layer' => 'mapnik', 'marker' => $at['lat'].','.$at['lng']]);
        $google = 'https://www.google.com/maps/search/?'.http_build_query(['api' => 1, 'query' => $at['lat'].','.$at['lng']]);
        $waze = 'https://waze.com/ul?'.http_build_query(['ll' => $at['lat'].','.$at['lng'], 'navigate' => 'yes']);
    } elseif ($address) {
        $google = 'https://www.google.com/maps/search/?'.http_build_query(['api' => 1, 'query' => $address]);
    }
@endphp
@if ($at || $address)
    <x-section :block="$block">
        <div class="grid gap-12 lg:grid-cols-3 lg:gap-16">
            <div>
                <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
                <x-contact-details :hours="(bool) $block->show_hours" class="mt-10" />
                <div class="mt-8 flex flex-wrap gap-3">
                    @isset($google)
                        <x-ui.button :href="$google" variant="outline" size="sm" target="_blank" rel="noopener">
                            <x-icon name="navigation" class="size-4" /> Google Maps
                        </x-ui.button>
                    @endisset
                    @isset($waze)
                        <x-ui.button :href="$waze" variant="outline" size="sm" target="_blank" rel="noopener">
                            <x-icon name="navigation" class="size-4" /> Waze
                        </x-ui.button>
                    @endisset
                </div>
            </div>
            @if ($at)
                <div class="border-border bg-muted overflow-hidden rounded-xl border lg:col-span-2">
                    <iframe
                        src="{{ $map }}"
                        title="{{ __('Map showing :name', ['name' => Business::name()]) }}"
                        class="aspect-4/3 w-full lg:aspect-auto lg:h-full lg:min-h-96"
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                </div>
            @endif
        </div>
    </x-section>
@endif
