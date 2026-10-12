{{-- Testimonials: one large quote, a grid, or a carousel (scrolling sideways,
     with previous and next buttons; resources/js/site.js). A quote can carry
     stars, where it was left and a company logo. The single quote can be a
     note from the team instead: signed by several people, with their
     signatures (or their names by hand) and a sign-off. Buttons follow. --}}
@php
    $quotes = collect($block->testimonials ?? [])->filter(fn ($t) => filled((string) $t->quote))->values();
    $layout = (string) $block->layout ?: 'grid';
    $paragraphs = fn ($text) => collect(preg_split('/\n\s*\n/', trim((string) $text)))->filter();
@endphp
@if ($quotes->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading
            :eyebrow="$block->eyebrow"
            :heading="$block->heading"
            :intro="$block->intro"
            align="center"
        />
        @if ($layout === 'single')
            @php
                $quote = $quotes->first();
                $signatories = collect($block->signatories ?? [])->filter(fn ($s) => filled((string) $s->name));
                // A long quote reads as a letter, in body text.
                $long = mb_strlen((string) $quote->quote) > 300;
            @endphp
            <figure @class(['mx-auto max-w-3xl', 'text-center' => ! $long, 'mt-12' => filled((string) $block->heading)])>
                @unless ($long)
                    <x-icon name="quote" class="text-primary mx-auto size-10" />
                @endunless
                <blockquote @class([
                    'mt-6 space-y-5',
                    'font-heading text-2xl leading-snug font-medium sm:text-3xl' => ! $long,
                    'text-lg leading-relaxed' => $long,
                ])>
                    @foreach ($paragraphs($quote->quote) as $paragraph)
                        <p>{{ $long ? $paragraph : '“'.$paragraph.'”' }}</p>
                    @endforeach
                </blockquote>
                <x-testimonial-meta :quote="$quote" :class="$long ? 'mt-6' : 'mt-6 justify-center'" />
                @if ($signatories->isNotEmpty())
                    <figcaption class="mt-10">
                        @if (filled((string) $block->sign_off))
                            <p class="font-heading text-lg italic">{{ $block->sign_off }}</p>
                        @endif
                        <div @class(['mt-6 flex flex-wrap gap-10', 'justify-center' => ! $long])>
                            @foreach ($signatories as $person)
                                <div @class(['text-center' => ! $long])>
                                    @if ($person->signature)
                                        <x-picture
                                            :image="$person->signature"
                                            :widths="[240, 480]"
                                            sizes="200px"
                                            class="h-14 w-auto max-w-48 object-contain"
                                            alt=""
                                        />
                                    @elseif ($block->signature_names)
                                        {{-- The name by hand; it follows in print, so this is decorative. --}}
                                        <p class="font-signature text-primary text-5xl leading-none" aria-hidden="true">
                                            {{ $person->name }}
                                        </p>
                                    @elseif ($person->photo)
                                        <x-ui.avatar :image="$person->photo" :name="(string) $person->name" />
                                    @endif
                                    <div class="mt-3 font-semibold">{{ $person->name }}</div>
                                    @if (filled((string) $person->role))
                                        <div class="text-muted-foreground text-sm">{{ $person->role }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </figcaption>
                @elseif (filled((string) $quote->name))
                    <figcaption @class(['mt-8 flex items-center gap-4', 'justify-center' => ! $long])>
                        @if ($quote->logo)
                            <x-picture
                                :image="$quote->logo"
                                :widths="[240, 480]"
                                sizes="160px"
                                class="h-10 w-auto max-w-32 object-contain"
                            />
                        @else
                            <x-ui.avatar :image="$quote->photo" :name="(string) $quote->name" />
                        @endif
                        <div class="text-left">
                            <div class="font-semibold">{{ $quote->name }}</div>
                            @if (filled((string) $quote->role))
                                <div class="text-muted-foreground text-sm">{{ $quote->role }}</div>
                            @endif
                        </div>
                    </figcaption>
                @endif
            </figure>
            <x-buttons
                :buttons="$block->buttons"
                :class="$long ? 'mx-auto mt-10 max-w-3xl' : 'mt-10 justify-center'"
                size="md"
            />
        @else
            @php($carousel = $layout === 'carousel')
            <div @if ($carousel) data-carousel @endif class="mt-12">
                <ul
                    role="list"
                    @class([
                        'grid gap-6 sm:grid-cols-2 lg:grid-cols-3' => ! $carousel,
                        'flex snap-x snap-mandatory gap-6 overflow-x-auto scroll-smooth pb-4 [scrollbar-width:none] motion-reduce:scroll-auto' => $carousel,
                    ])
                    @if ($carousel) tabindex="0" aria-label="{{ (string) $block->heading ?: __('Testimonials') }}" data-carousel-track @endif
                >
                    @foreach ($quotes as $quote)
                        <li @class(['flex', 'w-[85%] shrink-0 snap-start sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]' => $carousel])>
                            <figure class="bg-card text-card-foreground border-border flex w-full flex-col rounded-lg border p-6 shadow-sm">
                                <x-testimonial-meta :quote="$quote" class="mb-4" />
                                <blockquote class="flex-1 space-y-4 leading-relaxed">
                                    @foreach ($paragraphs($quote->quote) as $paragraph)
                                        <p>{{ $loop->first ? '“' : '' }}{{ $paragraph }}{{ $loop->last ? '”' : '' }}</p>
                                    @endforeach
                                </blockquote>
                                @if (filled((string) $quote->name))
                                    <figcaption class="border-border mt-6 flex items-center gap-3 border-t pt-6">
                                        <x-ui.avatar :image="$quote->photo" :name="(string) $quote->name" size="sm" />
                                        <div class="flex-1">
                                            <div class="text-sm font-semibold">{{ $quote->name }}</div>
                                            @if (filled((string) $quote->role))
                                                <div class="text-muted-foreground text-sm">{{ $quote->role }}</div>
                                            @endif
                                        </div>
                                        @if ($quote->logo)
                                            <x-picture
                                                :image="$quote->logo"
                                                :widths="[240]"
                                                sizes="120px"
                                                class="h-8 w-auto max-w-24 object-contain"
                                            />
                                        @endif
                                    </figcaption>
                                @endif
                            </figure>
                        </li>
                    @endforeach
                </ul>
                @if ($carousel)
                    <div class="mt-6 flex justify-end gap-2">
                        <x-ui.button variant="outline" size="sm" data-carousel-prev>
                            <x-icon name="chevron-left" class="size-4" /><span
                                class="sr-only"
                                >{{ __('Previous') }}</span>
                        </x-ui.button>
                        <x-ui.button variant="outline" size="sm" data-carousel-next>
                            <x-icon name="chevron-right" class="size-4" /><span class="sr-only">{{ __('Next') }}</span>
                        </x-ui.button>
                    </div>
                @endif
            </div>
            <x-buttons :buttons="$block->buttons" class="mt-10 justify-center" size="md" />
        @endif
    </x-section>
@endif
