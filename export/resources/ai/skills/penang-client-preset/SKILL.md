---
name: penang-client-preset
description: "Use when a Penang site needs a client's own look: brand colours (hex), fonts or corners. Penang's theme is a preset chosen under Globals → Theme, so the client gets a preset of their own in app/Theme/Options.php. Covers checking contrast with the penang-theme-check tool, dark mode's primary (primary_dark), the Theme blueprint option, and checking /components."
license: proprietary
metadata:
  author: jotham-lec
---

# Penang: a preset for a client's brand

Editors choose the whole look as one preset (fonts, corners and colours chosen together). A client's brand is therefore a new preset. Never add per-page colours or override CSS variables by hand.

## Steps

1. **Gather the brand**: primary colour (buttons and links), secondary (badges and highlights), fonts for headings and text, and how rounded things should be. Fonts must be among Penang's fourteen (see `Options::FONTS`); a new font needs its `.woff2` in `resources/fonts/{key}/`, an `@font-face` in `resources/css/fonts.css`, its `OFL.txt`, and a line in `NOTICE.md`.
2. **Check it** with the `penang-theme-check` tool, passing `primary`, `secondary`, `base`, `heading_font`, `body_font` and `radius`:
   - `contrast_failures` must be empty.
   - `exact_brand_colours` says whether each hex colour is used exactly. In light mode it should be; in dark mode a deep brand colour is stepped lighter and can turn into a different-looking colour (plum to pink, for example). Then choose a `primary_dark` that suits the brand in the dark (often a lighter tint of the secondary, or of the primary itself) and check again.
   - Pick the `base` greys that suit the brand: `stone` is warm, `zinc` and `slate` cool, `neutral` pure grey.
3. **Add the preset** from the tool's `preset_entry` to `PRESETS` in `app/Theme/Options.php`, with a short handle as its key and the client's name as its `label`.
4. **Offer it to editors**: add `handle: Label` to the Preset field's `options` in `resources/blueprints/globals/theme.yaml`, and make it the `default` if it's the site's look.
5. **Choose it** under Globals → Theme (or set `preset` in `content/globals/default/theme.yaml`). Look at `/components` and a few pages in light and dark mode.
6. Optionally remove the presets the client won't use from both places.
