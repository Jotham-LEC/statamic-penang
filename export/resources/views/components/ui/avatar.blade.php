{{-- A round photo, or the person's initials when there is none. --}}
@props(['image' => null, 'name' => '', 'size' => 'md'])
@php
    $sizes = match ($size) {
        'sm' => 'size-10 text-sm',
        'lg' => 'size-24 text-2xl',
        default => 'size-14 text-base',
    };
    $initials = collect(preg_split('/\s+/', trim($name)))->filter()->take(2)->map(fn ($part) => mb_substr($part, 0, 1))->implode('');
@endphp
@if ($image)
    <x-picture
        :image="$image"
        :widths="[96, 192]"
        sizes="96px"
        :class="$sizes.' shrink-0 rounded-full object-cover '.$attributes->get('class')"
        alt=""
    />
@else
    <span
        {{ $attributes->class(["{$sizes} bg-muted text-muted-foreground inline-flex shrink-0 items-center justify-center rounded-full font-semibold"]) }}
        aria-hidden="true"
    >{{ $initials }}</span>
@endif
