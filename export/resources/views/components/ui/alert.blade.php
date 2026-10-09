{{-- A message: success after sending a form, or what went wrong. --}}
@props(['variant' => 'success', 'title' => null])
<div
    role="{{ $variant === 'error' ? 'alert' : 'status' }}"
    {{
        $attributes->class([
            'flex gap-3 rounded-lg border p-4 text-sm',
            'border-destructive text-destructive bg-background' => $variant === 'error',
            'border-primary bg-accent text-accent-foreground' => $variant !== 'error',
        ])
    }}
>
    <x-icon :name="$variant === 'error' ? 'x' : 'check'" class="mt-0.5 size-5" />
    <div>
        @if ($title)
            <p class="font-semibold">{{ $title }}</p>
        @endif
        <div @class(['mt-1' => $title])>{{ $slot }}</div>
    </div>
</div>
