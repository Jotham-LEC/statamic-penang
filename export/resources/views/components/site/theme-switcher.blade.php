{{-- Try the theme without saving it: the presets and each setting, kept in
     this browser only (the penang_theme cookie, read by App\Theme\SiteTheme).
     Shown to someone signed in to the control panel, and to everyone on a demo
     site (PENANG_THEME_PREVIEW). Saving is done in the Theme global. --}}
@props(['theme'])
@php
    use App\Theme\Options;

    $settings = $theme->settings;
    $colours = collect(Options::COLOURS)->mapWithKeys(fn ($c) => [$c => ucfirst($c)])->all();
    $selects = [
        'preset' => [__('Preset'), collect(Options::PRESETS)->map->label->all()],
        'heading_font' => [__('Headings'), collect(Options::FONTS)->map->label->all()],
        'body_font' => [__('Text'), collect(Options::FONTS)->map->label->all()],
        'radius' => [__('Corners'), collect(Options::RADII)->map->label->all()],
        'base' => [__('Base colour'), Options::BASES],
        'primary' => [__('Primary'), $colours],
        'secondary' => [__('Secondary'), $colours],
    ];
@endphp
<div class="fixed bottom-4 left-4 z-30 sm:bottom-6 sm:left-6" data-theme-switcher>
    <button
        type="button"
        popovertarget="theme-switcher"
        class="bg-card text-card-foreground border-border hover:bg-accent inline-flex items-center gap-2 rounded-full border px-4 py-3 text-sm font-semibold shadow-lg"
    >
        <x-icon name="sparkles" class="size-5" />
        {{ __('Theme') }}
    </button>
    <form
        id="theme-switcher"
        popover
        class="bg-card text-card-foreground border-border m-0 mt-auto mb-20 ml-4 w-80 max-w-[calc(100vw-2rem)] space-y-3 rounded-lg border p-5 shadow-xl sm:ml-6"
        data-theme-form
    >
        <div class="flex items-center justify-between">
            <p class="font-heading font-semibold">{{ __('Try a theme') }}</p>
            <button
                type="button"
                popovertarget="theme-switcher"
                popovertargetaction="hide"
                class="rounded-control text-muted-foreground hover:bg-accent inline-flex size-8 items-center justify-center"
            >
                <span class="sr-only">{{ __('Close') }}</span>
                <x-icon name="x" class="size-4" />
            </button>
        </div>
        <p class="text-muted-foreground text-xs">
            {{ __('Only you see these choices. To keep them, set them in the control panel: Globals → Theme.') }}
        </p>
        @foreach ($selects as $key => [$label, $options])
            <x-ui.field
                :name="$key"
                :label="$label"
                type="select"
                :options="$options"
                :value="$settings[$key]"
                required
                class="text-sm"
            />
        @endforeach
        <div class="flex gap-2 pt-2">
            <x-ui.button type="submit" size="sm" class="flex-1">{{ __('Apply') }}</x-ui.button>
            <x-ui.button type="button" size="sm" variant="outline" data-theme-reset>{{ __('Reset') }}</x-ui.button>
        </div>
    </form>
</div>
