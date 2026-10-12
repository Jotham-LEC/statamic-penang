{{-- Video: YouTube (from youtube-nocookie.com), Vimeo or an uploaded file,
     behind a cover and a play button. Nothing loads from YouTube or Vimeo
     until the visitor presses play (resources/js/site.js swaps the button for
     the player). Wide, or beside text. --}}
@php
    use App\Support\Video;

    $player = Video::player((string) $block->source ?: 'youtube', (string) $block->url, $block->file);
    $split = (string) $block->layout === 'split';
    $title = (string) $block->title ?: __('Video');
@endphp
@if ($player)
    <x-section :block="$block">
        @unless ($split)
            <x-section-heading
                :eyebrow="$block->eyebrow"
                :heading="$block->heading"
                :intro="$block->intro"
                align="center"
                class="mb-12"
            />
        @endunless
        <div @class(['grid items-center gap-12 lg:grid-cols-2 lg:gap-16' => $split, 'mx-auto max-w-5xl' => ! $split])>
            <div
                @class(['bg-muted relative aspect-video overflow-hidden rounded-xl shadow-lg', 'lg:order-last' => $split && (string) $block->video_position !== 'left'])
                data-video="{{ $player['type'] }}"
                data-video-src="{{ $player['src'] }}"
                data-video-title="{{ $title }}"
            >
                <x-picture
                    :image="$block->poster"
                    sizes="(min-width: 1024px) 1024px, 100vw"
                    class="absolute inset-0 size-full object-cover"
                    alt=""
                />
                <button type="button" class="group absolute inset-0 flex items-center justify-center" data-video-play>
                    <span class="bg-primary text-primary-foreground group-hover:bg-primary-hover inline-flex size-16 items-center justify-center rounded-full shadow-lg transition-colors sm:size-20">
                        <x-icon name="play" class="ml-1 size-7 sm:size-8" />
                    </span>
                    <span class="sr-only">{{ __('Play the video: :title', ['title' => $title]) }}</span>
                </button>
            </div>
            @if ($split)
                <div>
                    <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
                    @if (filled((string) $block->content))
                        <div class="rich-text text-muted-foreground mt-6 text-lg">{!! $block->content !!}</div>
                    @endif
                    <x-buttons :buttons="$block->buttons" class="mt-8" size="md" />
                </div>
            @else
                <x-buttons :buttons="$block->buttons" class="mt-10 justify-center" />
            @endif
        </div>
    </x-section>
@endif
