{{-- Hero: centred (a picture below, if any), split (text beside a picture),
     or text on a full-width photo under a dark scrim. The first section of a
     page carries its <h1>. --}}
@php
    $layout = (string) $block->layout ?: 'split';
    $image = $block->image;
    $heading = $first ? 'h1' : 'h2';
    if ($layout === 'background' && ! $image) {
        $layout = 'centred';
    }
@endphp

@if ($layout === 'background')
    <section @if ($block->anchor) id="{{ $block->anchor }}" @endif class="relative isolate overflow-hidden">
        <x-picture :image="$image" alt="" :eager="$first" class="absolute inset-0 -z-10 size-full object-cover" />
        <div class="bg-overlay/65 absolute inset-0 -z-10" aria-hidden="true"></div>
        <div data-tone="overlay" class="text-foreground mx-auto max-w-7xl px-4 py-28 sm:px-6 sm:py-40 lg:px-8">
            <div class="max-w-2xl">
                @if (filled((string) $block->eyebrow))
                    <p class="text-sm font-semibold tracking-wide uppercase">{{ $block->eyebrow }}</p>
                @endif
                <{{ $heading }}
                    class="mt-3 text-4xl font-semibold tracking-tight sm:text-6xl"
                    >{{ $block->heading }}</{{ $heading }}
                >
                @if (filled((string) $block->text))
                    <p class="mt-6 text-lg leading-relaxed sm:text-xl">{{ $block->text }}</p>
                @endif
                <x-buttons :buttons="$block->buttons" class="mt-10" />
            </div>
        </div>
    </section>
@else
    <x-section :block="$block">
        <div @class([
            'grid items-center gap-12 lg:grid-cols-2 lg:gap-16' => $layout === 'split' && $image,
            'mx-auto max-w-3xl text-center' => $layout === 'centred',
            'max-w-3xl' => $layout === 'split' && ! $image,
        ])>
            <div @class(['lg:order-last' => $layout === 'split' && (string) $block->image_position === 'left'])>
                @if (filled((string) $block->eyebrow))
                    <p class="text-primary text-sm font-semibold tracking-wide uppercase">{{ $block->eyebrow }}</p>
                @endif
                <{{ $heading }}
                    class="mt-3 text-4xl font-semibold tracking-tight sm:text-5xl lg:text-6xl"
                    >{{ $block->heading }}</{{ $heading }}
                >
                @if (filled((string) $block->text))
                    <p class="text-muted-foreground mt-6 text-lg leading-relaxed sm:text-xl">{{ $block->text }}</p>
                @endif
                <x-buttons
                    :buttons="$block->buttons"
                    :class="\Illuminate\Support\Arr::toCssClasses(['mt-10', 'justify-center' => $layout === 'centred'])"
                />
            </div>

            @if ($image && $layout === 'split')
                <x-picture
                    :image="$image"
                    :eager="$first"
                    sizes="(min-width: 1024px) 50vw, 100vw"
                    class="aspect-4/3 w-full rounded-xl object-cover shadow-lg"
                />
            @endif
        </div>

        @if ($image && $layout === 'centred')
            <x-picture
                :image="$image"
                :eager="$first"
                sizes="(min-width: 1280px) 1216px, 100vw"
                class="mt-16 aspect-video w-full rounded-xl object-cover shadow-lg"
            />
        @endif
    </x-section>
@endif
