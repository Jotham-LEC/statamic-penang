---
name: penang-add-section
description: "Use when adding a new section type to a Penang site's page builder, or a new layout or field to an existing section (hero, features, testimonials, prices…). Covers the page_builder fieldset set, the set picker group it goes in and its search-friendly hint, its Blade view, the theme's colour tokens and backgrounds, empty fields, and checking it on /components."
license: proprietary
metadata:
  author: jotham-lec
---

# Penang: add a section

A section is a set of the `blocks` Replicator in `resources/fieldsets/page_builder.yaml`, drawn by `resources/views/components/blocks/{handle-with-dashes}.blade.php`. Start by looking at the existing sections with the `penang-sections` tool, and copy the one closest to what you need.

## Steps

1. **Add the set** to one group of `fields.0.field.sets` in `page_builder.yaml` (or in the control panel: Fieldsets → Page builder). The groups are the set picker's tabs, named the way block libraries name them; put the set in the one an editor would look in:

   | Group (handle) | Sets |
   |---|---|
   | Hero sections (`hero_sections`) | hero only: a page opens with one |
   | Feature sections (`feature_sections`) | feature_grid, steps, tabs |
   | Content sections (`content_sections`) | text, image_text, gallery, video, table |
   | Stats and social proof (`social_proof`) | stats, testimonial, logo_strip |
   | Products and pricing (`products_pricing`) | product_cards, pricing |
   | Blog and listings (`blog_listings`) | recent_posts, team: lists from a collection |
   | FAQ sections (`faq_sections`) | faq |
   | CTA and contact (`cta_contact`) | cta, contact_form, map_address |

   A new kind of section that fits none gets a new group: `display`, `icon` (a Statamic icon name, from `vendor/statamic/cms/resources/svg/icons`), a one-line `instructions` and its `sets`. Content stores only the set's handle (`type`), so moving a set between groups never touches saved pages.
   - `display`: a plain name an editor understands.
   - `instructions`: one line, shown under the name in the picker. The picker's search reads the name, the handle and this line (never the group), so end it with the words an editor would type when they differ from the name, in brackets: Figures is "A few numbers that tell your story (stats, metrics)."
   - `image`: a picture of the section for the picker, in `public/assets/set-previews/` (800 × 406, a screenshot of the section on `/components`).
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
- Don't give a new section an `<h1>`. A page's h1 is its opening Hero's heading (or its title, hidden, when it opens with another section): `components/blocks.blade.php` decides. Section headings are `<h2>` (`<x-section-heading>`).
