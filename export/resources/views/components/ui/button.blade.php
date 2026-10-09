{{-- A button, or a link that looks like one when given an href. --}}
@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])
@php
    $classes = [
        'inline-flex items-center justify-center gap-2 rounded-control font-semibold whitespace-nowrap transition-colors disabled:pointer-events-none disabled:opacity-50',
        match ($variant) {
            'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary-hover',
            'outline' => 'border border-input text-foreground hover:bg-accent hover:text-accent-foreground',
            'ghost' => 'text-foreground hover:bg-accent hover:text-accent-foreground',
            'link' => 'text-primary underline-offset-4 hover:underline',
            default => 'bg-primary text-primary-foreground shadow-sm hover:bg-primary-hover',
        },
        $variant === 'link' ? '' : match ($size) {
            'sm' => 'h-9 px-3.5 text-sm',
            'lg' => 'h-12 px-6 text-base',
            default => 'h-11 px-5 text-sm',
        },
    ];
@endphp
@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>{{ $slot }}</button>
@endif
