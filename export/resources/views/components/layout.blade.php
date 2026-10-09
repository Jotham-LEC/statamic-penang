{{-- The site's shell: the head, the header, the page (the slot) and the footer,
     with the WhatsApp button and, where previews are allowed, the theme
     switcher. Each template fills the slot; pages without an entry (the 404)
     pass seo-title and seo-status to the Marketing Toolkit's tag. --}}
@props([
    'seoTitle' => null,
    'seoDescription' => null,
    'seoStatus' => 200,
])
{{-- The page the template shows, for the toolkit's tag: a component sees
     only what it is given, so it takes it from Statamic's cascade. --}}
@cascade(['page' => null])
@php
    use App\Theme\SiteTheme;

    $theme = SiteTheme::current();
    $mode = $theme->settings['mode'];
    $toggle = SiteTheme::modeToggle();
@endphp
<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @if ($mode !== 'system') data-theme="{{ $mode }}" @endif
    data-mode-default="{{ $mode }}"
>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- Title, description, canonical, share cards, structured data and
             analytics: the Marketing Toolkit (Marketing → Brand and Settings). --}}
    <s:mt:head :title="$seoTitle" :description="$seoDescription" :status="$seoStatus" />
    {{-- The Theme global as CSS custom properties (App\Theme\Theme). --}}
    <style id="theme-tokens">
        {!! $theme->css() !!}
    </style>
    @if ($toggle)
        {{-- The visitor's own choice of light or dark, before the page paints. --}}
        <script>
            (function () {
                try {
                    var mode = localStorage.getItem('penang-mode');
                    if (mode === 'light' || mode === 'dark') document.documentElement.setAttribute('data-theme', mode);
                } catch (e) {}
            })();
        </script>
    @endif
    @vite(['resources/css/site.css', 'resources/js/site.js'])
    @foreach (array_unique([$theme->font('heading')['key'], $theme->font('body')['key']]) as $font)
        <link
            rel="preload"
            as="font"
            type="font/woff2"
            crossorigin
            href="{{ Vite::asset("resources/fonts/{$font}/{$font}-latin-wght-normal.woff2") }}"
        />
    @endforeach
    @stack('head')
</head>
<body class="bg-background text-foreground flex min-h-screen flex-col font-sans">
    <s:mt:body />
    <a
        href="#main"
        class="bg-primary text-primary-foreground rounded-control fixed top-3 left-3 z-50 -translate-y-24 px-4 py-2 text-sm font-semibold focus-visible:translate-y-0"
    >{{ __('Skip to content') }}</a>

    <x-site.header :mode-toggle="$toggle" />

    <main id="main" tabindex="-1" class="flex-1 focus:outline-none">{{ $slot }}</main>

    <x-site.footer />
    <x-site.whatsapp />

    @if (SiteTheme::previewing())
        <x-site.theme-switcher :theme="$theme" />
    @endif
</body>
</html>
