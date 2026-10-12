{{-- A product category: its products, a page at a time, and the other
     categories to move between. --}}
@cascade(['settings' => null])
@php
    use App\Support\Labels;
    use Statamic\Statamic;

    $perPage = max(3, (int) (\Statamic\View\Blade\value($settings?->products_per_page) ?: 12));
    $list = Statamic::tag('collection:products')->params(['taxonomy:product_categories' => $page->slug(), 'paginate' => $perPage])->fetch();
    $categories = collect(Statamic::tag('taxonomy:product_categories')->fetch())->filter(fn ($term) => $term->entriesCount() > 0);
    $index = \Statamic\Facades\Collection::findByHandle('products')->mount();
@endphp
<x-layout>
    <x-page-header :title="$page->title()" :intro="$page->get('description')" :crumbs="$page" />
    <x-section>
        @if ($categories->count() > 1)
            <nav aria-label="{{ __('Categories') }}" class="mb-10 flex flex-wrap gap-2">
                @if ($index)
                    <x-ui.button :href="$index->url()" size="sm" variant="outline">
                        {{ Labels::get('all_categories') }}</x-ui.button>
                @endif
                @foreach ($categories as $category)
                    <x-ui.button
                        :href="$category->url()"
                        size="sm"
                        :variant="$category->slug() === $page->slug() ? 'primary' : 'outline'"
                        :aria-current="$category->slug() === $page->slug() ? 'page' : null"
                    >
                        {{ $category->title() }}</x-ui.button>
                @endforeach
            </nav>
        @endif
        @if ($list['no_results'] ?? true)
            <p class="text-muted-foreground">{{ __('No products in this category yet.') }}</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($list['entries'] as $product)
                    <x-product-card :entry="$product" />
                @endforeach
            </div>
            <x-pagination :paginate="$list['paginate']" :previous="__('Previous')" :next="__('Next')" />
        @endif
    </x-section>
</x-layout>
