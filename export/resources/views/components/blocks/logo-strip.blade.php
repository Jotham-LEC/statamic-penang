{{-- Logos: a row, a boxed grid, or a row scrolling past (paused on hover and
     for visitors who turn off motion, when it wraps like the row). Each
     logo's alt text is the name, and its link (in its details) makes it a
     link. --}}
@php
    $logos = collect($block->logos ?? []);
    $layout = (string) $block->layout ?: 'row';
    $grid = $layout === 'grid';
    $scrolling = $layout === 'scrolling';
@endphp
@if ($logos->isNotEmpty())
    <x-section :block="$block" :class="$scrolling ? 'overflow-hidden' : ''">
        @if (filled((string) $block->heading))
            <h2 class="text-muted-foreground text-center text-sm font-semibold tracking-wide uppercase">
                {{ $block->heading }}
            </h2>
        @endif
        <div @class(['mt-10' => filled((string) $block->heading), 'logo-marquee' => $scrolling])>
            @foreach ($scrolling ? [false, true] : [false] as $copy)
                <ul
                    role="list"
                    @if ($copy) aria-hidden="true" data-copy @endif
                    @class([
                        'flex flex-wrap items-center justify-center gap-x-12 gap-y-8' => $layout === 'row',
                        'border-border grid grid-cols-2 overflow-hidden rounded-lg border sm:grid-cols-3 lg:grid-cols-4' => $grid,
                        'logo-marquee-track flex shrink-0 items-center gap-x-16 pr-16' => $scrolling,
                    ])
                >
                    @foreach ($logos as $logo)
                        @php($url = \App\Support\Link::url($logo->augmentedValue('link')))
                        <li @class(['border-border -mt-px -ml-px flex items-center justify-center border p-8' => $grid, 'shrink-0' => $scrolling])>
                            @if ($url)
                                <a href="{{ $url }}" rel="noopener" @if ($copy) tabindex="-1" @endif>
                            @endif
                            <x-picture
                                :image="$logo"
                                :widths="[240, 480]"
                                sizes="160px"
                                :alt="$copy ? '' : null"
                                class="h-10 w-auto max-w-40 object-contain opacity-80 grayscale transition hover:opacity-100 hover:grayscale-0"
                            />
                            @if ($url)
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </x-section>
@endif
