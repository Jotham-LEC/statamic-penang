{{-- A blog article in a grid or a list. --}}
@props(['entry', 'layout' => 'card'])
@php
    $image = $entry->augmentedValue('image')->value();
    $date = $entry->date();
    $excerpt = \App\Support\Excerpt::of($entry, 'excerpt');
@endphp
<article {{
    $attributes->class([
        'group relative flex',
        'flex-col' => $layout === 'card',
        'flex-col gap-5 sm:flex-row sm:items-start sm:gap-8' => $layout === 'list',
    ])
}}>
    @if ($image)
        <div @class(['bg-muted overflow-hidden rounded-lg', 'aspect-16/10' => $layout === 'card', 'aspect-16/10 sm:w-64 sm:shrink-0' => $layout === 'list'])>
            <x-picture
                :image="$image"
                :widths="[400, 600, 800]"
                sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
                class="size-full object-cover transition-transform duration-300 group-hover:scale-105"
                alt=""
            />
        </div>
    @endif
    <div @class(['mt-5' => $image && $layout === 'card'])>
        @if ($date)
            <time
                datetime="{{ $date->toDateString() }}"
                class="text-muted-foreground text-sm"
            >{{ $date->translatedFormat('j F Y') }}</time>
        @endif
        <h3 class="mt-2 text-xl font-semibold group-hover:underline group-hover:underline-offset-4">
            <a href="{{ $entry->url() }}" class="after:absolute after:inset-0">{{ $entry->get('title') }}</a>
        </h3>
        @if ($excerpt)
            <p class="text-muted-foreground mt-3 line-clamp-3">{{ $excerpt }}</p>
        @endif
    </div>
</article>
