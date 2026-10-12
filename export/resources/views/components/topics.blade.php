{{-- The blog's categories as links, the current one marked. --}}
@props(['current' => null])
@php
    $categories = collect(\Statamic\Statamic::tag('taxonomy:topics')->fetch())->filter(fn ($term) => $term->entriesCount() > 0);
    $blog = \Statamic\Facades\Collection::findByHandle('articles')?->mount();
@endphp
@if ($categories->isNotEmpty())
    <nav aria-label="{{ __('Categories') }}" {{ $attributes->class('flex flex-wrap gap-2') }}>
        @if ($blog)
            <x-ui.button :href="$blog->url()" size="sm" :variant="$current ? 'outline' : 'primary'">
                {{ \App\Support\Labels::get('all_categories') }}</x-ui.button>
        @endif
        @foreach ($categories as $category)
            <x-ui.button
                :href="$category->url()"
                size="sm"
                :variant="$current === $category->slug() ? 'primary' : 'outline'"
                :aria-current="$current === $category->slug() ? 'page' : null"
            >
                {{ $category->title() }}</x-ui.button>
        @endforeach
    </nav>
@endif
