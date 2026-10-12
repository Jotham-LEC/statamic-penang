{{-- The announcement bar (Site settings → Announcement), above the header on
     every page. A visitor who closes it doesn't see it again until its text
     changes (resources/js/site.js keeps a fingerprint of the text). --}}
@cascade(['settings' => null])
@php
    $text = trim((string) \Statamic\View\Blade\value($settings?->announcement));
    $link = \App\Support\Link::url($settings?->announcement_link);
    $label = trim((string) \Statamic\View\Blade\value($settings?->announcement_link_label)) ?: __('Find out more');
    $dismissible = \Statamic\View\Blade\value($settings?->announcement_dismissible) !== false;
@endphp
@if ($text !== '')
    <div
        data-tone="primary"
        class="bg-background text-foreground relative text-sm"
        data-announcement="{{ substr(md5($text.$link), 0, 12) }}"
    >
        <div class="mx-auto flex max-w-7xl items-center justify-center gap-x-4 gap-y-1 px-12 py-2.5 text-center max-sm:flex-col">
            <p class="rich-inline">{!! $text !!}</p>
            @if ($link)
                <a
                    href="{{ $link }}"
                    class="inline-flex items-center gap-1 font-semibold whitespace-nowrap underline underline-offset-4"
                >
                    {{ $label }} <x-icon name="arrow-right" class="size-4" />
                </a>
            @endif
        </div>
        @if ($dismissible)
            <button
                type="button"
                class="rounded-control hover:bg-accent absolute top-1/2 right-2 inline-flex size-8 -translate-y-1/2 items-center justify-center"
                data-announcement-close
            >
                <span class="sr-only">{{ __('Close the announcement') }}</span>
                <x-icon name="x" class="size-4" />
            </button>
        @endif
    </div>
    @if ($dismissible)
        {{-- Hidden before it paints, if this visitor closed this announcement. --}}
        <script>
            (function () {
                var bar = document.currentScript.previousElementSibling;
                try {
                    if (localStorage.getItem('penang-announcement') === bar.dataset.announcement) bar.hidden = true;
                } catch (e) {}
            })();
        </script>
    @endif
@endif
