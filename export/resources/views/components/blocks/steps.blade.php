{{-- Steps: numbered (or labelled with a date or a day, or with an icon),
     across the page or down it as a timeline. --}}
@php
    $steps = collect($block->steps ?? [])->filter(fn ($step) => filled((string) $step->title))->values();
    $vertical = (string) $block->layout === 'vertical';
    $columns = match (min($steps->count(), 4)) {
        2 => 'sm:grid-cols-2',
        3 => 'sm:grid-cols-3',
        4 => 'sm:grid-cols-2 lg:grid-cols-4',
        default => '',
    };
@endphp
@if ($steps->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading
            :eyebrow="$block->eyebrow"
            :heading="$block->heading"
            :intro="$block->intro"
            :align="$vertical ? 'left' : 'center'"
        />
        <ol
            role="list"
            @class([
                'mt-12' => filled((string) $block->heading) || filled((string) $block->intro),
                'grid gap-10 '.$columns => ! $vertical,
                'border-border ml-5 max-w-3xl space-y-10 border-l-2' => $vertical,
            ])
        >
            @foreach ($steps as $step)
                <li @class(['relative', 'pl-10' => $vertical])>
                    <span
                        @class([
                            'bg-primary text-primary-foreground font-heading inline-flex h-10 min-w-10 items-center justify-center rounded-full px-3 text-sm font-semibold',
                            'absolute top-0 -left-px -translate-x-1/2' => $vertical,
                        ])
                        aria-hidden="true"
                    >
                        @if (filled((string) $step->icon))
                            <x-icon :name="(string) $step->icon" class="size-5" />
                        @else
                            {{ filled((string) $step->label) ? $step->label : $loop->iteration }}
                        @endif
                    </span>
                    <h3 @class(['text-lg font-semibold', 'mt-5' => ! $vertical, 'pt-1.5' => $vertical])>
                        <span class="sr-only">{{ filled((string) $step->label) ? $step->label : $loop->iteration }}.</span>
                        {{ $step->title }}
                    </h3>
                    @if (filled((string) $step->text))
                        <p class="text-muted-foreground mt-2 leading-relaxed">{{ $step->text }}</p>
                    @endif
                </li>
            @endforeach
        </ol>
    </x-section>
@endif
