{{-- A section's buttons (the `buttons` fieldset): each goes to a page or
     address, WhatsApp, a phone call, an email or a file (App\Support\Button).
     `whatsapp` adds a WhatsApp button: the Call to action's switch of
     Penang 1.1, still read for content saved before it became a button type. --}}
@props(['buttons' => [], 'whatsapp' => false, 'size' => 'lg'])
@php
    use App\Support\Button;

    $buttons = collect(\Statamic\View\Blade\value($buttons) ?? [])
        ->filter(fn ($b) => filled((string) $b->label))
        ->map(fn ($b) => ['label' => (string) $b->label, 'style' => (string) $b->style ?: 'primary', ...(Button::target($b) ?? ['href' => null])])
        ->filter(fn ($b) => $b['href']);
    if ($whatsapp && ($legacy = Button::target(['type' => 'whatsapp']))) {
        $buttons->push(['label' => __('WhatsApp us'), 'style' => 'outline', ...$legacy]);
    }
@endphp
@if ($buttons->isNotEmpty())
    <div {{ $attributes->class('flex flex-wrap gap-3') }}>
        @foreach ($buttons as $button)
            <x-ui.button
                :href="$button['href']"
                :variant="$button['style']"
                :size="$size"
                :target="$button['new_tab'] ? '_blank' : null"
                :rel="$button['new_tab'] ? 'noopener' : null"
            >
                @if ($button['icon'])
                    <x-icon :name="$button['icon']" class="size-5" />
                @endif
                {{ $button['label'] }}
            </x-ui.button>
        @endforeach
    </div>
@endif
