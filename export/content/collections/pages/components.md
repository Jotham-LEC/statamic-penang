---
id: 4cde0c99-08a9-4f85-8f25-49efe94ee68b
blueprint: page
title: Components
template: showcase
seo:
  noindex: true
  sitemap: false
blocks:
  -
    id: S7oqMNfF
    type: hero
    enabled: true
    tone: default
    spacing: normal
    layout: centred
    eyebrow: 'Hero, centred'
    heading: 'A centred hero, with a picture below'
    text: 'Heroes come centred, beside a picture (on either side), or as text on a photo.'
    image: images/cafe-evening.jpg
    buttons:
      -
        id: OmspeHyZ
        label: Primary
        link: '#'
        style: primary
      -
        id: j4dYfmzw
        label: Outline
        link: '#'
        style: outline
  -
    id: ADJvd1um
    type: text
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Text
    heading: 'Paragraphs, headings and lists'
    alignment: left
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'A Text section holds what editors write: paragraphs, headings, lists and quotes, at a comfortable width for reading.'
      -
        type: heading
        attrs:
          level: 2
          textAlign: left
        content:
          -
            type: text
            text: 'A heading inside the text'
      -
        type: bulletList
        content:
          -
            type: listItem
            content:
              -
                type: paragraph
                content:
                  -
                    type: text
                    text: 'A list item'
          -
            type: listItem
            content:
              -
                type: paragraph
                content:
                  -
                    type: text
                    text: 'Another item'
          -
            type: listItem
            content:
              -
                type: paragraph
                content:
                  -
                    type: text
                    text: 'And one more'
  -
    id: dE4YYWjK
    type: image_text
    enabled: true
    tone: default
    spacing: normal
    image: images/tamping.jpg
    image_position: right
    image_shape: portrait
    eyebrow: 'Picture and text'
    heading: 'A portrait picture on the right'
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'The picture can sit on either side, in landscape, square or portrait.'
    buttons:
      -
        id: ObTnTnp7
        label: 'A button'
        link: '#'
        style: primary
  -
    id: bTYu5JPi
    type: feature_grid
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Features, as cards'
    heading: 'Four columns of cards'
    layout: cards
    columns: '4'
    items:
      -
        id: fiQnFD7x
        icon: coffee
        title: Icons
        text: 'Each point can have an icon.'
      -
        id: 0Wa59xbZ
        icon: award
        title: Cards
        text: 'Points as cards, as plain icons, or listed beside the heading.'
      -
        id: 7OeQdnjQ
        icon: users
        title: Columns
        text: 'Two, three or four columns.'
      -
        id: EdaFdsbQ
        icon: sparkles
        title: Tones
        text: 'Any section can sit on any background.'
  -
    id: 4bF0byk4
    type: feature_grid
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Features, beside the heading'
    heading: 'The heading on the left'
    intro: 'The offset layout lists the points beside the heading.'
    layout: offset
    items:
      -
        id: 3ipytHCM
        icon: shield-check
        title: One
        text: 'A point with an icon.'
      -
        id: BBw9BzxL
        icon: heart
        title: Two
        text: 'Another point.'
      -
        id: GXeiR2Qi
        icon: gift
        title: Three
        text: 'A third.'
      -
        id: iQFTxdd1
        icon: package
        title: Four
        text: 'And a fourth.'
  -
    id: X2gOU9SZ
    type: product_cards
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Products, chosen'
    heading: 'Three products chosen by hand'
    source: picked
    products:
      - 468d5fe7-f79d-4b79-afc5-cb892e06bb32
      - 3ab76de6-7461-464a-9619-f25bfd6e8d41
      - 4a6a67b6-f5a0-44e0-ac7a-6dc1bf51e44e
    columns: '3'
    all_link: false
  -
    id: PdJuWW91
    type: team
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Team, compact'
    heading: 'Small photos'
    layout: compact
  -
    id: Q3vBfoL0
    type: recent_posts
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Latest articles, as a list'
    heading: 'A list of articles'
    layout: list
    limit: 2
    all_link: false
  -
    id: Fpw81u9a
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    layout: single
    testimonials:
      -
        id: AT6LQFEw
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
  -
    id: PpySDYut
    type: logo_strip
    enabled: true
    tone: muted
    spacing: normal
    heading: 'Logos, boxed'
    layout: grid
    logos:
      - logos/lorong-studio.svg
      - logos/roti-ah-seng.svg
      - logos/tanjung-florist.svg
      - logos/pulau-print.svg
  -
    id: nP9AABOI
    type: stats
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Figures, beside a picture'
    heading: 'Numbers next to a photo'
    layout: split
    image: images/beans-light-wood.jpg
    stats:
      -
        id: kc8NhVIw
        value: '12'
        label: 'A figure'
      -
        id: z1KYVhbd
        value: 98%
        label: Another
      -
        id: wfBEMufM
        value: 'RM 2k'
        label: 'Any short text'
      -
        id: AkCmwmTP
        value: 24/7
        label: 'Up to four'
  -
    id: 12LhQaCT
    type: faq
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Questions, side by side'
    heading: 'The heading beside the questions'
    layout: side
    items:
      -
        id: PJZdsvCD
        question: 'How do I order?'
        answer: 'Send us a WhatsApp message or the enquiry form with what you would like. We reply with the total and payment details (DuitNow QR or bank transfer), and post your order once it is paid.'
      -
        id: CQD4bFnN
        question: 'Do you deliver outside Penang?'
        answer: 'Yes, anywhere in Malaysia, usually in one to three working days. Delivery is free on orders over RM 150; below that it is RM 10 to the peninsula and RM 15 to Sabah and Sarawak.'
      -
        id: bO8K1Pzn
        question: 'When are the beans roasted?'
        answer: 'Every Tuesday and Friday. We post within two days of roasting, so your coffee is never more than a week old when it arrives.'
  -
    id: LmhHtT4p
    type: cta
    enabled: true
    tone: default
    spacing: normal
    layout: split
    heading: 'Call to action, beside a picture'
    text: 'Also centred, or as a panel in the primary colour.'
    image: images/latte-table.jpg
    buttons:
      -
        id: P4Cud2wU
        label: Primary
        link: '#'
        style: primary
      -
        id: PitYGBOO
        label: Secondary
        link: '#'
        style: secondary
    whatsapp: true
  -
    id: mj8l7VFL
    type: cta
    enabled: true
    tone: muted
    spacing: normal
    layout: panel
    heading: 'Call to action, as a panel'
    text: 'The panel takes the primary colour; its buttons turn around to stay readable.'
    buttons:
      -
        id: h2EhF63c
        label: Primary
        link: '#'
        style: primary
      -
        id: NU6ADwej
        label: Outline
        link: '#'
        style: outline
  -
    id: LkZr7cJF
    type: contact_form
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Enquiry form'
    heading: 'The form on its own'
    show_details: false
  -
    id: 0GBWcEpu
    type: map_address
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Map and address'
    heading: 'Where to find us'
    show_hours: true
    zoom: 15
  -
    id: qGUERSTy
    type: hero
    enabled: true
    tone: primary
    spacing: normal
    layout: split
    image_position: right
    eyebrow: 'Hero, split'
    heading: 'Text beside a picture'
    text: 'The split hero puts the picture on either side.'
    image: images/espresso-machine.jpg
    buttons:
      -
        id: 0EB8AD1w
        label: Primary
        link: '#'
        style: primary
      -
        id: q90oRG2d
        label: Outline
        link: '#'
        style: outline
---
