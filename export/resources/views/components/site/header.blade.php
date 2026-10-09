{{-- The header: the logo or name, the Main menu (Navigation → Main menu), the
     button from Site settings, and the light/dark switch. Below lg the menu
     opens as a panel (the browser's popover: Escape or a click outside closes
     it). --}}
@props(['modeToggle' => true])
@cascade(['settings' => null])
@php
    use App\Support\Business;

    $logo = Business::logo();
    $buttonLabel = \Statamic\View\Blade\value($settings?->header_button_label);
    $buttonLink = \App\Support\Link::url($settings?->header_button_link);
@endphp
<header class="bg-background/90 border-border sticky top-0 z-40 border-b backdrop-blur">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-6 px-4 sm:px-6 lg:px-8">
        <a href="/" class="font-heading mr-auto flex items-center gap-2 text-lg font-semibold tracking-tight">
            @if ($logo)
                <img src="{{ $logo->url() }}" alt="{{ Business::name() }}" class="h-8 w-auto" />
            @else
                {{ Business::name() }}
            @endif
        </a>

        <nav aria-label="{{ __('Main') }}" class="hidden lg:block">
            <ul class="flex items-center gap-1">
                <s:nav:main>
                    <li>
                        <a
                            href="{{ $url }}"
                            @class([
                                'rounded-control hover:bg-accent hover:text-accent-foreground px-3 py-2 text-sm font-medium transition-colors',
                                'text-primary' => $is_current || $is_parent,
                                'text-muted-foreground' => ! ($is_current || $is_parent),
                            ])
                            @if ($is_current) aria-current="page" @endif
                        >{{ $title }}</a>
                    </li>
                </s:nav:main>
            </ul>
        </nav>

        <div class="flex items-center gap-2">
            @if ($buttonLabel && $buttonLink)
                {{-- In the menu panel on phones. --}}
                <span class="hidden sm:block">
                    <x-ui.button :href="$buttonLink" size="sm">{{ $buttonLabel }}</x-ui.button>
                </span>
            @endif

            @if ($modeToggle)
                <button
                    type="button"
                    class="rounded-control text-muted-foreground hover:bg-accent hover:text-accent-foreground inline-flex size-10 items-center justify-center"
                    data-mode-toggle
                >
                    <span class="sr-only">{{ __('Switch between light and dark') }}</span>
                    <x-icon name="sun" class="hidden size-5 dark:block" />
                    <x-icon name="moon" class="size-5 dark:hidden" />
                </button>
            @endif

            <button
                type="button"
                popovertarget="mobile-menu"
                class="rounded-control text-muted-foreground hover:bg-accent hover:text-accent-foreground inline-flex size-10 items-center justify-center lg:hidden"
            >
                <span class="sr-only">{{ __('Menu') }}</span>
                <x-icon name="menu" class="size-6" />
            </button>
        </div>
    </div>

    <div
        id="mobile-menu"
        popover
        class="bg-background text-foreground border-border backdrop:bg-overlay/50 m-0 ml-auto h-dvh w-full max-w-sm border-l p-6 shadow-xl"
    >
        <div class="flex items-center justify-between">
            <span class="font-heading text-lg font-semibold">{{ Business::name() }}</span>
            <button
                type="button"
                popovertarget="mobile-menu"
                popovertargetaction="hide"
                class="rounded-control text-muted-foreground hover:bg-accent inline-flex size-10 items-center justify-center"
            >
                <span class="sr-only">{{ __('Close menu') }}</span>
                <x-icon name="x" class="size-6" />
            </button>
        </div>
        <nav aria-label="{{ __('Main') }}" class="mt-6">
            <ul class="space-y-1">
                <s:nav:main>
                    <li>
                        <a
                            href="{{ $url }}"
                            @class([
                                'rounded-control hover:bg-accent block px-3 py-3 text-base font-medium',
                                'text-primary' => $is_current || $is_parent,
                            ])
                            @if ($is_current) aria-current="page" @endif
                        >{{ $title }}</a>
                    </li>
                </s:nav:main>
            </ul>
        </nav>
        @if ($buttonLabel && $buttonLink)
            <x-ui.button :href="$buttonLink" class="mt-6 w-full">{{ $buttonLabel }}</x-ui.button>
        @endif
    </div>
</header>
