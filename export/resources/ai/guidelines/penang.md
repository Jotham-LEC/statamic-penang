## Penang (Statamic starter kit)

This site was built from Penang, a Statamic 6 starter kit for small-business websites: Blade (no Antlers), Tailwind CSS v4, Statamic Core (one user, one form), and the Marketing Toolkit for SEO. Follow the kit's patterns; the code is the site's own to change.

### Where things are
- **Sections (page builder):** the `blocks` Replicator in `resources/fieldsets/page_builder.yaml`, one Blade view per set in `resources/views/components/blocks/{set-handle-with-dashes}.blade.php`, rendered by `components/blocks.blade.php`. Shared fields: `section_options` (background, spacing, anchor) and `buttons`.
- **Theme:** `app/Theme/` (`Options.php` holds the fonts, corners, colours and the presets; `Theme.php` turns a preset into colour tokens). The layout prints the tokens as CSS custom properties; `resources/css/site.css` maps them to Tailwind.
- **Business details:** `App\Support\Business` (name, phone, email, address, hours, WhatsApp link) reads Marketing → Brand (the Marketing Toolkit's global) and Globals → Site settings.
- **Wording:** `App\Support\Labels::get('key')` for words editors may change (Globals → Site settings → Labels); `__()` with `lang/ms.json` and `lang/zh_CN.json` for the rest.
- **Buttons:** `<x-buttons :buttons="$block->buttons" />`; where each type goes is `App\Support\Button::target()`.
- **Components page:** `/components` shows every section and UI component in the current theme: the page to check visual changes on.

### Rules
- **Colours come from the theme only.** In views use the token classes (`bg-background`, `text-foreground`, `bg-primary text-primary-foreground`, `text-muted-foreground`, `border-border`, `bg-card`, `bg-muted`…). Never Tailwind palette classes (`bg-blue-500`, `text-white`) or hex/rgb values: Tailwind's palette is switched off, and section backgrounds (`data-tone`) only work through the tokens.
- **The theme is a preset.** Editors choose a preset under Globals → Theme; a client's brand is a new preset in `Options::PRESETS` (and its option in `resources/blueprints/globals/theme.yaml`), never per-page colours. Check one with the `penang-theme-check` tool.
- **A section prints nothing for empty fields:** check `filled()` before printing, and leave out a section with nothing to show.
- **Statamic Core:** one control panel user and one form (Forms → Enquiry). Don't add forms or users; don't turn on Pro features.
- **SEO is the Marketing Toolkit's:** don't print meta tags or JSON-LD; see its guideline.
- **Blade traps in this kit:**
  - `@class` doesn't work on `<x-…>` component tags: use `:class="\Illuminate\Support\Arr::toCssClasses([...])"`.
  - Passing a Statamic `Value` as a component prop throws: cast with `(string)` or unwrap with `\Statamic\View\Blade\value()`.
  - `@php` inside `<s:form:create>` is dropped: work values out before the tag.
  - A button group field's value is a `LabeledValue`: compare `(string) $block->layout`.
  - Entries and terms fields augment to query builders, and augmenting a terms field on an entry gives the terms that collection's URL (`/blog/topics/…`), which Statamic doesn't serve: read the raw slugs and `Term::find()`.
- After changing views or styles, run `npm run build`; after changing content structure, `php please stache:clear` and `php please search:update --all`.

### Tools and skills
- `penang-sections`: every section's handle, layouts, fields and view. `penang-theme-check`: a preset's contrast in every background, light and dark, and the colours it really uses.
- Skills: `penang-add-section`, `penang-client-preset`, `penang-launch`.
