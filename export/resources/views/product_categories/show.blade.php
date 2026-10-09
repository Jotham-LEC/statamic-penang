{{-- A product category: its products. --}}
@php
    $products = collect(\Statamic\Statamic::tag('collection:products')->params(['taxonomy:product_categories' => $page->slug()])->fetch());
    $index = \Statamic\Facades\Collection::findByHandle('products')->mount();
@endphp
<x-layout>
    <x-page-header
        :title="$page->title()"
        :intro="$page->get('description')"
        :back="$index?->url()"
        :back-label="$index?->title"
    />
    <x-section>
        @if ($products->isEmpty())
            <p class="text-muted-foreground">{{ __('No products in this category yet.') }}</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <x-product-card :entry="$product" />
                @endforeach
            </div>
        @endif
    </x-section>
</x-layout>
