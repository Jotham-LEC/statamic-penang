{{-- The heading of a listing or a single item, with its breadcrumbs or a
     link back. --}}
@props(['title', 'intro' => null, 'back' => null, 'backLabel' => null, 'crumbs' => null])
<x-section spacing="compact" class="border-border border-b">
    @if ($crumbs)
        <x-breadcrumbs :content="$crumbs" class="mb-6" />
    @elseif ($back)
        <a href="{{ $back }}" class="text-muted-foreground hover:text-foreground text-sm font-medium"
            >← {{ $backLabel }}</a>
    @endif
    <h1 @class(['max-w-3xl text-4xl font-semibold tracking-tight sm:text-5xl', 'mt-4' => $back])>{{ $title }}</h1>
    @if (filled((string) $intro))
        <p class="text-muted-foreground mt-4 max-w-2xl text-lg">{{ $intro }}</p>
    @endif
    {{ $slot }}
</x-section>
