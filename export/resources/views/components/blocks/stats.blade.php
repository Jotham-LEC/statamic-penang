{{-- Figures: a row of numbers, or beside a picture. --}}
@php
    $stats = collect($block->stats ?? [])->filter(fn ($s) => filled((string) $s->value));
    $split = (string) $block->layout === 'split' && $block->image;
@endphp
@if ($stats->isNotEmpty())
    <x-section :block="$block">
        <div @class(['grid items-center gap-12 lg:grid-cols-2 lg:gap-16' => $split])>
            <div>
                <x-section-heading
                    :eyebrow="$block->eyebrow"
                    :heading="$block->heading"
                    :intro="$block->intro"
                    :align="$split ? 'left' : 'center'"
                />
                <dl @class([
                    'grid gap-8',
                    'mt-12' => filled((string) $block->heading) || filled((string) $block->intro),
                    'grid-cols-2' => $split,
                    'grid-cols-2 lg:grid-cols-4' => ! $split && $stats->count() >= 4,
                    'sm:grid-cols-3' => ! $split && $stats->count() === 3,
                    'sm:grid-cols-2' => ! $split && $stats->count() === 2,
                    'text-center' => ! $split,
                ])>
                    @foreach ($stats as $stat)
                        <div @class(['flex flex-col-reverse gap-1', 'border-primary border-l-2 pl-5' => $split])>
                            <dt class="text-muted-foreground">{{ $stat->label }}</dt>
                            <dd class="font-heading text-4xl font-semibold tracking-tight sm:text-5xl">
                                {{ $stat->value }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
            @if ($split)
                <x-picture
                    :image="$block->image"
                    sizes="(min-width: 1024px) 50vw, 100vw"
                    class="aspect-4/3 w-full rounded-xl object-cover"
                />
            @endif
        </div>
    </x-section>
@endif
