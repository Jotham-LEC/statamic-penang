{{-- A product: its pictures, price, description, and two ways to ask about
     it: WhatsApp, with the product named in the first message, and the
     enquiry form. There is no checkout. --}}
@php
    use App\Support\Business;

    use function Statamic\View\Blade\value;

    // A product in an ordered collection arrives as its place in the order.
    $entry = $page instanceof \Statamic\Structures\Page ? $page->entry() : $page;
    $images = collect(value($page->images) ?? []);
    $specs = collect($entry->get('specs') ?? [])->filter(fn ($row) => filled($row['label'] ?? null))->map(fn ($row) => ['label' => $row['label'], 'value' => $row['value'] ?? '']);
    // Buttons to the product in other shops, with the shop's icon where Penang has one.
    $shops = collect($entry->get('buy_links') ?? [])
        ->filter(fn ($row) => filled($row['label'] ?? null) && preg_match('#^https?://#i', $row['url'] ?? ''))
        ->map(fn ($row) => [
            'label' => $row['label'],
            'url' => $row['url'],
            'icon' => match (true) {
                str_contains($row['url'], 'shopee.') => 'brands/shopee',
                default => null,
            },
        ]);
    $inStock = $entry->get('in_stock') !== false;
    // From their slugs: augmenting the field would tie each term to the
    // products collection (a /products/product-categories/… address
    // Statamic doesn't serve).
    $categories = collect((array) $entry->get('product_categories'))->map(fn ($slug) => \Statamic\Facades\Term::find('product_categories::'.$slug))->filter();
    $whatsapp = Business::whatsappUrl(__('Hello! I’d like to ask about :product: :url', ['product' => $page->title, 'url' => $page->absolute_url]));
    $contact = Business::contactUrl();
    $related = $categories->isNotEmpty()
        ? collect(\Statamic\Statamic::tag('collection:products')->params(['taxonomy:product_categories' => $categories->first()->slug(), 'id:not' => $page->id, 'limit' => 3])->fetch())
        : collect();
@endphp
<x-layout>
    <x-section spacing="compact">
        <x-breadcrumbs :content="$entry" class="mb-8" />
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-16">
            <div class="space-y-4">
                @if ($images->isNotEmpty())
                    <x-picture
                        :image="$images->first()"
                        :eager="true"
                        sizes="(min-width: 1024px) 50vw, 100vw"
                        class="bg-muted aspect-square w-full rounded-xl object-cover"
                    />
                    @if ($images->count() > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($images->skip(1) as $image)
                                <x-picture
                                    :image="$image"
                                    :widths="[300, 600]"
                                    sizes="25vw"
                                    class="bg-muted aspect-square w-full rounded-lg object-cover"
                                />
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="bg-muted aspect-square w-full rounded-xl"></div>
                @endif
            </div>

            <div>
                @if ($categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <a href="{{ $category->url() }}"><x-ui.badge variant="outline">{{ $category->title() }}</x-ui.badge></a>
                        @endforeach
                    </div>
                @endif
                <h1 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">{{ $page->title }}</h1>
                <x-product-badge :entry="$entry" class="mt-3" />
                <x-product-price :entry="$entry" size="lg" class="mt-4" />
                @unless ($inStock)
                    <x-ui.badge variant="muted" class="mt-3">{{ \App\Support\Labels::get('out_of_stock') }}</x-ui.badge>
                @endunless
                @if (filled($entry->get('summary')))
                    <p class="text-muted-foreground mt-6 text-lg">{{ $page->summary }}</p>
                @endif

                <div class="mt-8 flex flex-wrap gap-3">
                    @if ($whatsapp)
                        <x-ui.button :href="$whatsapp" size="lg" target="_blank" rel="noopener">
                            <x-icon name="brands/whatsapp" class="size-5" />
                            {{ \App\Support\Labels::get('ask_on_whatsapp') }}
                        </x-ui.button>
                    @endif
                    @if ($contact)
                        <x-ui.button :href="$contact.'#enquiry'" size="lg" :variant="$whatsapp ? 'outline' : 'primary'">
                            {{ \App\Support\Labels::get('send_enquiry') }}</x-ui.button>
                    @endif
                </div>

                @if ($shops->isNotEmpty())
                    <div class="mt-3 flex flex-wrap gap-3">
                        @foreach ($shops as $shop)
                            <x-ui.button :href="$shop['url']" variant="outline" target="_blank" rel="noopener">
                                @if ($shop['icon'])
                                    <x-icon :name="$shop['icon']" class="size-4 fill-current" />
                                @endif
                                {{ $shop['label'] }}
                            </x-ui.button>
                        @endforeach
                    </div>
                @endif

                @if (filled((string) $page->content))
                    <div class="rich-text border-border mt-10 border-t pt-10">{!! $page->content !!}</div>
                @endif

                @if ($specs->isNotEmpty())
                    <div class="border-border mt-10 border-t pt-10">
                        <h2 class="text-lg font-semibold">
                            {{ filled($entry->get('specs_heading')) ? $entry->get('specs_heading') : \App\Support\Labels::get('details') }}
                        </h2>
                        @if ($specs->every(fn ($spec) => blank($spec['value'])))
                            {{-- Labels alone: a list, such as what's inside a box. --}}
                            <ul class="rich-text text-muted-foreground mt-4">
                                @foreach ($specs as $spec)
                                    <li>{{ $spec['label'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            <dl class="divide-border mt-4 divide-y text-sm">
                                @foreach ($specs as $spec)
                                    <div class="grid grid-cols-3 gap-4 py-3">
                                        <dt class="font-medium">{{ $spec['label'] }}</dt>
                                        <dd class="text-muted-foreground col-span-2">{{ $spec['value'] }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </x-section>

    @if ($related->isNotEmpty())
        <x-section tone="muted">
            <h2 class="text-2xl font-semibold tracking-tight">{{ \App\Support\Labels::get('related_products') }}</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $product)
                    <x-product-card :entry="$product" />
                @endforeach
            </div>
        </x-section>
    @endif
</x-layout>
