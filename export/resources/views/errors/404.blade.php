{{-- Page not found. --}}
<x-layout :seo-title="\App\Support\Labels::get('not_found_title')" seo-status="404">
    <x-section spacing="roomy">
        <div class="mx-auto max-w-xl text-center">
            <p class="text-primary font-semibold">404</p>
            <h1 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">
                {{ \App\Support\Labels::get('not_found_title') }}
            </h1>
            <p class="text-muted-foreground mt-6 text-lg">{{ \App\Support\Labels::get('not_found_text') }}</p>
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <x-ui.button href="/">{{ \App\Support\Labels::get('not_found_home') }}</x-ui.button>
                @if ($contact = \App\Support\Business::contactUrl())
                    <x-ui.button :href="$contact" variant="outline">
                        {{ \App\Support\Labels::get('not_found_contact') }}</x-ui.button>
                @endif
            </div>
        </div>
    </x-section>
</x-layout>
