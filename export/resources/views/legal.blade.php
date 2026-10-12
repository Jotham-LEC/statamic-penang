{{-- A legal page (privacy, terms): a contents list of its Text sections'
     headings beside them, each linking to its section. Other sections show
     as usual. The date is when the page was last saved. --}}
@php
    use Illuminate\Support\Str;

    $blocks = collect(\Statamic\View\Blade\value($page->blocks) ?? [])->filter(fn ($b) => $b instanceof \Statamic\Fields\Values);
    $used = [];
    $contents = $blocks->map(function ($block) use (&$used) {
        $heading = trim((string) $block->heading);
        if ($block->type !== 'text' || $heading === '') {
            return null;
        }
        $id = (string) $block->anchor ?: Str::slug($heading) ?: 'section';
        $id = isset($used[$id]) ? $id.'-'.(++$used[$id]) : $id;
        $used[$id] ??= 1;

        return ['id' => $id, 'title' => $heading];
    });
    $updated = $page->last_modified ?? null;
@endphp
<x-layout>
    <x-page-header :title="$page->title" :crumbs="count(\App\Support\Breadcrumbs::trail($page)) > 2 ? $page : null">
        @if ($updated)
            <p class="text-muted-foreground mt-4 text-sm">
                {{ __('Last updated :date', ['date' => \Illuminate\Support\Carbon::parse((string) $updated)->translatedFormat('j F Y')]) }}
            </p>
        @endif
    </x-page-header>

    <div class="mx-auto grid max-w-7xl gap-x-16 px-4 sm:px-6 lg:grid-cols-4 lg:px-8">
        @if ($contents->filter()->count() > 1)
            <nav aria-labelledby="contents-heading" class="pt-10 lg:sticky lg:top-20 lg:self-start lg:pt-16">
                <h2 id="contents-heading" class="text-muted-foreground text-sm font-semibold tracking-wide uppercase">
                    {{ \App\Support\Labels::get('contents') }}
                </h2>
                <ol class="mt-4 space-y-2 text-sm">
                    @foreach ($contents->filter() as $item)
                        <li>
                            <a
                                href="#{{ $item['id'] }}"
                                class="text-muted-foreground hover:text-foreground"
                            >{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif
        <div @class(['lg:col-span-3' => $contents->filter()->count() > 1, 'lg:col-span-4' => $contents->filter()->count() <= 1])>
            @foreach ($blocks as $key => $block)
                @php($view = 'components.blocks.'.str_replace('_', '-', (string) $block->type))
                @if (view()->exists($view))
                    <div
                        data-block="{{ $block->type }}"
                        @if ($contents[$key]) id="{{ $contents[$key]['id'] }}" class="[&>section>div]:px-0 scroll-mt-20" @else class="[&>section>div]:px-0" @endif
                    >
                        @include($view, ['block' => $block, 'first' => false])
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-layout>
