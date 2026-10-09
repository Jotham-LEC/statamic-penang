{{-- A card: a raised surface in the section's tone. --}}
@props(['padded' => true])
<div {{ $attributes->class(['bg-card text-card-foreground border-border rounded-lg border shadow-sm', 'p-6' => $padded]) }}>
    {{ $slot }}
</div>
