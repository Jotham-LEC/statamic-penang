{{-- The blog: the page's own sections (if any), then every article, newest first. --}}
@php
    $list = \Statamic\Statamic::tag('collection:articles')->params(['paginate' => 9])->fetch();
    $sections = $page->blocks ?? [];
@endphp
<x-layout>
    @if (count($sections))
        <x-blocks :blocks="$sections" />
    @else
        <x-page-header :title="$page->title" />
    @endif

    <x-section>
        <x-topics class="mb-10" />
        @if ($list['no_results'])
            <p class="text-muted-foreground">{{ __('No articles yet.') }}</p>
        @else
            <div class="grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($list['entries'] as $entry)
                    <x-article-card :entry="$entry" />
                @endforeach
            </div>
            <x-pagination :paginate="$list['paginate']" />
        @endif
    </x-section>
</x-layout>
