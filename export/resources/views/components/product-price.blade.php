{{-- A product's price, the price before a sale crossed out beside it, and its
     note; "Ask for a price" without one. --}}
@props(['entry', 'size' => 'md'])
@php
    use App\Support\Business;

    $price = Business::price($entry->get('price'));
    $before = Business::price($entry->get('compare_at_price'));
    $before = $price && $before && (float) $entry->get('compare_at_price') > (float) $entry->get('price') ? $before : null;
@endphp
<p {{ $attributes->class(['font-semibold', 'text-2xl' => $size === 'lg']) }}>
    {{ $price ?? \App\Support\Labels::get('ask_for_price') }}
    @if ($before)
        <s @class(['text-muted-foreground font-normal', 'text-sm' => $size !== 'lg', 'text-lg' => $size === 'lg'])><span class="sr-only">{{ __('Was') }}</span> {{ $before }}</s>
    @endif
    @if ($price && filled($entry->get('price_note')))
        <span @class(['text-muted-foreground font-normal', 'text-sm' => $size !== 'lg', 'text-base' => $size === 'lg'])>{{ $entry->get('price_note') }}</span>
    @endif
</p>
