{{-- Text: a heading and paragraphs, lists and quotes from the editor. --}}
@php($centred = (string) $block->alignment === 'centre')
@if (filled((string) $block->heading) || filled((string) $block->content))
    <x-section :block="$block">
        <div @class(['max-w-3xl', 'mx-auto text-center' => $centred])>
            <x-section-heading
                :eyebrow="$block->eyebrow"
                :heading="$block->heading"
                :intro="$block->intro"
                :align="$centred ? 'center' : 'left'"
            />
            @if (filled((string) $block->content))
                <div @class(['rich-text text-lg', 'mt-8' => filled((string) $block->heading) || filled((string) $block->intro)])>
                    {!! $block->content !!}
                </div>
            @endif
        </div>
    </x-section>
@endif
