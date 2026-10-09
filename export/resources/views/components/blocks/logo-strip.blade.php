{{-- Logos: a row, or a boxed grid. Each logo's alt text is the name. --}}
@php
    $logos = collect($block->logos ?? []);
    $grid = (string) $block->layout === 'grid';
@endphp
@if ($logos->isNotEmpty())
    <x-section :block="$block">
        @if (filled((string) $block->heading))
            <h2 class="text-muted-foreground text-center text-sm font-semibold tracking-wide uppercase">
                {{ $block->heading }}
            </h2>
        @endif
        <ul
            role="list"
            @class([
                'mt-10' => filled((string) $block->heading),
                'flex flex-wrap items-center justify-center gap-x-12 gap-y-8' => ! $grid,
                'border-border grid grid-cols-2 overflow-hidden rounded-lg border sm:grid-cols-3 lg:grid-cols-4' => $grid,
            ])
        >
            @foreach ($logos as $logo)
                <li @class(['border-border -mt-px -ml-px flex items-center justify-center border p-8' => $grid])>
                    <x-picture
                        :image="$logo"
                        :widths="[240, 480]"
                        sizes="160px"
                        class="h-10 w-auto max-w-40 object-contain opacity-80 grayscale transition hover:opacity-100 hover:grayscale-0"
                    />
                </li>
            @endforeach
        </ul>
    </x-section>
@endif
