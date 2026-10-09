{{-- The WhatsApp button, on every page once Site settings has a number. --}}
@php($url = \App\Support\Business::whatsappUrl())
@if ($url)
    <a
        href="{{ $url }}"
        target="_blank"
        rel="noopener"
        class="bg-primary text-primary-foreground hover:bg-primary-hover fixed right-4 bottom-4 z-30 inline-flex items-center gap-2 rounded-full p-3.5 shadow-lg transition-colors sm:right-6 sm:bottom-6 sm:px-5"
        data-whatsapp
    >
        <x-icon name="brands/whatsapp" class="size-6" />
        <span class="sr-only sm:not-sr-only sm:text-sm sm:font-semibold">{{ __('Chat on WhatsApp') }}</span>
    </a>
@endif
