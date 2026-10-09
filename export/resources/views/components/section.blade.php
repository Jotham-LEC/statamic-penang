{{-- A page-builder section: its tone (data-tone sets the theme's tokens for
     everything inside), spacing and anchor, around a centred container. --}}
@props(['block' => null, 'tone' => null, 'spacing' => null, 'width' => 'max-w-7xl', 'as' => 'section'])
@php
    $tone = (string) ($tone ?? $block?->tone ?? 'default') ?: 'default';
    $spacing = (string) ($spacing ?? $block?->spacing ?? 'normal') ?: 'normal';
    $anchor = $block?->anchor;
@endphp
<{{ $as }}
    @if ($tone !== 'default') data-tone="{{ $tone }}" @endif
    @if ($anchor) id="{{ $anchor }}" @endif
    {{
        $attributes->class([
            'bg-background text-foreground scroll-mt-20',
            match ($spacing) {
                'compact' => 'py-10 sm:py-12',
                'roomy' => 'py-20 sm:py-32',
                default => 'py-16 sm:py-24',
            },
        ])
    }}
>
    <div class="{{ $width }} mx-auto px-4 sm:px-6 lg:px-8">{{ $slot }}</div>
</{{ $as }}>
