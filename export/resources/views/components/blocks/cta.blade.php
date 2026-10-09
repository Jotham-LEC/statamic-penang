{{-- Call to action: centred, in a panel of the primary colour, or beside a picture. --}}
@php
    $layout = (string) $block->layout ?: 'panel';
    if ($layout === 'split' && ! $block->image) {
        $layout = 'panel';
    }
@endphp
<x-section :block="$block">
    @if ($layout === 'panel')
        <div data-tone="primary" class="relative overflow-hidden rounded-xl px-6 py-16 text-center shadow-lg sm:px-16">
            <h2 class="mx-auto max-w-2xl text-3xl font-semibold tracking-tight sm:text-4xl">{{ $block->heading }}</h2>
            @if (filled((string) $block->text))
                <p class="text-muted-foreground mx-auto mt-6 max-w-xl text-lg">{{ $block->text }}</p>
            @endif
            <x-buttons :buttons="$block->buttons" :whatsapp="$block->whatsapp" class="mt-10 justify-center" />
        </div>
    @elseif ($layout === 'split')
        <div class="bg-card text-card-foreground border-border grid items-center overflow-hidden rounded-xl border shadow-sm lg:grid-cols-2">
            <x-picture
                :image="$block->image"
                sizes="(min-width: 1024px) 50vw, 100vw"
                class="aspect-4/3 size-full object-cover lg:aspect-auto lg:h-full"
            />
            <div class="p-8 sm:p-12">
                <h2 class="text-3xl font-semibold tracking-tight">{{ $block->heading }}</h2>
                @if (filled((string) $block->text))
                    <p class="text-muted-foreground mt-4 text-lg">{{ $block->text }}</p>
                @endif
                <x-buttons :buttons="$block->buttons" :whatsapp="$block->whatsapp" class="mt-8" size="md" />
            </div>
        </div>
    @else
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ $block->heading }}</h2>
            @if (filled((string) $block->text))
                <p class="text-muted-foreground mt-6 text-lg">{{ $block->text }}</p>
            @endif
            <x-buttons :buttons="$block->buttons" :whatsapp="$block->whatsapp" class="mt-10 justify-center" />
        </div>
    @endif
</x-section>
