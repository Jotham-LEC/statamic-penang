{{-- Tabs: a few titled panels, one shown at a time (the ARIA tabs pattern:
     arrow keys move between tabs; resources/js/site.js). Each panel has text
     and an optional picture beside it. --}}
@php
    $tabs = collect($block->tabs ?? [])->filter(fn ($tab) => filled((string) $tab->title))->values();
    $id = 'tabs-'.$block->id;
@endphp
@if ($tabs->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading
            :eyebrow="$block->eyebrow"
            :heading="$block->heading"
            :intro="$block->intro"
            align="center"
        />
        <div
            @class(['mx-auto max-w-5xl', 'mt-12' => filled((string) $block->heading) || filled((string) $block->intro)])
            data-tabs
        >
            <div role="tablist" class="border-border flex gap-1 overflow-x-auto border-b">
                @foreach ($tabs as $tab)
                    <button
                        type="button"
                        role="tab"
                        id="{{ $id }}-tab-{{ $loop->index }}"
                        aria-controls="{{ $id }}-panel-{{ $loop->index }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                        tabindex="{{ $loop->first ? '0' : '-1' }}"
                        class="text-muted-foreground hover:text-foreground aria-selected:border-primary aria-selected:text-foreground -mb-px border-b-2 border-transparent px-4 py-3 text-sm font-semibold whitespace-nowrap"
                    >
                        {{ $tab->title }}
                    </button>
                @endforeach
            </div>
            @foreach ($tabs as $tab)
                <div
                    role="tabpanel"
                    id="{{ $id }}-panel-{{ $loop->index }}"
                    aria-labelledby="{{ $id }}-tab-{{ $loop->index }}"
                    tabindex="0"
                    @class(['grid items-center gap-10 pt-10', 'lg:grid-cols-2' => $tab->image])
                    @unless ($loop->first) hidden @endunless
                >
                    <div class="rich-text text-lg">{!! $tab->content !!}</div>
                    @if ($tab->image)
                        <x-picture
                            :image="$tab->image"
                            sizes="(min-width: 1024px) 512px, 100vw"
                            class="aspect-4/3 w-full rounded-xl object-cover"
                        />
                    @endif
                </div>
            @endforeach
        </div>
    </x-section>
@endif
