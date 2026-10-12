{{-- The enquiry form, with the contact details beside it. --}}
@php($details = (bool) $block->show_details)
<x-section :block="$block">
    <div @class(['grid gap-12 lg:grid-cols-5 lg:gap-16' => $details, 'mx-auto max-w-2xl' => ! $details])>
        <div @class(['lg:col-span-2' => $details])>
            <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
            @if ($details)
                <x-contact-details :hours="false" class="mt-10" />
            @endif
        </div>
        <x-ui.card :class="\Illuminate\Support\Arr::toCssClasses(['lg:col-span-3' => $details, 'mt-10' => ! $details, 'sm:p-8'])">
            <x-enquiry-form
                :submit="(string) $block->submit_label"
                :success-title="(string) $block->success_title"
                :success-text="(string) $block->success_text"
            />
        </x-ui.card>
    </div>
</x-section>
