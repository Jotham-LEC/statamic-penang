# Changelog

## 1.1.0 (2026-10-12)

- Softer themes: no pure white or black anywhere. The light page is an off-white in the base colour's tone, cards a lighter off-white, text a deep toned grey; the dark page is a deep toned grey rather than near-black. Text on buttons, hovers, the photo scrim and shadows use the same toned ends. A test checks no theme produces pure white or black.
- Colours are mixed in OKLab, so tints (success messages, highlights) keep their colour on any base.
- `composer.json` declares the licence (proprietary; see LICENSE.md).

## 1.0.0 (2026-10-10)

The first release.

- A page builder of fourteen sections: hero, text, picture and text, features, products, team, latest articles, testimonials, logos, figures, questions, call to action, enquiry form, and map and address. Each takes a background (page, muted, primary colour, inverted), spacing and an anchor, and has a picture in the set picker.
- A theme builder in Globals → Theme: heading and body fonts (eight, self-hosted), corners, base, primary and secondary colours (named or custom), light, dark or the visitor's choice, and five presets (Default, Kopitiam, Pantai, Hutan, Batik). Text colours are chosen for WCAG AA contrast in every combination.
- A components page (`/components`) and, for signed-in users, a theme switcher to try themes before saving.
- Products with categories, prices and stock, a blog, a team, one enquiry form, and a WhatsApp button, on Statamic Core.
- SEO, structured data, sitemaps, redirects and analytics through the Marketing Toolkit 0.25.0.
- Sample content for Kopi Lane Roasters, a made-up coffee roaster in George Town, with CC0 photos.
- A user manual for editors: `docs/user-manual.md`.
