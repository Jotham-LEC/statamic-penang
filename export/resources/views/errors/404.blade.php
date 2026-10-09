{{-- Page not found. --}}
<x-layout :seo-title="__('Page not found')" seo-status="404">
    <x-section spacing="roomy">
        <div class="mx-auto max-w-xl text-center">
            <p class="text-primary font-semibold">404</p>
            <h1 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">{{ __('Page not found') }}</h1>
            <p class="text-muted-foreground mt-6 text-lg">
                {{ __('The page you’re looking for has moved or no longer exists.') }}
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <x-ui.button href="/">{{ __('Go to the home page') }}</x-ui.button>
                @if ($contact = \Statamic\Facades\Entry::findByUri('/contact'))
                    <x-ui.button :href="$contact->url()" variant="outline">{{ __('Contact us') }}</x-ui.button>
                @endif
            </div>
        </div>
    </x-section>
</x-layout>
