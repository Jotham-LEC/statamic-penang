{{-- A product: its pictures, price, description, and two ways to ask about
     it: WhatsApp, with the product named in the first message, and the
     enquiry form. There is no checkout. --}}
@php
    use App\Support\Business;

    use function Statamic\View\Blade\value;

    // A product in an ordered collection arrives as its place in the order.
    $entry = $page instanceof \Statamic\Structures\Page ? $page->entry() : $page;
    $images = collect(value($page->images) ?? []);
    $price = Business::price($entry->get('price'));
    $inStock = $entry->get('in_stock') !== false;
    $categories = collect(value($page->product_categories) ?? []);
    $index = \Statamic\Facades\Collection::findByHandle('products')->mount();
    $whatsapp = Business::whatsappUrl(__('Hello! I’d like to ask about :product: :url', ['product' => $page->title, 'url' => $page->absolute_url]));
    $contact = \Statamic\Facades\Entry::findByUri('/contact');
    $related = $categories->isNotEmpty()
        ? collect(\Statamic\Statamic::tag('collection:products')->params(['taxonomy:product_categories' => $categories->first()->slug(), 'id:not' => $page->id, 'limit' => 3])->fetch())
        : collect();
@endphp
<x-layout>
    <x-section spacing="compact">
        @if ($index)
            <a href="{{ $index->url() }}" class="text-muted-foreground hover:text-foreground text-sm font-medium"
                >← {{ $index->title }}</a>
        @endif
        <div class="mt-8 grid gap-12 lg:grid-cols-2 lg:gap-16">
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
                <p class="mt-4 text-2xl font-semibold">
                    {{ $price ?? __('Ask for a price') }}
                    @if ($price && filled($entry->get('price_note')))
                        <span class="text-muted-foreground text-base font-normal">{{ $page->price_note }}</span>
                    @endif
                </p>
                @unless ($inStock)
                    <x-ui.badge variant="muted" class="mt-3">{{ __('Out of stock') }}</x-ui.badge>
                @endunless
                @if (filled($entry->get('summary')))
                    <p class="text-muted-foreground mt-6 text-lg">{{ $page->summary }}</p>
                @endif

                <div class="mt-8 flex flex-wrap gap-3">
                    @if ($whatsapp)
                        <x-ui.button :href="$whatsapp" size="lg" target="_blank" rel="noopener">
                            <x-icon name="brands/whatsapp" class="size-5" />
                            {{ __('Ask on WhatsApp') }}
                        </x-ui.button>
                    @endif
                    @if ($contact)
                        <x-ui.button
                            :href="$contact->url().'#enquiry'"
                            size="lg"
                            :variant="$whatsapp ? 'outline' : 'primary'"
                        >
                            {{ __('Send an enquiry') }}</x-ui.button>
                    @endif
                </div>

                @if (filled((string) $page->content))
                    <div class="rich-text border-border mt-10 border-t pt-10">{!! $page->content !!}</div>
                @endif
            </div>
        </div>
    </x-section>

    @if ($related->isNotEmpty())
        <x-section tone="muted">
            <h2 class="text-2xl font-semibold tracking-tight">{{ __('You may also like') }}</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $product)
                    <x-product-card :entry="$product" />
                @endforeach
            </div>
        </x-section>
    @endif
</x-layout>
