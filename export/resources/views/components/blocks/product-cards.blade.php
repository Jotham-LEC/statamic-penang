{{-- Products: featured, in the collection's order, or chosen by hand. --}}
@php
    use Statamic\Statamic;

    $source = (string) $block->source ?: 'featured';
    $limit = max(1, (int) ($block->limit ?: 3));
    $products = match ($source) {
        'picked' => collect($block->products ?? [])->filter(fn ($entry) => $entry->published()),
        'featured' => Statamic::tag('collection:products')->params(['featured:is' => true, 'limit' => $limit])->fetch(),
        default => Statamic::tag('collection:products')->params(['limit' => $limit])->fetch(),
    };
    $products = collect($products);
    $index = \Statamic\Facades\Collection::findByHandle('products')?->mount()?->url();
@endphp
@if ($products->isNotEmpty())
    <x-section :block="$block">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
            @if ($block->all_link && $index)
                <x-ui.button :href="$index" variant="outline">
                    {{ \App\Support\Labels::get('all_products') }} <x-icon name="arrow-right" class="size-4"
                /></x-ui.button>
            @endif
        </div>
        <div @class([
            'mt-12 grid gap-6 sm:grid-cols-2',
            'lg:grid-cols-4' => (string) $block->columns === '4',
            'lg:grid-cols-3' => (string) $block->columns !== '4',
        ])>
            @foreach ($products as $product)
                <x-product-card :entry="$product" />
            @endforeach
        </div>
    </x-section>
@endif
