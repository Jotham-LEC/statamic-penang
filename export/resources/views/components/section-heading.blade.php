{{-- A section's eyebrow, heading and introduction (an inline Bard field: its
     bold, italics and links are HTML); nothing when all are empty. --}}
@props(['eyebrow' => null, 'heading' => null, 'intro' => null, 'align' => 'left', 'level' => 'h2'])
@if (filled((string) $eyebrow) || filled((string) $heading) || filled((string) $intro))
    <div {{ $attributes->class(['max-w-2xl', 'mx-auto text-center' => $align === 'center']) }}>
        @if (filled((string) $eyebrow))
            <p class="text-primary text-sm font-semibold tracking-wide uppercase">{{ $eyebrow }}</p>
        @endif
        @if (filled((string) $heading))
            <{{ $level }}
                @class([
                    'text-3xl font-semibold tracking-tight sm:text-4xl',
                    'mt-2' => filled((string) $eyebrow),
                ])
                >{{ $heading }}</{{ $level }}
            >
        @endif
        @if (filled((string) $intro))
            <p class="rich-inline text-muted-foreground mt-4 text-lg leading-relaxed">{!! $intro !!}</p>
        @endif
    </div>
@endif
