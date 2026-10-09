{{-- Latest articles from the blog, as cards or a list. --}}
@php
    $posts = collect(\Statamic\Statamic::tag('collection:articles')->params(['limit' => max(1, (int) ($block->limit ?: 3))])->fetch());
    $list = (string) $block->layout === 'list';
    $index = \Statamic\Facades\Collection::findByHandle('articles')?->mount()?->url();
@endphp
@if ($posts->isNotEmpty())
    <x-section :block="$block">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
            @if ($block->all_link && $index)
                <x-ui.button :href="$index" variant="outline">
                    {{ __('All articles') }} <x-icon name="arrow-right" class="size-4"
                /></x-ui.button>
            @endif
        </div>
        <div @class(['mt-12', 'grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3' => ! $list, 'divide-border max-w-4xl space-y-10 divide-y [&>*]:pb-10' => $list])>
            @foreach ($posts as $post)
                <x-article-card :entry="$post" :layout="$list ? 'list' : 'card'" />
            @endforeach
        </div>
    </x-section>
@endif
