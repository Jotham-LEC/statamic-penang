{{-- A product in a grid: picture, name, summary and price, the whole card a link. --}}
@props(['entry'])
@php
    $image = $entry->augmentedValue('images')->value()?->first();
    $inStock = $entry->get('in_stock') !== false;
    $summary = \App\Support\Excerpt::of($entry, 'summary');
@endphp
<article {{ $attributes->class('group bg-card text-card-foreground border-border relative flex flex-col overflow-hidden rounded-lg border shadow-sm') }}>
    <div class="bg-muted relative aspect-square overflow-hidden">
        <x-product-badge :entry="$entry" class="absolute top-3 left-3 z-10" />
        @if ($image)
            <x-picture
                :image="$image"
                :widths="[400, 600, 800]"
                sizes="(min-width: 1024px) 25vw, (min-width: 640px) 50vw, 100vw"
                class="size-full object-cover transition-transform duration-300 group-hover:scale-105"
                alt=""
            />
        @endif
    </div>
    <div class="flex flex-1 flex-col p-5">
        <h3 class="text-lg font-semibold">
            <a href="{{ $entry->url() }}" class="after:absolute after:inset-0">{{ $entry->get('title') }}</a>
        </h3>
        @if ($summary)
            <p class="text-muted-foreground mt-2 line-clamp-2 text-sm">{{ $summary }}</p>
        @endif
        <div class="mt-auto flex items-center justify-between gap-3 pt-4">
            <x-product-price :entry="$entry" />
            @unless ($inStock)
                <x-ui.badge variant="muted">{{ \App\Support\Labels::get('out_of_stock') }}</x-ui.badge>
            @endunless
        </div>
    </div>
</article>
