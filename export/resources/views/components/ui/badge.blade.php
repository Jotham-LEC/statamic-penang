{{-- A short label: a category, "New", "Out of stock". --}}
@props(['variant' => 'secondary'])
<span
    {{
        $attributes->class([
            'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold',
            match ($variant) {
                'primary' => 'bg-primary text-primary-foreground',
                'outline' => 'border-border text-foreground border',
                'muted' => 'bg-muted text-muted-foreground',
                default => 'bg-secondary text-secondary-foreground',
            },
        ])
    }}
>{{ $slot }}</span>
