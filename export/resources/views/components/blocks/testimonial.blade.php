{{-- Testimonials: one large quote, or a grid of them. --}}
@php
    $quotes = collect($block->testimonials ?? [])->filter(fn ($t) => filled((string) $t->quote));
    $single = (string) $block->layout === 'single';
@endphp
@if ($quotes->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading
            :eyebrow="$block->eyebrow"
            :heading="$block->heading"
            :intro="$block->intro"
            align="center"
        />
        @if ($single)
            @php
                $quote = $quotes->first();
            @endphp
            <figure @class(['mx-auto max-w-3xl text-center', 'mt-12' => filled((string) $block->heading)])>
                <x-icon name="quote" class="text-primary mx-auto size-10" />
                <blockquote class="font-heading mt-6 text-2xl leading-snug font-medium sm:text-3xl">
                    <p>“{{ $quote->quote }}”</p>
                </blockquote>
                <figcaption class="mt-8 flex items-center justify-center gap-4">
                    <x-ui.avatar :image="$quote->photo" :name="(string) $quote->name" />
                    <div class="text-left">
                        <div class="font-semibold">{{ $quote->name }}</div>
                        @if (filled((string) $quote->role))
                            <div class="text-muted-foreground text-sm">{{ $quote->role }}</div>
                        @endif
                    </div>
                </figcaption>
            </figure>
        @else
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($quotes as $quote)
                    <figure class="bg-card text-card-foreground border-border flex flex-col rounded-lg border p-6 shadow-sm">
                        <blockquote class="flex-1 leading-relaxed">
                            <p>“{{ $quote->quote }}”</p>
                        </blockquote>
                        <figcaption class="border-border mt-6 flex items-center gap-3 border-t pt-6">
                            <x-ui.avatar :image="$quote->photo" :name="(string) $quote->name" size="sm" />
                            <div>
                                <div class="text-sm font-semibold">{{ $quote->name }}</div>
                                @if (filled((string) $quote->role))
                                    <div class="text-muted-foreground text-sm">{{ $quote->role }}</div>
                                @endif
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        @endif
    </x-section>
@endif
