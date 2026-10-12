{{-- A testimonial's stars and where it was left (Google, Facebook…). --}}
@props(['quote'])
@php
    $rating = max(0, min(5, (int) (string) $quote->rating));
    $source = (string) $quote->source;
    $sources = ['google' => 'Google', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'tripadvisor' => 'Tripadvisor', 'shopee' => 'Shopee', 'grab' => 'Grab', 'foodpanda' => 'foodpanda'];
@endphp
@if ($rating || isset($sources[$source]))
    <div {{ $attributes->class('flex items-center gap-3') }}>
        @if ($rating)
            <span
                class="text-primary flex gap-0.5"
                role="img"
                aria-label="{{ __(':count out of 5 stars', ['count' => $rating]) }}"
            >
                @for ($i = 0; $i < $rating; $i++)
                    <x-icon name="star" class="size-4 fill-current" />
                @endfor
            </span>
        @endif
        @if (isset($sources[$source]))
            <span class="text-muted-foreground inline-flex items-center gap-1.5 text-xs">
                <x-icon :name="'brands/'.$source" class="size-3.5 fill-current" />
                {{ __('On :source', ['source' => $sources[$source]]) }}
            </span>
        @endif
    </div>
@endif
