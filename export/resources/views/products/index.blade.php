{{-- Products: the page's own sections (if any), the categories, a row of
     featured products for each of the first few categories (Site settings →
     Products page), then every product in the collection's order, a page at
     a time. --}}
@cascade(['settings' => null])
@php
    use App\Support\Labels;
    use Statamic\Statamic;

    use function Statamic\View\Blade\value;

    $perPage = max(3, (int) (value($settings?->products_per_page) ?: 12));
    $list = Statamic::tag('collection:products')->params(['paginate' => $perPage])->fetch();
    $categories = collect(Statamic::tag('taxonomy:product_categories')->fetch())->filter(fn ($term) => $term->entriesCount() > 0);
    $firstPage = ($list['paginate']['current_page'] ?? 1) == 1;
    $rows = $firstPage
        ? $categories->take(max(0, (int) value($settings?->featured_rows)))->map(function ($category) {
            $inCategory = ['taxonomy:product_categories' => $category->slug(), 'limit' => 4];
            // Its featured products first, then its others, up to four.
            $products = collect(Statamic::tag('collection:products')->params([...$inCategory, 'featured:is' => true])->fetch())
                ->merge(Statamic::tag('collection:products')->params($inCategory)->fetch())
                ->unique(fn ($entry) => $entry->id())
                ->take(4);

            return ['category' => $category, 'products' => $products];
        })->filter(fn ($row) => $row['products']->isNotEmpty())
        : collect();
    $sections = $page->blocks ?? [];
@endphp
<x-layout>
    @if (count($sections))
        <x-blocks :blocks="$sections" />
    @else
        <x-page-header :title="$page->title" />
    @endif

    @foreach ($rows as $row)
        <x-section :tone="$loop->odd ? 'muted' : 'default'" spacing="compact">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <h2 class="text-2xl font-semibold tracking-tight">
                    {{ str_replace(':category', $row['category']->title(), Labels::get('featured_in')) }}
                </h2>
                <x-ui.button :href="$row['category']->url()" variant="outline" size="sm">
                    {{ Labels::get('see_all') }} <x-icon name="arrow-right" class="size-4" />
                </x-ui.button>
            </div>
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($row['products'] as $product)
                    <x-product-card :entry="$product" />
                @endforeach
            </div>
        </x-section>
    @endforeach

    <x-section id="all">
        @if ($categories->isNotEmpty())
            <nav aria-label="{{ __('Categories') }}" class="mb-10 flex flex-wrap gap-2">
                <x-ui.button :href="$page->url" size="sm">{{ Labels::get('all_categories') }}</x-ui.button>
                @foreach ($categories as $category)
                    <x-ui.button :href="$category->url()" size="sm" variant="outline">
                        {{ $category->title() }}</x-ui.button>
                @endforeach
            </nav>
        @endif

        @if ($list['no_results'] ?? true)
            <p class="text-muted-foreground">{{ __('No products yet.') }}</p>
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
