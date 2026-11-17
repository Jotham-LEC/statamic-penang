{{-- The page builder: each section (a set of the `blocks` Replicator, in the
     control panel's order) renders components/blocks/{type}. A section
     switched off in the control panel never reaches here; a type with no
     view is skipped, and so is one the blueprint no longer has (Statamic
     passes it on as a plain array).

     The page's one <h1>: a Hero that opens the page (the first section
     shown) carries it, and a Hero further down has an h2. A page that opens
     with another section gets its title as a hidden h1, so screen readers
     and search engines still find one. A view that prints its own h1 above
     the sections passes :opens="false": then no section carries one. --}}
@props(['blocks' => [], 'title' => null, 'opens' => true])
@php
    $sections = collect(\Statamic\View\Blade\value($blocks) ?? [])
        ->filter(fn ($block) => $block instanceof \Statamic\Fields\Values)
        ->map(fn ($block) => [$block, 'components.blocks.'.str_replace('_', '-', (string) $block->type)])
        ->filter(fn ($section) => view()->exists($section[1]))
        ->values();
    $opener = $sections->first()[0] ?? null;
@endphp
@if ($opens && filled($title) && (string) $opener?->type !== 'hero')
    <h1 class="sr-only">{{ $title }}</h1>
@endif
@foreach ($sections as [$block, $view])
    <div data-block="{{ $block->type }}" class="contents">
        @include($view, ['block' => $block, 'first' => $opens && $loop->first])
    </div>
@endforeach
