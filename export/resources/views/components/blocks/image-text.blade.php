{{-- Picture and text, side by side from lg up; the picture first on phones.
     With more pictures, a collage or a column of them, with their captions
     (from each picture's details). --}}
@php
    use function Statamic\View\Blade\value;

    $pictures = collect([value($block->image)])->merge(collect(value($block->more_images) ?? []))->filter(fn ($p) => $p instanceof \Statamic\Contracts\Assets\Asset)->values();
    $collage = (string) $block->pictures_layout !== 'stacked';
    $shape = match ((string) $block->image_shape) {
        'square' => 'aspect-square',
        'portrait' => 'aspect-4/5',
        default => 'aspect-4/3',
    };
@endphp
<x-section :block="$block">
    <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
        <div @class(['lg:order-last' => (string) $block->image_position === 'right'])>
            @if ($pictures->count() > 1 && $collage)
                {{-- A collage: the first picture large, the others beside or below it. --}}
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($pictures as $picture)
                        <figure @class(['col-span-2' => $loop->first || ($loop->last && $loop->count % 2 === 0)])>
                            <x-picture
                                :image="$picture"
                                :sizes="$loop->first ? '(min-width: 1024px) 50vw, 100vw' : '(min-width: 1024px) 25vw, 50vw'"
                                :class="($loop->first ? $shape : 'aspect-square').' w-full rounded-xl object-cover'"
                            />
                            @if (filled($picture->get('caption')))
                                <figcaption class="text-muted-foreground mt-2 text-sm">
                                    {{ $picture->get('caption') }}
                                </figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($pictures as $picture)
                        <figure>
                            <x-picture
                                :image="$picture"
                                sizes="(min-width: 1024px) 50vw, 100vw"
                                class="{{ $shape }} w-full rounded-xl object-cover"
                            />
                            @if ($pictures->count() > 1 && filled($picture->get('caption')))
                                <figcaption class="text-muted-foreground mt-2 text-sm">
                                    {{ $picture->get('caption') }}
                                </figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            @endif
        </div>
        <div>
            <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" />
            @if (filled((string) $block->content))
                <div class="rich-text text-muted-foreground mt-6 text-lg">{!! $block->content !!}</div>
            @endif
            <x-buttons :buttons="$block->buttons" class="mt-8" size="md" />
        </div>
    </div>
</x-section>
