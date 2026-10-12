{{-- Gallery: pictures in an even grid or in masonry columns (each its own
     shape), with their captions (from each picture's details). Clicked, a
     picture opens larger in a dialog (the browser's <dialog>: Escape closes
     it, arrow keys move through the pictures; resources/js/site.js). Without
     the script, each picture links to its large version. --}}
@php
    use Statamic\Statamic;

    $images = collect($block->images ?? [])->filter(fn ($image) => $image->isImage());
    $masonry = (string) $block->layout === 'masonry';
    $captions = $block->captions !== false;
    $lightbox = $block->lightbox !== false;
    $columns = match ((string) $block->columns) {
        '2' => $masonry ? 'sm:columns-2' : 'sm:grid-cols-2',
        '4' => $masonry ? 'sm:columns-2 lg:columns-4' : 'grid-cols-2 lg:grid-cols-4',
        default => $masonry ? 'sm:columns-2 lg:columns-3' : 'sm:grid-cols-2 lg:grid-cols-3',
    };
    $large = fn ($image) => Statamic::tag('glide')->params(['src' => $image, 'width' => 1800, 'quality' => 80, 'fm' => 'webp'])->fetch();
@endphp
@if ($images->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
        <ul
            role="list"
            @class([
                $columns,
                'mt-12' => filled((string) $block->heading) || filled((string) $block->intro),
                'grid gap-4' => ! $masonry,
                'gap-4 [&>li]:mb-4 [&>li]:break-inside-avoid' => $masonry,
            ])
            @if ($lightbox) data-gallery @endif
        >
            @foreach ($images as $image)
                @php($caption = $captions ? trim((string) $image->get('caption')) : '')
                <li>
                    <figure>
                        @if ($lightbox)
                            <a
                                href="{{ $large($image) }}"
                                class="group bg-muted block overflow-hidden rounded-lg"
                                data-gallery-item
                                data-caption="{{ $caption }}"
                            >
                                <x-picture
                                    :image="$image"
                                    :widths="[400, 600, 800, 1200]"
                                    sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
                                    :class="\Illuminate\Support\Arr::toCssClasses(['w-full transition-transform duration-300 group-hover:scale-105', 'aspect-4/3 object-cover' => ! $masonry, 'h-auto' => $masonry])"
                                />
                            </a>
                        @else
                            <x-picture
                                :image="$image"
                                :widths="[400, 600, 800, 1200]"
                                sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw"
                                :class="\Illuminate\Support\Arr::toCssClasses(['bg-muted w-full rounded-lg', 'aspect-4/3 object-cover' => ! $masonry, 'h-auto' => $masonry])"
                            />
                        @endif
                        @if ($caption)
                            <figcaption class="text-muted-foreground mt-2 text-sm">{{ $caption }}</figcaption>
                        @endif
                    </figure>
                </li>
            @endforeach
        </ul>
        @if ($lightbox)
            <dialog
                class="bg-overlay text-overlay-foreground backdrop:bg-overlay/90 m-auto max-h-dvh max-w-dvw overflow-hidden rounded-lg p-0"
                aria-label="{{ __('Pictures') }}"
                data-gallery-dialog
            >
                <figure class="flex flex-col items-center gap-3 p-4 pt-14">
                    <img
                        alt=""
                        class="max-h-[78dvh] w-auto max-w-[92vw] rounded-md object-contain"
                        data-gallery-image
                    />
                    <figcaption class="max-w-2xl text-center text-sm" data-gallery-caption></figcaption>
                </figure>
                <div class="absolute top-2 right-2 left-2 flex items-center justify-between gap-2">
                    <span class="px-2 text-sm" aria-live="polite" data-gallery-count></span>
                    <div class="flex gap-1">
                        <button
                            type="button"
                            class="rounded-control hover:bg-overlay-foreground/15 inline-flex size-10 items-center justify-center"
                            data-gallery-prev
                        >
                            <span class="sr-only">{{ __('Previous picture') }}</span>
                            <x-icon name="chevron-left" class="size-6" />
                        </button>
                        <button
                            type="button"
                            class="rounded-control hover:bg-overlay-foreground/15 inline-flex size-10 items-center justify-center"
                            data-gallery-next
                        >
                            <span class="sr-only">{{ __('Next picture') }}</span>
                            <x-icon name="chevron-right" class="size-6" />
                        </button>
                        <button
                            type="button"
                            class="rounded-control hover:bg-overlay-foreground/15 inline-flex size-10 items-center justify-center"
                            data-gallery-close
                            autofocus
                        >
                            <span class="sr-only">{{ __('Close') }}</span>
                            <x-icon name="x" class="size-6" />
                        </button>
                    </div>
                </div>
            </dialog>
        @endif
    </x-section>
@endif
