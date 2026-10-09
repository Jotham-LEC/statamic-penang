{{-- One field of a Statamic form (an item of the form tag's `fields`), drawn
     with the kit's field component; other field types keep Statamic's own
     markup. Half-width fields pair up from sm. --}}
@props(['field'])
@php
    $type = match ($field['type']) {
        'textarea' => 'textarea',
        'select' => 'select',
        default => $field['input_type'] ?? 'text',
    };
    $required = in_array('required', $field['validate'] ?? [], true);
    $wide = $type === 'textarea' || ($field['width'] ?? 100) > 50;
@endphp
@if (in_array($field['type'], ['text', 'textarea', 'select'], true))
    <x-ui.field
        :name="$field['handle']"
        :label="$field['display']"
        :type="$type"
        :value="$field['old'] ?? null"
        :error="$field['error'] ?? null"
        :help="$field['instructions'] ?? null"
        :required="$required"
        :options="$field['options'] ?? []"
        :autocomplete="$field['autocomplete'] ?? null"
        :class="$wide ? 'sm:col-span-2' : ''"
    />
@else
    <div @class(['space-y-1.5', 'sm:col-span-2' => $wide])>
        <p class="text-sm font-medium">{{ $field['display'] }}</p>
        {!! $field['field'] !!}
    </div>
@endif
