{{-- The email a visitor gets after sending the enquiry form, when Forms →
     Enquiry → Configure → Email has one to `{{ email }}` with this HTML view
     (emails/enquiry-confirmation). It thanks them and repeats what they sent,
     in the theme's colours (as hex: mail programs take no OKLCH colours) and fonts' fallbacks. --}}
@php
    use App\Support\Business;
    use App\Theme\SiteTheme;

    $tokens = SiteTheme::current()->palette()['default']['light'];
    $c = fn (string $token) => ($tokens[$token] instanceof \App\Theme\Mix ? $tokens[$token]->colour() : $tokens[$token])->hex();
    $font = 'ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif';
    $name = trim((string) ($name ?? ''));
    $sent = collect($fields ?? [])->filter(fn ($field) => filled((string) $field['value']) && ! in_array($field['handle'], ['fax'], true));
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Thank you for your message') }}</title>
</head>
<body style="margin: 0; padding: 0; background: {{ $c('muted') }}; font-family: {{ $font }}; color: {{ $c('foreground') }}">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background: {{ $c('muted') }}">
        <tr>
            <td align="center" style="padding: 32px 16px">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 560px; background: {{ $c('card') }}; border: 1px solid {{ $c('border') }}; border-radius: 12px">
                    <tr>
                        <td style="padding: 32px 32px 0; font-size: 18px; font-weight: 600">{{ Business::name() }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 24px 32px 0">
                            <h1 style="margin: 0; font-size: 24px; line-height: 1.3">
                                {{ $name !== '' ? __('Thank you, :name', ['name' => $name]) : __('Thank you for your message') }}
                            </h1>
                            <p style="margin: 16px 0 0; font-size: 16px; line-height: 1.6; color: {{ $c('muted-foreground') }}">
                                {{ __('We’ve received your message and will get back to you soon. This is what you sent:') }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 24px 32px 0">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-top: 1px solid {{ $c('border') }}">
                                @foreach ($sent as $field)
                                    <tr>
                                        <td style="padding: 12px 0; border-bottom: 1px solid {{ $c('border') }}; font-size: 14px">
                                            <div style="font-weight: 600">{{ $field['display'] }}</div>
                                            <div style="margin-top: 4px; white-space: pre-line; color: {{ $c('muted-foreground') }}">{{ (string) $field['value'] }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 24px 32px 32px; font-size: 14px; line-height: 1.6; color: {{ $c('muted-foreground') }}">
                            @if ($whatsapp = Business::whatsappUrl())
                                <a href="{{ $whatsapp }}" style="display: inline-block; margin-bottom: 16px; padding: 10px 18px; border-radius: 8px; background: {{ $c('primary') }}; color: {{ $c('primary-foreground') }}; font-weight: 600; text-decoration: none">{{ \App\Support\Labels::get('whatsapp') }}</a><br />
                            @endif
                            @if (Business::phone())
                                {{ Business::phone() }}<br />
                            @endif
                            @if (Business::email())
                                <a href="mailto:{{ Business::email() }}" style="color: {{ $c('primary') }}">{{ Business::email() }}</a><br />
                            @endif
                            <a href="{{ url('/') }}" style="color: {{ $c('primary') }}">{{ preg_replace('#^https?://#', '', rtrim(url('/'), '/')) }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
