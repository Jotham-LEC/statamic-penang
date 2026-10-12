{{-- Where the page sits: home, its parents, the page (App\Support\Breadcrumbs,
     the same trail as the structured data). Nothing for a top-level page. --}}
@props(['content'])
@php($trail = \App\Support\Breadcrumbs::trail($content))
@if (count($trail) > 1)
    <nav aria-label="{{ __('Breadcrumb') }}" {{ $attributes->class('text-muted-foreground text-sm') }}>
        <ol class="flex flex-wrap items-center gap-x-2 gap-y-1">
            @foreach ($trail as $crumb)
                <li class="flex items-center gap-2">
                    @if ($loop->last)
                        <span
                            aria-current="page"
                            class="text-foreground line-clamp-1 font-medium"
                        >{{ $crumb['title'] }}</span>
                    @else
                        <a href="{{ $crumb['url'] }}" class="hover:text-foreground">{{ $crumb['title'] }}</a>
                        <x-icon name="chevron-right" class="size-3.5" />
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
