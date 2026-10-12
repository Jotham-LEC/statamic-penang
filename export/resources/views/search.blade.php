{{-- Search results (a page whose kind is Search results): the page's own
     sections, a search box, then the pages, products and articles that match
     (Statamic's search index, config/statamic/search.php). Pages kept out of
     search engines are left out here too. --}}
@php
    use App\Support\Excerpt;
    use App\Support\Labels;
    use Statamic\Facades\Search;

    // Only a string: `?q[]=` gives an array.
    $query = request()->query('q');
    $query = is_string($query) ? trim(mb_substr($query, 0, 100)) : '';
    $results = collect();
    if ($query !== '') {
        try {
            $results = Search::index()->ensureExists()->search($query)->limit(50)->get()
                ->map(fn ($result) => $result->getSearchable())
                ->filter(fn ($entry) => $entry && $entry->published() && $entry->url() && empty(($entry->get('seo') ?? [])['noindex']))
                ->take(30);
        } catch (\Statamic\Search\IndexNotFoundException) {
            $results = collect();
        }
    }
    $kinds = ['products' => __('Product'), 'articles' => __('Article')];
    $sections = $page->blocks ?? [];
@endphp
<x-layout>
    @if (count($sections))
        <x-blocks :blocks="$sections" />
    @else
        <x-page-header :title="$page->title" />
    @endif

    <x-section width="max-w-3xl">
        <form role="search" action="{{ $page->url }}" method="get" class="flex gap-3">
            <label for="search-query" class="sr-only">{{ Labels::get('search') }}</label>
            <input
                id="search-query"
                type="search"
                name="q"
                value="{{ $query }}"
                placeholder="{{ Labels::get('search_placeholder') }}"
                class="rounded-control border-input bg-background text-foreground placeholder:text-muted-foreground focus-visible:outline-ring block w-full border px-4 py-3 text-base focus-visible:outline-2 focus-visible:outline-offset-0"
                @if ($query === '') autofocus @endif
            />
            <x-ui.button type="submit" size="lg">
                <x-icon name="search" class="size-5" /><span class="max-sm:sr-only">{{ Labels::get('search') }}</span>
            </x-ui.button>
        </form>

        @if ($query !== '')
            <p class="text-muted-foreground mt-8 text-sm" aria-live="polite">
                @if ($results->isEmpty())
                    {{ str_replace(':query', $query, Labels::get('no_results')) }}
                @else
                    {{ trans_choice(':count result for “:query”|:count results for “:query”', $results->count(), ['query' => $query]) }}
                @endif
            </p>
            <ul role="list" class="divide-border mt-6 divide-y">
                @foreach ($results as $entry)
                    @php($text = Excerpt::of($entry, $entry->collectionHandle() === 'articles' ? 'excerpt' : 'summary') ?? \App\Support\Excerpt::plain(collect((array) $entry->value('blocks'))->firstWhere('type', 'hero')['text'] ?? null))
                    <li class="group relative py-6">
                        @if (isset($kinds[$entry->collectionHandle()]))
                            <p class="text-primary text-xs font-semibold tracking-wide uppercase">
                                {{ $kinds[$entry->collectionHandle()] }}
                            </p>
                        @endif
                        <h2 class="mt-1 text-lg font-semibold group-hover:underline group-hover:underline-offset-4">
                            <a
                                href="{{ $entry->url() }}"
                                class="after:absolute after:inset-0"
                            >{{ $entry->get('title') }}</a>
                        </h2>
                        @if ($text)
                            <p class="text-muted-foreground mt-2 line-clamp-2 text-sm">{{ $text }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </x-section>
</x-layout>
