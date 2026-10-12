{{-- The footer: the business and its social links, the Footer menu
     (Navigation → Footer menu: a top-level item with links under it is a
     column), and the contact details from Marketing → Brand. --}}
@cascade(['settings' => null])
@php
    use App\Support\Business;
    use Statamic\Statamic;

    $menu = collect(Statamic::tag('nav:footer')->fetch() ?? []);
    $columns = $menu->filter(fn ($item) => ! empty($item['children']));
    $loose = $menu->filter(fn ($item) => empty($item['children']));
    $about = \Statamic\View\Blade\value($settings?->footer_text);
    $note = \Statamic\View\Blade\value($settings?->footer_note);
    $legal = \Statamic\View\Blade\value($settings?->legal_line);
    $numbers = Business::extraNumbers();
    $social = Business::socialLinks();
    $address = Business::addressLines();
@endphp
<footer data-tone="muted" class="bg-background text-foreground border-border border-t">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <p class="font-heading text-lg font-semibold">{{ Business::name() }}</p>
                @if ($about)
                    <p class="text-muted-foreground mt-3 max-w-sm text-sm leading-relaxed">{{ $about }}</p>
                @endif
                @if ($social)
                    <ul class="mt-6 flex flex-wrap gap-2">
                        @foreach ($social as $link)
                            <li>
                                <a
                                    href="{{ $link['url'] }}"
                                    class="rounded-control text-muted-foreground hover:bg-accent hover:text-accent-foreground inline-flex size-10 items-center justify-center"
                                    rel="me noopener"
                                    target="_blank"
                                >
                                    <x-icon :name="$link['icon']" class="size-5" />
                                    <span class="sr-only">{{ $link['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:col-span-8 lg:grid-cols-3">
                @foreach ($columns as $column)
                    <nav aria-label="{{ $column['title'] }}">
                        <p class="text-sm font-semibold">{{ $column['title'] }}</p>
                        <ul class="mt-4 space-y-3 text-sm">
                            @foreach ($column['children'] as $child)
                                <li>
                                    <a
                                        href="{{ $child['url'] }}"
                                        class="text-muted-foreground hover:text-foreground"
                                    >{{ $child['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                @endforeach

                @if ($loose->isNotEmpty())
                    <nav aria-label="{{ __('Footer') }}">
                        <p class="text-sm font-semibold">{{ \App\Support\Labels::get('footer_links') }}</p>
                        <ul class="mt-4 space-y-3 text-sm">
                            @foreach ($loose as $item)
                                <li>
                                    <a
                                        href="{{ $item['url'] }}"
                                        class="text-muted-foreground hover:text-foreground"
                                    >{{ $item['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                @endif

                @if (Business::phone() || $numbers || Business::email() || $address || $note)
                    <div>
                        <p class="text-sm font-semibold">{{ \App\Support\Labels::get('footer_contact') }}</p>
                        <ul class="text-muted-foreground mt-4 space-y-3 text-sm">
                            @if (Business::phone())
                                <li>
                                    <a
                                        href="{{ Business::phoneHref() }}"
                                        class="hover:text-foreground"
                                    >{{ Business::phone() }}</a>
                                </li>
                            @endif
                            @foreach ($numbers as $number)
                                <li>
                                    @if ($number['label'])
                                        <span class="block">{{ $number['label'] }}</span>
                                    @endif
                                    <a
                                        href="{{ $number['href'] }}"
                                        class="hover:text-foreground"
                                    >{{ $number['number'] }}</a>
                                    @if ($number['whatsapp'])
                                        ·
                                        <a
                                            href="{{ $number['whatsapp'] }}"
                                            target="_blank"
                                            rel="noopener"
                                            class="hover:text-foreground"
                                        >WhatsApp</a>
                                    @endif
                                </li>
                            @endforeach
                            @if (Business::email())
                                <li>
                                    <a
                                        href="mailto:{{ Business::email() }}"
                                        class="hover:text-foreground break-all"
                                    >{{ Business::email() }}</a>
                                </li>
                            @endif
                            @if ($address)
                                <li>
                                    <address class="not-italic">
                                        @foreach ($address as $line)
                                            {{ $line }}
                                            @if (! $loop->last)
                                                <br />
                                            @endif
                                        @endforeach
                                    </address>
                                </li>
                            @endif
                            @if ($note)
                                <li>{{ $note }}</li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <p class="border-border text-muted-foreground mt-12 border-t pt-8 text-sm">
            © {{ now()->year }} {{ Business::name() }}
            @if ($legal)
                <span class="mx-1" aria-hidden="true">·</span>
                {{ $legal }}
            @endif
        </p>
    </div>
</footer>
