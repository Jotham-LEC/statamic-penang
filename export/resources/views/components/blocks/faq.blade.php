{{-- Questions: each opens to its answer (<details>, no script needed), as
     one column or beside the heading. The Marketing Toolkit lists them as
     structured data (config/marketing-toolkit.php, faq_field). --}}
@php
    $items = collect($block->items ?? [])->filter(fn ($i) => filled((string) $i->question) && filled((string) $i->answer));
    $side = (string) $block->layout === 'side';
@endphp
@if ($items->isNotEmpty())
    <x-section :block="$block">
        <div @class(['grid gap-12 lg:grid-cols-3 lg:gap-16' => $side, 'mx-auto max-w-3xl' => ! $side])>
            <x-section-heading
                :eyebrow="$block->eyebrow"
                :heading="$block->heading"
                :intro="$block->intro"
                :align="$side ? 'left' : 'center'"
            />
            <div @class(['divide-border border-border divide-y border-y', 'mt-12' => ! $side, 'lg:col-span-2' => $side])>
                @foreach ($items as $item)
                    <details class="group py-5" name="faq-{{ $block->id }}">
                        <summary class="[&::-webkit-details-marker]:hidden flex cursor-pointer list-none items-start justify-between gap-6 text-lg font-semibold">
                            {{ $item->question }}
                            <x-icon name="plus" class="text-muted-foreground mt-1 size-5 group-open:hidden" />
                            <x-icon name="minus" class="text-muted-foreground mt-1 hidden size-5 group-open:block" />
                        </summary>
                        <div class="rich-text text-muted-foreground mt-4 pr-10">{!! $item->answer !!}</div>
                    </details>
                @endforeach
            </div>
        </div>
    </x-section>
@endif
