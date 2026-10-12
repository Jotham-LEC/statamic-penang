---
name: penang-launch
description: "Use when turning a fresh Penang install into the client's site, or checking one before it goes live: replacing the Kopi Lane Roasters sample content, business details, theme, pictures and share image, and the settings a live site needs (APP_URL, search index, email, the user manual)."
license: proprietary
metadata:
  author: jotham-lec
---

# Penang: from sample to the client's site

A new Penang site is filled with sample content for Kopi Lane Roasters, a made-up café in George Town. Replace all of it before launch.

## Checklist

1. **Business details**: Marketing → Brand: the publisher's name, phone, email, address, map position, opening hours and social profiles; the default description; the **default share image** (1200 × 630); the site's name for page titles. These feed the header, footer, contact sections, map and structured data.
2. **Site settings** (Globals → Site settings): WhatsApp number and first message, more phone numbers, the header button, the contact page, the footer text, note and legal line, the announcement bar (empty for none), the products page's featured rows, the search page, and **Labels** for wording that doesn't suit the business.
3. **Look**: Globals → Theme; a client's brand is a preset of its own (the `penang-client-preset` skill).
4. **Content**: replace or delete the sample pages, products, product categories, blog articles, blog categories (`topics`) and team members, and the Main and Footer menus. Keep the Components page for checking looks, hidden from search engines, or delete it.
5. **Pictures**: delete the sample photos and logos in `public/assets` that aren't used; give every picture alt text and a focal point.
6. **Enquiries**: Forms → Enquiry → Email for the business's notification, and optionally the visitor's thank-you email (HTML view `emails/enquiry-confirmation`); set up mail sending in `.env`.
7. **Live settings**: `APP_URL`, `APP_ENV=production` (the Marketing Toolkit keeps other environments out of search engines), then `php please search:update --all` and `php please stache:clear`.
8. **SEO**: run `php please mt:report` and fix what the `marketing-toolkit-report` tool lists; check a few pages with `marketing-toolkit-page-seo`.
9. **Hand-over**: give the editor `docs/user-manual.md`.

Search for leftovers before launch: "Kopi Lane", "kopilane.example", "555 0100", "Lorong Kopi".
