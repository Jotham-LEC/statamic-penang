{{-- Picture and text, side by side from lg up; the picture first on phones. --}}
@php
    $shape = match ((string) $block->image_shape) {
        'square' => 'aspect-square',
        'portrait' => 'aspect-4/5',
        default => 'aspect-4/3',
    };
@endphp
<x-section :block="$block">
    <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
        <div @class(['lg:order-last' => (string) $block->image_position === 'right'])>
            @if ($block->image)
                <x-picture
                    :image="$block->image"
                    sizes="(min-width: 1024px) 50vw, 100vw"
                    class="{{ $shape }} w-full rounded-xl object-cover"
                />
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
