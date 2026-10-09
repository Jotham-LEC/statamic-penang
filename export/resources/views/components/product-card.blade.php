{{-- A product in a grid: picture, name, summary and price, the whole card a link. --}}
@props(['entry'])
@php
    use App\Support\Business;

    $image = $entry->augmentedValue('images')->value()?->first();
    $price = Business::price($entry->get('price'));
    $inStock = $entry->get('in_stock') !== false;
@endphp
<article {{ $attributes->class('group bg-card text-card-foreground border-border relative flex flex-col overflow-hidden rounded-lg border shadow-sm') }}>
    <div class="bg-muted aspect-square overflow-hidden">
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
        @if (filled($entry->get('summary')))
            <p class="text-muted-foreground mt-2 line-clamp-2 text-sm">{{ $entry->get('summary') }}</p>
        @endif
        <div class="mt-auto flex items-center justify-between gap-3 pt-4">
            <p class="font-semibold">
                {{ $price ?? __('Ask for a price') }}
                @if ($price && filled($entry->get('price_note')))
                    <span class="text-muted-foreground text-sm font-normal">{{ $entry->get('price_note') }}</span>
                @endif
            </p>
            @unless ($inStock)
                <x-ui.badge variant="muted">{{ __('Out of stock') }}</x-ui.badge>
            @endunless
        </div>
    </div>
</article>
