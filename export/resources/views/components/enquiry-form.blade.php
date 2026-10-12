{{-- The enquiry form (Forms → Enquiry: Statamic Core has one form). Its fields
     are the form's blueprint, so a field added in the control panel shows
     here. Submissions are stored under Forms → Enquiry, and emailed where its
     settings say. After sending, the page comes back to the form. Statamic compiles
     what is inside the form tag on its own, so no PHP blocks go there. The
     button and thank-you wording come from the Enquiry form section. --}}
@props(['submit' => null, 'successTitle' => null, 'successText' => null])
@php
    $anchor = url()->current().'#enquiry';
    $submit = filled($submit) ? $submit : __('Send message');
    $successTitle = filled($successTitle) ? $successTitle : __('Thank you, your message is on its way.');
    $successText = filled($successText) ? $successText : __('We’ll get back to you soon.');
@endphp
@if (\Statamic\Facades\Form::find('enquiry'))
    <s:form:create in="enquiry" :redirect="$anchor" :error_redirect="$anchor" class="space-y-6" id="enquiry" novalidate>
        @if ($success)
            <x-ui.alert :title="$successTitle"> {{ $successText }} </x-ui.alert>
        @elseif (! empty($errors))
            <x-ui.alert variant="error" :title="__('Please check the form')">
                {{ __('Some details are missing or need a fix, marked below.') }}
            </x-ui.alert>
        @endif

        <div class="grid gap-6 sm:grid-cols-2">
            @foreach ($fields as $field)
                <x-form-field :field="$field" />
            @endforeach
        </div>

        {{-- A field people never see; a bot fills it in, and Statamic drops the submission. --}}
        <div class="sr-only" aria-hidden="true">
            <label
                >{{ __('Leave this empty') }}
                <input type="text" name="{{ $honeypot }}" tabindex="-1" autocomplete="off"
            /></label>
        </div>

        <x-ui.button type="submit" size="lg">{{ $submit }}</x-ui.button>
    </s:form:create>
@endif
