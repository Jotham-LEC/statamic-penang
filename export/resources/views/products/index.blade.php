{{-- Products: the page's own sections (if any), the categories, then every
     product in the collection's order. --}}
@php
    $products = collect(\Statamic\Statamic::tag('collection:products')->fetch());
    $categories = collect(\Statamic\Statamic::tag('taxonomy:product_categories')->fetch())->filter(fn ($term) => $term->entriesCount() > 0);
    $sections = $page->blocks ?? [];
@endphp
<x-layout>
    @if (count($sections))
        <x-blocks :blocks="$sections" />
    @else
        <x-page-header :title="$page->title" />
    @endif

    <x-section>
        @if ($categories->isNotEmpty())
            <nav aria-label="{{ __('Categories') }}" class="mb-10 flex flex-wrap gap-2">
                <x-ui.button :href="$page->url" size="sm">{{ __('All') }}</x-ui.button>
                @foreach ($categories as $category)
                    <x-ui.button :href="$category->url()" size="sm" variant="outline">
                        {{ $category->title() }}</x-ui.button>
                @endforeach
            </nav>
        @endif

        @if ($products->isEmpty())
            <p class="text-muted-foreground">{{ __('No products yet.') }}</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <x-product-card :entry="$product" />
                @endforeach
            </div>
        @endif
    </x-section>
</x-layout>
