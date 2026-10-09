{{-- A blog article. --}}
@php
    use function Statamic\View\Blade\value;

    $author = value($page->author);
    $author = $author instanceof \Illuminate\Support\Collection ? $author->first() : $author;
    $image = value($page->image);
    $blog = \Statamic\Facades\Collection::findByHandle('articles')->mount();
    $more = collect(\Statamic\Statamic::tag('collection:articles')->params(['id:not' => $page->id, 'limit' => 3])->fetch());
@endphp
<x-layout>
    <article>
        <x-section spacing="compact" width="max-w-3xl">
            @if ($blog)
                <a href="{{ $blog->url() }}" class="text-muted-foreground hover:text-foreground text-sm font-medium"
                    >← {{ $blog->title }}</a>
            @endif
            <h1 class="mt-6 text-4xl font-semibold tracking-tight sm:text-5xl">{{ $page->title }}</h1>
            <div class="text-muted-foreground mt-6 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                @if ($author)
                    <span class="flex items-center gap-2">
                        <x-ui.avatar
                            :image="$author->augmentedValue('photo')->value()"
                            :name="(string) $author->get('title')"
                            size="sm"
                        />
                        <span class="text-foreground font-medium">{{ $author->get('title') }}</span>
                    </span>
                @endif
                <time datetime="{{ $page->date->toDateString() }}">{{ $page->date->translatedFormat('j F Y') }}</time>
            </div>
        </x-section>

        @if ($image)
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <x-picture
                    :image="$image"
                    :eager="true"
                    sizes="(min-width: 1024px) 1024px, 100vw"
                    class="aspect-video w-full rounded-xl object-cover"
                />
            </div>
        @endif

        <x-section width="max-w-3xl" spacing="compact">
            <div class="rich-text text-lg">{!! $page->content !!}</div>
        </x-section>
    </article>

    @if ($more->isNotEmpty())
        <x-section tone="muted">
            <h2 class="text-2xl font-semibold tracking-tight">{{ __('More articles') }}</h2>
            <div class="mt-10 grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($more as $entry)
                    <x-article-card :entry="$entry" />
                @endforeach
            </div>
        </x-section>
    @endif
</x-layout>
