{{-- A product's badge: New, Sale (also shown for a price before), or its own. --}}
@props(['entry'])
@php
    $badge = (string) $entry->get('badge');
    $text = match ($badge) {
        'new' => \App\Support\Labels::get('new'),
        'sale' => \App\Support\Labels::get('sale'),
        'custom' => trim((string) $entry->get('badge_text')),
        default => '',
    };
@endphp
@if ($text !== '')
    <x-ui.badge :variant="$badge === 'new' ? 'primary' : 'secondary'" {{ $attributes }}>{{ $text }}</x-ui.badge>
@endif
