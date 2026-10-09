{{-- A labelled form field: input, textarea or select, with its help and error.
     The error is tied to the control (aria-describedby, aria-invalid). --}}
@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'error' => null,
    'help' => null,
    'required' => false,
    'options' => [],
])
@php
    $id = 'field-'.$name;
    $described = collect([$help ? "{$id}-help" : null, $error ? "{$id}-error" : null])->filter()->implode(' ');
    $control = 'block w-full rounded-control border bg-background px-3.5 py-2.5 text-base text-foreground placeholder:text-muted-foreground transition-colors focus-visible:outline-2 focus-visible:outline-offset-0 focus-visible:outline-ring '.($error ? 'border-destructive' : 'border-input');
@endphp
<div {{ $attributes->class('space-y-1.5') }}>
    <label for="{{ $id }}" class="block text-sm font-medium">
        {{ $label }}
        @unless ($required)
            <span class="text-muted-foreground font-normal">({{ __('optional') }})</span>
        @endunless
    </label>
    @if ($type === 'textarea')
        <textarea
            id="{{ $id }}"
            name="{{ $name }}"
            rows="5"
            class="{{ $control }}"
            @required($required)
            @if ($described) aria-describedby="{{ $described }}" @endif
            @if ($error) aria-invalid="true" @endif
        >{{ $value }}</textarea>
    @elseif ($type === 'select')
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            class="{{ $control }}"
            @required($required)
            @if ($described) aria-describedby="{{ $described }}" @endif
            @if ($error) aria-invalid="true" @endif
        >
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) $value === (string) $optionValue)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $value }}"
            class="{{ $control }}"
            @required($required)
            @if ($described) aria-describedby="{{ $described }}" @endif
            @if ($error) aria-invalid="true" @endif
            {{ $attributes->only('autocomplete') }}
        />
    @endif
    @if ($help)
        <p id="{{ $id }}-help" class="text-muted-foreground text-sm">{{ $help }}</p>
    @endif
    @if ($error)
        <p id="{{ $id }}-error" class="text-destructive text-sm font-medium">{{ $error }}</p>
    @endif
</div>
