{{-- A page: its sections, from the page builder, under its breadcrumbs when
     it sits under another page. --}}
<x-layout>
    @if (count(\App\Support\Breadcrumbs::trail($page)) > 2)
        <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
            <x-breadcrumbs :content="$page" />
        </div>
    @endif
    <x-blocks :blocks="$page->blocks" />
</x-layout>
