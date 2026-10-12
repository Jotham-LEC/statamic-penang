{{-- Try a preset without saving it, kept in this browser only (the
     penang_theme cookie, read by App\Theme\SiteTheme).
     Shown to someone signed in to the control panel, and to everyone on a demo
     site (PENANG_THEME_PREVIEW). Saving is done in the Theme global. --}}
@props(['theme'])
@php
    use App\Theme\Options;

    $presets = collect(Options::PRESETS)->map->label->all();
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
            {{ __('Only you see this. To keep a preset, choose it in the control panel: Globals → Theme.') }}
        </p>
        <x-ui.field
            name="preset"
            :label="__('Preset')"
            type="select"
            :options="$presets"
            :value="$theme->settings['preset']"
            required
            class="text-sm"
        />
        <div class="flex gap-2 pt-2">
            <x-ui.button type="button" size="sm" variant="outline" class="flex-1" data-theme-reset>
                {{ __('Back to the saved theme') }}</x-ui.button>
        </div>
    </form>
</div>
