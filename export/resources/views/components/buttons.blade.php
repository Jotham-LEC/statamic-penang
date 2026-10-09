{{-- A section's buttons (the `buttons` fieldset), and optionally WhatsApp. --}}
@props(['buttons' => [], 'whatsapp' => false, 'size' => 'lg'])
@php
    $buttons = collect(\Statamic\View\Blade\value($buttons) ?? [])->filter(fn ($b) => filled((string) $b->label) && \App\Support\Link::url($b->link));
    $whatsappUrl = $whatsapp ? \App\Support\Business::whatsappUrl() : null;
@endphp
@if ($buttons->isNotEmpty() || $whatsappUrl)
    <div {{ $attributes->class('flex flex-wrap gap-3') }}>
        @foreach ($buttons as $button)
            <x-ui.button
                :href="\App\Support\Link::url($button->link)"
                :variant="(string) $button->style ?: 'primary'"
                :size="$size"
            >
                {{ $button->label }}
            </x-ui.button>
        @endforeach
        @if ($whatsappUrl)
            <x-ui.button :href="$whatsappUrl" variant="outline" :size="$size" target="_blank" rel="noopener">
                <x-icon name="brands/whatsapp" class="size-5" />
                {{ __('WhatsApp us') }}
            </x-ui.button>
        @endif
    </div>
@endif
