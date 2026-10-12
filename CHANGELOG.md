# Changelog

## 1.6.0 (2026-10-12)

### Added

- **A Laravel Boost extension for AI coding agents**, offered by the installer (default no), which adds Laravel Boost as a dev dependency.
  - **Guidelines:** Penang's guideline goes into `.ai/guidelines/penang.md`.
  - **Skills:** `penang-add-section`, `penang-client-preset` and `penang-launch` go into `.ai/skills/`.
  - **MCP tools:** two read-only tools join Boost's MCP server: `penang-theme-check` (a preset's contrast and real colours, and the preset entry to paste) and `penang-sections` (the page builder's sections).
  - **Marketing Toolkit:** its own Boost guidelines, skills and tools come with it (0.27.0).
  - **Setup:** run `php artisan boost:install` to choose agents. A `boost.json` ticks the Marketing Toolkit's and Statamic's own guidelines and skills. Every name is prefixed, so nothing clashes with Boost's or Statamic's own.
- A theme can be checked in code: `Theme::contrastFailures()`; and a `primary_dark` can be tried before it's in a preset.

## 1.5.2 (2026-10-12)

### Fixed

- **Category pages have a share image.** Product and blog category pages had no `og:image`: the Marketing Toolkit drew share cards for entries only. Penang now requires the Marketing Toolkit 0.26.0, which draws them for category (term) pages too.

### Changed

- **The sample business has a default share image** (Marketing → Brand), shown when a page has no picture of its own and no card can be drawn; the user manual says where to set yours.
- **A shorter README**, with what Penang includes, its sections and themes, and the Marketing Toolkit that comes with it.

### Upgrading from 1.5.1

- `composer require jotham-lec/statamic-marketing-toolkit:0.26.0`.

## 1.5.1 (2026-10-12)

### Fixed

- **The WhatsApp icon is white.** Brand icons (WhatsApp, Facebook, Instagram…) were drawn in pure black whatever their colour around them; they now take their text's colour. The floating WhatsApp button keeps a deep fill in dark mode too (the preset's light-mode primary, the new `--solid` tokens), so its icon and label are always the theme's off-white.

### Changed

- **Buttons have a subtle shadow**: secondary and outline buttons now have the primary's soft shadow, in the theme's own dark.

## 1.5.0 (2026-10-12)

### Changed

- **The theme is a preset.** Globals → Theme and the theme switcher offer the presets (and light and dark) only; fonts, corners and colours are no longer set one by one beside a preset, so a preset is never mixed with settings from another. Settings saved by 1.4 beside the preset are ignored. A look for a brand is a preset added in `app/Theme/Options.php`, which takes hex colours (used exactly where they read) and, new, `primary_dark` for dark mode.
- **Batik is in batik's own colours**: indigo and soga brown on the cream of undyed cotton, smaller corners, and in the dark a light soga on deep brown, as sogan batik is.

### Changed (sample content)

- **The sample team's names fit their photos**: Luca Moretti, Sofia Alvarez and Kwame Asante join Lim Mei Ling (their photos are renamed `team-luca.jpg`, `team-sofia.jpg` and `team-kwame.jpg`).

### Upgrading from 1.4

- **A site that set its fonts or colours in Globals → Theme**: put them in a preset of its own (README, "A preset for a client's brand") and choose it, or the site shows its preset as the preset is.

## 1.4.0 (2026-10-12)

Penang for most marketing sites, whatever the business: twenty sections, products as a catalogue, a blog with categories, site search, and wording, buttons and colours that fit the business.

### Content and listings

- Products as a catalogue: a New, Sale or own badge, a price before (crossed out), a details list ("What's inside", sizes) and buttons to the product in other shops (Shopee, Lazada…). The product's structured data is unchanged.
- The products page: rows of featured products for the first few categories (Site settings → Products page), and pages of products. Category pages list the other categories and have pages too.
- Breadcrumbs on products, articles, categories and pages under another page, in step with the toolkit's BreadcrumbList.
- Blog categories (the `topics` taxonomy, at `/topics/…`), with a page each and links on the blog and on each article.
- Site search (Statamic Core's local index) over pages, products and articles: a Search results kind of page, and a search button in the header (Site settings → Search). The installer builds the index.
- An optional confirmation email to the visitor after the enquiry form, in the theme's colours (Forms → Enquiry → Email; see the user manual).
- A legal page kind: its Text sections with a table of contents, and the date it was last updated.

### Sections

- Six new sections: **Gallery** (grid or masonry, captions, a larger view in a `<dialog>` with arrow keys), **Video** (YouTube, Vimeo or a file, behind a cover; nothing loads from YouTube or Vimeo until played), **Steps** (across, or a timeline), **Tabs** (ARIA tabs), **Table** and **Prices** (up to four packages, one standing out). Each has a picture in the set picker and a sample on `/components`.
- An announcement bar (Globals → Site settings), above the header, which visitors can close until it changes.
- Features: a picture per point in place of the icon, and every Lucide icon (over 2,000), searchable.
- Testimonials: stars, where it was left (Google, Facebook…), a company logo, a carousel layout, and a note signed by several people with their signatures and a sign-off.
- Logos: a scrolling layout (paused on hover and for reduced motion), and a link per logo (in the logo's details).
- Picture and text: up to four pictures, as a collage or a column, with captions.
- Hero: a silent background video, with the picture for reduced motion.
- Text sections can hold tables. Pictures have a caption and a link in their details.
- Steps can show an icon in place of the number. A quote can be followed by buttons, and a note's signers can have their names written by hand (Allura, when there is no signature picture). A hero can show the lowest product price ("From RM 268").

### Wording, buttons, colours and fonts

- A custom brand colour is used exactly as picked wherever it passes the contrast rules, and stepped to another shade only where it fails.
- Product and article cards without a summary show the start of the description.
- Editable wording: Globals → Site settings → Labels (all products and articles links, ask for a price, out of stock, WhatsApp, menu, footer headings, the 404 page), and the button and thank-you message on the Enquiry form section. Malay (`lang/ms.json`) and Simplified Chinese (`lang/zh_CN.json`) for the rest.
- Introductions, a hero's text and a call to action's text take bold, italics and links (inline Bard). Search descriptions read them as plain text (Marketing Toolkit 0.25.1).
- Buttons go to a page or address, WhatsApp (with their own first message), a phone call, an email or a file, can open in a new tab, and take up to three per section. The Call to action's WhatsApp switch is now a button type (a switch saved before still works).
- Site settings: more phone numbers (each optionally on WhatsApp), a footer note and a legal line (company name and registration number).
- Six more fonts: Cormorant Garamond, Playfair Display and DM Serif Display for headings; Montserrat, Poppins and DM Sans. Eleven more icons.
- The main menu takes a second level, opening as a dropdown (and listed under its item on phones).

### Fixed

- A product's category links went to an address that didn't exist (`/products/product-categories/…`).

### Upgrading from 1.1

- Requires the Marketing Toolkit 0.25.1, which reads Bard description fields (`composer require jotham-lec/statamic-marketing-toolkit:0.25.1`).
- Penang is a starter kit: an existing site doesn't update by itself. To take these features into a 1.1 site, copy the changed files (blueprints, fieldsets, views, `app/`, `config/`, `lang/`, `resources/css`, `resources/js`, `resources/fonts`, `resources/icons`) and run `npm run build` and `php please search:update --all`. Content saved in 1.1 keeps working: plain-text introductions show as before, and the Call to action's WhatsApp switch still adds its button.

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
