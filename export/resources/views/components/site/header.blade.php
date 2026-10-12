{{-- The header: the logo or name, the Main menu (Navigation → Main menu), the
     button from Site settings, and the light/dark switch. A menu item with
     links under it opens them as a dropdown (a disclosure button: Escape or a
     click outside closes it, resources/js/site.js). Below lg the menu opens as
     a panel (the browser's popover), with those links listed under their item. --}}
@props(['modeToggle' => true])
@cascade(['settings' => null])
@php
    use App\Support\Business;

    $logo = Business::logo();
    $buttonLabel = \Statamic\View\Blade\value($settings?->header_button_label);
    $buttonLink = \App\Support\Link::url($settings?->header_button_link);
    $menu = collect(\Statamic\Statamic::tag('nav:main')->fetch() ?? [])->map(fn ($item) => [
        'title' => (string) \Statamic\View\Blade\value($item['title'] ?? ''),
        'url' => (string) \Statamic\View\Blade\value($item['url'] ?? ''),
        'current' => ! empty($item['is_current']),
        'active' => ! empty($item['is_current']) || ! empty($item['is_parent']),
        'children' => collect($item['children'] ?? [])->map(fn ($child) => [
            'title' => (string) \Statamic\View\Blade\value($child['title'] ?? ''),
            'url' => (string) \Statamic\View\Blade\value($child['url'] ?? ''),
            'current' => ! empty($child['is_current']),
        ])->filter(fn ($child) => $child['url'] !== '')->values()->all(),
    ]);
    $searchPage = \Statamic\View\Blade\value($settings?->search_page);
    $searchPage = $searchPage instanceof \Illuminate\Support\Collection ? $searchPage->first() : $searchPage;
    $searchUrl = $searchPage?->published() ? $searchPage->url() : null;
    $link = 'rounded-control hover:bg-accent hover:text-accent-foreground px-3 py-2 text-sm font-medium transition-colors';
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
                @foreach ($menu as $item)
                    @if ($item['children'])
                        <li class="relative flex items-center" data-disclosure>
                            @if ($item['url'])
                                <a
                                    href="{{ $item['url'] }}"
                                    @class([$link, 'pr-1', 'text-primary' => $item['active'], 'text-muted-foreground' => ! $item['active']])
                                    @if ($item['current']) aria-current="page" @endif
                                >{{ $item['title'] }}</a>
                            @endif
                            <button
                                type="button"
                                aria-expanded="false"
                                aria-controls="menu-{{ $loop->index }}"
                                data-disclosure-button
                                @class([
                                    $link,
                                    'inline-flex items-center gap-1',
                                    'px-1.5' => $item['url'],
                                    'text-primary' => $item['active'],
                                    'text-muted-foreground' => ! $item['active'],
                                ])
                            >
                                @if ($item['url'])
                                    <span class="sr-only">{{ __('More in :title', ['title' => $item['title']]) }}</span>
                                @else
                                    {{ $item['title'] }}
                                @endif
                                <x-icon name="chevron-down" class="size-4" />
                            </button>
                            <ul
                                id="menu-{{ $loop->index }}"
                                hidden
                                class="bg-card text-card-foreground border-border absolute top-full left-0 z-50 mt-2 min-w-56 rounded-lg border p-2 shadow-lg"
                            >
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a
                                            href="{{ $child['url'] }}"
                                            @class([
                                                'rounded-control hover:bg-accent hover:text-accent-foreground block px-3 py-2 text-sm font-medium',
                                                'text-primary' => $child['current'],
                                            ])
                                            @if ($child['current']) aria-current="page" @endif
                                        >{{ $child['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif ($item['url'])
                        <li>
                            <a
                                href="{{ $item['url'] }}"
                                @class([$link, 'text-primary' => $item['active'], 'text-muted-foreground' => ! $item['active']])
                                @if ($item['current']) aria-current="page" @endif
                            >{{ $item['title'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>

        <div class="flex items-center gap-2">
            @if ($buttonLabel && $buttonLink)
                {{-- In the menu panel on phones. --}}
                <span class="hidden sm:block">
                    <x-ui.button :href="$buttonLink" size="sm">{{ $buttonLabel }}</x-ui.button>
                </span>
            @endif

            @if ($searchUrl)
                <a
                    href="{{ $searchUrl }}"
                    class="rounded-control text-muted-foreground hover:bg-accent hover:text-accent-foreground inline-flex size-10 items-center justify-center"
                >
                    <span class="sr-only">{{ \App\Support\Labels::get('search') }}</span>
                    <x-icon name="search" class="size-5" />
                </a>
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
                <span class="sr-only">{{ \App\Support\Labels::get('menu') }}</span>
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
                <span class="sr-only">{{ \App\Support\Labels::get('close_menu') }}</span>
                <x-icon name="x" class="size-6" />
            </button>
        </div>
        <nav aria-label="{{ __('Main') }}" class="mt-6">
            <ul class="space-y-1">
                @foreach ($menu as $item)
                    <li>
                        @if ($item['url'])
                            <a
                                href="{{ $item['url'] }}"
                                @class(['rounded-control hover:bg-accent block px-3 py-3 text-base font-medium', 'text-primary' => $item['active']])
                                @if ($item['current']) aria-current="page" @endif
                            >{{ $item['title'] }}</a>
                        @else
                            <p class="text-muted-foreground px-3 pt-3 pb-1 text-sm font-semibold">
                                {{ $item['title'] }}
                            </p>
                        @endif
                        @if ($item['children'])
                            <ul class="border-border mb-2 ml-3 space-y-1 border-l pl-3">
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a
                                            href="{{ $child['url'] }}"
                                            @class(['rounded-control hover:bg-accent block px-3 py-2 text-base', 'text-primary' => $child['current']])
                                            @if ($child['current']) aria-current="page" @endif
                                        >{{ $child['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        @if ($buttonLabel && $buttonLink)
            <x-ui.button :href="$buttonLink" class="mt-6 w-full">{{ $buttonLabel }}</x-ui.button>
        @endif
    </div>
</header>
