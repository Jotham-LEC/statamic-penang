{{-- A blog category: its articles, newest first, a page at a time. --}}
@php
    $list = \Statamic\Statamic::tag('collection:articles')->params(['taxonomy:topics' => $page->slug(), 'paginate' => 9])->fetch();
@endphp
<x-layout>
    <x-page-header :title="$page->title()" :intro="$page->get('description')" :crumbs="$page" />
    <x-section>
        <x-topics :current="$page->slug()" class="mb-10" />
        @if ($list['no_results'] ?? true)
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
