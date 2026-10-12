{{-- The components page (/components): the theme's colours, type and every
     UI component, in each section tone, then the page's own sections: one of
     each kind, from the page builder. Choose a preset in the theme switcher
     (or Globals → Theme) and the whole page follows. Hidden from search
     engines by its SEO tab. --}}
@php
    use App\Theme\Options;
    use App\Theme\SiteTheme;

    $theme = SiteTheme::current();
    $settings = $theme->settings;
    $swatches = [
        'background' => 'bg-background text-foreground',
        'foreground' => 'bg-foreground text-background',
        'card' => 'bg-card text-card-foreground',
        'muted' => 'bg-muted text-muted-foreground',
        'primary' => 'bg-primary text-primary-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground',
        'accent' => 'bg-accent text-accent-foreground',
        'destructive' => 'bg-destructive text-destructive-foreground',
        'border' => 'bg-border text-foreground',
        'input' => 'bg-input text-background',
    ];
    $tones = ['default' => __('Page'), 'muted' => __('Muted'), 'primary' => __('Primary colour'), 'inverted' => __('Inverted')];
@endphp
<x-layout>
    <x-page-header
        :title="$page->title"
        :intro="__('Every part of the site in the current theme. Change the theme and this page follows.')"
    >
        <dl class="mt-8 flex flex-wrap gap-x-8 gap-y-3 text-sm">
            @foreach ([
                __('Preset') => Options::PRESETS[$settings['preset']]['label'],
                __('Headings') => $theme->font('heading')['label'],
                __('Text') => $theme->font('body')['label'],
                __('Corners') => Options::RADII[$settings['radius']]['label'],
                __('Base') => ucfirst($settings['base']),
                __('Primary') => ucfirst($settings['primary']),
                __('Secondary') => ucfirst($settings['secondary']),
            ] as $label => $value)
                <div>
                    <dt class="text-muted-foreground">{{ $label }}</dt>
                    <dd class="font-medium">{{ $value }}</dd>
                </div>
            @endforeach
        </dl>
    </x-page-header>

    <x-section>
        <x-section-heading
            eyebrow="Theme"
            :heading="__('Colours')"
            :intro="__('The theme’s colour tokens. Each comes in light and dark, and each text colour is chosen to read on its background.')"
        />
        <ul role="list" class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
            @foreach ($swatches as $name => $classes)
                <li class="border-border overflow-hidden rounded-lg border">
                    <div class="{{ $classes }} flex h-24 items-end p-3 text-sm font-semibold">Aa</div>
                    <p class="bg-card px-3 py-2 font-mono text-xs">{{ $name }}</p>
                </li>
            @endforeach
        </ul>
    </x-section>

    <x-section tone="muted">
        <x-section-heading eyebrow="Theme" :heading="__('Type')" />
        <div class="mt-10 grid gap-10 lg:grid-cols-2">
            <div class="space-y-4">
                <p class="font-heading text-5xl font-semibold tracking-tight">{{ __('Heading one') }}</p>
                <p class="font-heading text-4xl font-semibold tracking-tight">{{ __('Heading two') }}</p>
                <p class="font-heading text-2xl font-semibold">{{ __('Heading three') }}</p>
                <p class="font-heading text-lg font-semibold">{{ __('Heading four') }}</p>
            </div>
            <div class="rich-text">
                <p>
                    {{ __('Body text is set in the theme’s text font. It reads well at length, with room between the lines and a comfortable measure.') }}
                    <a href="#">{{ __('A link looks like this.') }}</a>
                </p>
                <ul>
                    <li>{{ __('Lists keep their markers') }}</li>
                    <li>{{ __('in the muted colour') }}</li>
                </ul>
                <blockquote><p>{{ __('A quote sits beside a rule in the primary colour.') }}</p></blockquote>
            </div>
        </div>
    </x-section>

    <x-section>
        <x-section-heading eyebrow="Components" :heading="__('Buttons, badges and alerts')" />
        <div class="mt-10 space-y-8">
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.button>{{ __('Primary') }}</x-ui.button>
                <x-ui.button variant="secondary">{{ __('Secondary') }}</x-ui.button>
                <x-ui.button variant="outline">{{ __('Outline') }}</x-ui.button>
                <x-ui.button variant="ghost">{{ __('Ghost') }}</x-ui.button>
                <x-ui.button variant="link">{{ __('Link') }}</x-ui.button>
                <x-ui.button disabled>{{ __('Disabled') }}</x-ui.button>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.button size="sm">{{ __('Small') }}</x-ui.button>
                <x-ui.button>{{ __('Medium') }}</x-ui.button>
                <x-ui.button size="lg">{{ __('Large') }}</x-ui.button>
                <x-ui.button size="lg">
                    <x-icon name="brands/whatsapp" class="size-5" /> {{ __('With an icon') }}</x-ui.button>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <x-ui.badge>{{ __('Secondary') }}</x-ui.badge>
                <x-ui.badge variant="primary">{{ __('Primary') }}</x-ui.badge>
                <x-ui.badge variant="outline">{{ __('Outline') }}</x-ui.badge>
                <x-ui.badge variant="muted">{{ __('Muted') }}</x-ui.badge>
            </div>
            <div class="grid gap-4 lg:grid-cols-2">
                <x-ui.alert :title="__('Thank you, your message is on its way.')">
                    {{ __('We’ll get back to you soon.') }}</x-ui.alert>
                <x-ui.alert variant="error" :title="__('Please check the form')">
                    {{ __('Some details are missing or need a fix, marked below.') }}</x-ui.alert>
            </div>
        </div>
    </x-section>

    <x-section tone="muted">
        <x-section-heading eyebrow="Components" :heading="__('Cards, people and forms')" />
        <div class="mt-10 grid gap-8 lg:grid-cols-3">
            <x-ui.card>
                <x-ui.badge>{{ __('New') }}</x-ui.badge>
                <h3 class="mt-4 text-lg font-semibold">{{ __('A card') }}</h3>
                <p class="text-muted-foreground mt-2 text-sm">
                    {{ __('A raised surface for a group of things, in the section’s tone.') }}
                </p>
                <x-ui.button variant="outline" size="sm" class="mt-6">{{ __('Action') }}</x-ui.button>
            </x-ui.card>
            <x-ui.card class="space-y-5">
                <div class="flex items-center gap-4">
                    <x-ui.avatar name="Nur Aisyah" />
                    <div>
                        <p class="font-semibold">Nur Aisyah</p>
                        <p class="text-muted-foreground text-sm">{{ __('Initials when there is no photo') }}</p>
                    </div>
                </div>
                <div class="flex -space-x-2">
                    @foreach (['Tan Wei Ming', 'Luca Moretti', 'Siti Rahman', 'Lim Mei Ling'] as $name)
                        <x-ui.avatar :name="$name" size="sm" class="ring-card ring-2" />
                    @endforeach
                </div>
            </x-ui.card>
            <x-ui.card class="space-y-4">
                <x-ui.field name="demo_name" :label="__('Your name')" value="Aisyah" required />
                <x-ui.field
                    name="demo_email"
                    :label="__('Email')"
                    type="email"
                    value="aisyah@"
                    required
                    :error="__('Enter a valid email address.')"
                />
                <x-ui.field name="demo_note" :label="__('Note')" :help="__('Help text explains a field.')" />
            </x-ui.card>
        </div>
    </x-section>

    <section aria-labelledby="tones-heading">
        <h2 id="tones-heading" class="sr-only">{{ __('Section backgrounds') }}</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($tones as $tone => $label)
                <div
                    @if ($tone !== 'default') data-tone="{{ $tone }}" @endif
                    class="bg-background text-foreground border-border space-y-4 border p-8"
                >
                    <p class="text-sm font-semibold tracking-wide uppercase">{{ $label }}</p>
                    <p class="text-muted-foreground text-sm">
                        {{ __('A section’s background sets every colour inside it.') }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.button size="sm">{{ __('Primary') }}</x-ui.button>
                        <x-ui.button size="sm" variant="outline">{{ __('Outline') }}</x-ui.button>
                    </div>
                    <x-ui.card class="text-sm">{{ __('A card') }}</x-ui.card>
                </div>
            @endforeach
        </div>
    </section>

    <x-section>
        <x-section-heading
            eyebrow="Components"
            :heading="__('Icons')"
            :intro="__('A few of the :count Lucide icons the Features section offers (all at lucide.dev).', ['count' => number_format(count(glob(resource_path('icons/ui/*.svg'))))])"
        />
        <ul role="list" class="mt-10 grid grid-cols-4 gap-4 sm:grid-cols-6 lg:grid-cols-10">
            @foreach (['coffee', 'leaf', 'clock', 'truck', 'gift', 'heart', 'star', 'award', 'shield-check', 'users', 'package', 'sparkles', 'phone', 'mail', 'map-pin', 'calendar', 'banknote', 'pencil', 'cake', 'flower-2', 'hand-heart', 'store', 'wrench', 'zap', 'smile', 'thumbs-up', 'badge-percent', 'message-circle', 'camera', 'scissors'] as $icon)
                <li class="border-border flex flex-col items-center gap-2 rounded-lg border p-3">
                    <x-icon :name="$icon" class="size-6" />
                    <span class="text-muted-foreground text-center font-mono text-[10px]">{{ $icon }}</span>
                </li>
            @endforeach
        </ul>
    </x-section>

    @if (count($page->blocks ?? []))
        <div class="border-border border-t">
            <x-section spacing="compact">
                <x-section-heading
                    eyebrow="Page builder"
                    :heading="__('Sections')"
                    :intro="__('One of each section, as editors add them in the control panel.')"
                />
            </x-section>
            <x-blocks :blocks="$page->blocks" />
        </div>
    @endif
</x-layout>
