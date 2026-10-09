{{-- A person from the Team collection: a portrait card, or a small photo. --}}
@props(['entry', 'layout' => 'cards'])
@php
    $photo = $entry->augmentedValue('photo')->value();
    $profile = \App\Support\Link::url($entry->augmentedValue('profile'));
    $name = (string) $entry->get('title');
@endphp
@if ($layout === 'compact')
    <div {{ $attributes->class('flex items-center gap-4') }}>
        <x-ui.avatar :image="$photo" :name="$name" />
        <div>
            <h3 class="font-semibold">{{ $name }}</h3>
            <p class="text-muted-foreground text-sm">{{ $entry->get('role') }}</p>
        </div>
    </div>
@else
    <div {{ $attributes }}>
        <div class="bg-muted aspect-4/5 overflow-hidden rounded-lg">
            @if ($photo)
                <x-picture
                    :image="$photo"
                    :widths="[400, 600, 800]"
                    sizes="(min-width: 1024px) 25vw, 50vw"
                    class="size-full object-cover"
                    alt=""
                />
            @else
                <div class="flex size-full items-center justify-center">
                    <x-ui.avatar :name="$name" size="lg" />
                </div>
            @endif
        </div>
        <h3 class="mt-5 text-lg font-semibold">
            @if ($profile)
                <a href="{{ $profile }}" class="hover:underline hover:underline-offset-4" rel="noopener">{{ $name }}</a>
            @else
                {{ $name }}
            @endif
        </h3>
        <p class="text-primary text-sm font-medium">{{ $entry->get('role') }}</p>
        @if (filled($entry->get('bio')))
            <p class="text-muted-foreground mt-3 text-sm leading-relaxed">{{ $entry->get('bio') }}</p>
        @endif
    </div>
@endif
