{{-- The page builder: each section (a set of the `blocks` Replicator, in the
     control panel's order) renders components/blocks/{type}. A section
     switched off in the control panel never reaches here; a type with no
     view is skipped, and so is one the blueprint no longer has (Statamic
     passes it on as a plain array). --}}
@props(['blocks' => []])
@foreach (\Statamic\View\Blade\value($blocks) ?? [] as $block)
    @php($view = $block instanceof \Statamic\Fields\Values ? 'components.blocks.'.str_replace('_', '-', (string) $block->type) : null)
    @if ($view && view()->exists($view))
        <div data-block="{{ $block->type }}" class="contents">
            @include($view, ['block' => $block, 'first' => $loop->first])
        </div>
    @endif
@endforeach
