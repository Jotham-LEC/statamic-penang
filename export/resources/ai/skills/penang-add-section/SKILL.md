---
name: penang-add-section
description: "Use when adding a new section type to a Penang site's page builder, or a new layout or field to an existing section (hero, features, testimonials, prices…). Covers the page_builder fieldset set, its Blade view, the theme's colour tokens and backgrounds, empty fields, and checking it on /components."
license: proprietary
metadata:
  author: jotham-lec
---

# Penang: add a section

A section is a set of the `blocks` Replicator in `resources/fieldsets/page_builder.yaml`, drawn by `resources/views/components/blocks/{handle-with-dashes}.blade.php`. Start by looking at the existing sections with the `penang-sections` tool, and copy the one closest to what you need.

## Steps

1. **Add the set** under `fields.0.field.sets.sections.sets` in `page_builder.yaml` (or in the control panel: Fieldsets → Page builder):
   - `display`, a one-line `instructions` (shown in the section picker) and `image` (a picture for the picker in `public/assets/set-previews/`, about 800 × 400).
   - Fields with short `display` names an editor understands. Use a `button_group` named `layout` for layouts, `import: buttons` for buttons, and an inline Bard (`inline: true`, buttons bold/italic/anchor) for short texts that need links.
   - End with `import: section_options` (background, spacing, anchor).
2. **Add the view**, `components/blocks/{handle-with-dashes}.blade.php`:

```blade
{{-- What the section is, in one sentence, and its layouts. --}}
@php
    $items = collect($block->items ?? [])->filter(fn ($item) => filled((string) $item->title));
    $layout = (string) $block->layout ?: 'grid';
@endphp
@if ($items->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
        {{-- … --}}
    </x-section>
@endif
```

   - `<x-section>` applies the background, spacing and anchor. Inside, use only the theme's colour classes (`bg-card`, `text-muted-foreground`, `bg-primary text-primary-foreground`…).
   - Print a field only when it's filled; leave the section out when it has nothing to show.
   - Images: `<x-picture :image="$block->image" sizes="…" class="…" />` (responsive, focal point, alt text from the asset).
   - Interactive parts need keyboard support (Escape, arrow keys, focus) and honour `prefers-reduced-motion`; put their script in `resources/js/site.js` behind a `data-` attribute.
3. **Try it**: add the section to a page in the control panel (or the Components page), and look at `/components` in several presets, light and dark, at a phone's width.
4. Run `npm run build` and `vendor/bin/pint` (Blade is formatted too).

## Don't

- Don't add Tailwind palette colours or hex values to the view.
- Don't create a second page-builder field; every page uses `blocks`.
