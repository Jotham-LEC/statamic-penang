{{-- Phone, email, WhatsApp, address and opening hours, from Marketing →
     Brand and Site settings; each line only when it's filled in. --}}
@props(['hours' => true])
@php
    use App\Support\Business;

    $whatsapp = Business::whatsappUrl();
    $address = Business::addressLines();
    $openingHours = $hours ? Business::hours() : [];
@endphp
<dl {{ $attributes->class('space-y-6') }}>
    @if (Business::phone())
        <div class="flex gap-4">
            <dt>
                <x-icon name="phone" class="text-primary mt-0.5 size-5" /><span class="sr-only">{{ __('Phone') }}</span>
            </dt>
            <dd><a href="{{ Business::phoneHref() }}" class="hover:underline">{{ Business::phone() }}</a></dd>
        </div>
    @endif
    @if ($whatsapp)
        <div class="flex gap-4">
            <dt>
                <x-icon name="brands/whatsapp" class="text-primary mt-0.5 size-5" /><span class="sr-only"
                    >WhatsApp</span>
            </dt>
            <dd>
                <a
                    href="{{ $whatsapp }}"
                    target="_blank"
                    rel="noopener"
                    class="hover:underline"
                >{{ __('Chat on WhatsApp') }}</a>
            </dd>
        </div>
    @endif
    @if (Business::email())
        <div class="flex gap-4">
            <dt>
                <x-icon name="mail" class="text-primary mt-0.5 size-5" /><span class="sr-only">{{ __('Email') }}</span>
            </dt>
            <dd>
                <a href="mailto:{{ Business::email() }}" class="break-all hover:underline">{{ Business::email() }}</a>
            </dd>
        </div>
    @endif
    @if ($address)
        <div class="flex gap-4">
            <dt>
                <x-icon name="map-pin" class="text-primary mt-0.5 size-5" /><span
                    class="sr-only"
                    >{{ __('Address') }}</span>
            </dt>
            <dd>
                <address class="not-italic">
                    @foreach ($address as $line)
                        {{ $line }}
                        @if (! $loop->last)
                            <br />
                        @endif
                    @endforeach
                </address>
            </dd>
        </div>
    @endif
    @if ($openingHours)
        <div class="flex gap-4">
            <dt>
                <x-icon name="clock" class="text-primary mt-0.5 size-5" /><span
                    class="sr-only"
                    >{{ __('Opening hours') }}</span>
            </dt>
            <dd class="w-full max-w-xs">
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">
                        {{ __('Opening hours') }}
                    </caption>
                    @foreach ($openingHours as $row)
                        <tr>
                            <th scope="row" class="py-1 pr-4 font-medium">{{ $row['days'] }}</th>
                            <td class="text-muted-foreground py-1">{{ $row['hours'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </dd>
        </div>
    @endif
</dl>
