{{-- Previous and next pages of a list (the collection tag's `paginate`). --}}
@props(['paginate'])
@if (($paginate['total_pages'] ?? 1) > 1)
    <nav aria-label="{{ __('Pages') }}" class="border-border mt-16 flex items-center justify-between border-t pt-8">
        @if ($paginate['prev_page'])
            <x-ui.button :href="$paginate['prev_page']" variant="outline" rel="prev">← {{ __('Newer') }}</x-ui.button>
        @else
            <span></span>
        @endif
        <p class="text-muted-foreground text-sm">
            {{ __('Page :current of :total', ['current' => $paginate['current_page'], 'total' => $paginate['total_pages']]) }}
        </p>
        @if ($paginate['next_page'])
            <x-ui.button :href="$paginate['next_page']" variant="outline" rel="next">{{ __('Older') }} →</x-ui.button>
        @else
            <span></span>
        @endif
    </nav>
@endif
