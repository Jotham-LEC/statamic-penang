{{-- Features: points with an icon, as a grid, as cards, or listed beside the
     heading. --}}
@php
    $layout = (string) $block->layout ?: 'grid';
    $items = collect($block->items ?? [])->filter(fn ($item) => filled((string) $item->title));
    $columns = match ((string) $block->columns) {
        '2' => 'sm:grid-cols-2',
        '4' => 'sm:grid-cols-2 lg:grid-cols-4',
        default => 'sm:grid-cols-2 lg:grid-cols-3',
    };
@endphp
@if ($items->isNotEmpty())
    <x-section :block="$block">
        <div @class(['grid gap-12 lg:grid-cols-5 lg:gap-16' => $layout === 'offset'])>
            <x-section-heading
                :eyebrow="$block->eyebrow"
                :heading="$block->heading"
                :intro="$block->intro"
                :align="$layout === 'offset' ? 'left' : 'center'"
                :class="$layout === 'offset' ? 'lg:col-span-2' : ''"
            />
            <dl @class([
                'grid gap-x-8 gap-y-10',
                $columns => $layout !== 'offset',
                'mt-16' => $layout !== 'offset' && (filled((string) $block->heading) || filled((string) $block->intro)),
                'sm:grid-cols-2 lg:col-span-3' => $layout === 'offset',
            ])>
                @foreach ($items as $item)
                    <div @class(['bg-card text-card-foreground border-border rounded-lg border p-6 shadow-sm' => $layout === 'cards'])>
                        <dt class="font-semibold">
                            @if (filled((string) $item->icon))
                                <span class="bg-primary text-primary-foreground rounded-control mb-4 flex size-11 items-center justify-center">
                                    <x-icon :name="(string) $item->icon" class="size-5" />
                                </span>
                            @endif
                            {{ $item->title }}
                        </dt>
                        @if (filled((string) $item->text))
                            <dd class="text-muted-foreground mt-2 leading-relaxed">{{ $item->text }}</dd>
                        @endif
                    </div>
                @endforeach
            </dl>
        </div>
    </x-section>
@endif
