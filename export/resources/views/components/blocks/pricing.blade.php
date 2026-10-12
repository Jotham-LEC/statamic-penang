{{-- Prices: one to four packages side by side, each with its price, what it
     includes and a button; one can stand out, in the primary colour. --}}
@php
    $plans = collect($block->plans ?? [])->filter(fn ($plan) => filled((string) $plan->name))->values();
    $columns = match ($plans->count()) {
        1 => 'max-w-md mx-auto',
        2 => 'md:grid-cols-2 max-w-4xl mx-auto',
        3 => 'lg:grid-cols-3',
        default => 'md:grid-cols-2 xl:grid-cols-4',
    };
@endphp
@if ($plans->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading
            :eyebrow="$block->eyebrow"
            :heading="$block->heading"
            :intro="$block->intro"
            align="center"
        />
        <ul
            role="list"
            @class(['grid items-stretch gap-6 '.$columns, 'mt-12' => filled((string) $block->heading) || filled((string) $block->intro)])
        >
            @foreach ($plans as $plan)
                <li
                    @if ($plan->highlight) data-tone="primary" @endif
                    @class([
                        'border-border flex flex-col rounded-xl border p-8',
                        'bg-card text-card-foreground shadow-sm' => ! $plan->highlight,
                        'bg-background text-foreground shadow-lg' => $plan->highlight,
                    ])
                >
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
                        @if (filled((string) $plan->badge))
                            <x-ui.badge>{{ $plan->badge }}</x-ui.badge>
                        @endif
                    </div>
                    @if (filled((string) $plan->price))
                        <p class="mt-6">
                            <span class="font-heading text-4xl font-semibold tracking-tight">{{ $plan->price }}</span>
                            @if (filled((string) $plan->period))
                                <span class="text-muted-foreground text-sm">{{ $plan->period }}</span>
                            @endif
                        </p>
                    @endif
                    @if (filled((string) $plan->description))
                        <p class="text-muted-foreground mt-4 text-sm leading-relaxed">{{ $plan->description }}</p>
                    @endif
                    @php($features = collect(\Statamic\View\Blade\value($plan->features) ?? [])->filter(fn ($line) => filled($line)))
                    @if ($features->isNotEmpty())
                        <ul role="list" class="mt-6 space-y-3 text-sm">
                            @foreach ($features as $feature)
                                <li class="flex gap-3">
                                    <x-icon name="check" class="text-primary mt-0.5 size-4" />
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <x-buttons :buttons="$plan->buttons" class="[&>*]:flex-1 mt-auto pt-8" size="md" />
                </li>
            @endforeach
        </ul>
        @if (filled((string) $block->note))
            <p class="text-muted-foreground mt-8 text-center text-sm">{{ $block->note }}</p>
        @endif
    </x-section>
@endif
