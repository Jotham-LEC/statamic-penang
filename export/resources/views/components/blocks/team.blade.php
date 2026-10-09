{{-- Team: everyone in the Team collection, in its order, or the people chosen. --}}
@php
    $people = collect($block->members ?? [])->filter(fn ($entry) => $entry->published());
    if ($people->isEmpty()) {
        $people = collect(\Statamic\Statamic::tag('collection:team')->fetch());
    }
    $compact = (string) $block->layout === 'compact';
@endphp
@if ($people->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
        <ul
            role="list"
            @class([
                'mt-12 grid gap-x-8',
                'gap-y-12 sm:grid-cols-2 lg:grid-cols-4' => ! $compact,
                'gap-y-8 sm:grid-cols-2 lg:grid-cols-3' => $compact,
            ])
        >
            @foreach ($people as $person)
                <li><x-person-card :entry="$person" :layout="$compact ? 'compact' : 'cards'" /></li>
            @endforeach
        </ul>
    </x-section>
@endif
