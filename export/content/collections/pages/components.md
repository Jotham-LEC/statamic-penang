---
id: 449e5d6f-8dc5-41ba-9ebe-3169c106f7fb
blueprint: page
title: Components
template: showcase
seo:
  noindex: true
  sitemap: false
blocks:
  -
    id: UgP3IyFS
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
        id: hjn773Ld
        label: Primary
        link: '#'
        style: primary
      -
        id: Cgo38eVc
        label: Outline
        link: '#'
        style: outline
  -
    id: KvoaoHsA
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
    id: sN9QN9II
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
        id: XmFH17d6
        label: 'A button'
        link: '#'
        style: primary
  -
    id: eziiV3jl
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
        id: RRqfThie
        icon: coffee
        title: Icons
        text: 'Each point can have an icon.'
      -
        id: UuyMzerR
        icon: award
        title: Cards
        text: 'Points as cards, as plain icons, or listed beside the heading.'
      -
        id: RzIDNLHW
        icon: users
        title: Columns
        text: 'Two, three or four columns.'
      -
        id: 3awe6ocX
        icon: sparkles
        title: Tones
        text: 'Any section can sit on any background.'
  -
    id: UXEcTQv7
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
        id: s5sHHcFw
        icon: shield-check
        title: One
        text: 'A point with an icon.'
      -
        id: Wi7ELupP
        icon: heart
        title: Two
        text: 'Another point.'
      -
        id: pjH1bTxn
        icon: gift
        title: Three
        text: 'A third.'
      -
        id: CVgzBpf4
        icon: package
        title: Four
        text: 'And a fourth.'
  -
    id: SFV4EBWF
    type: product_cards
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Products, chosen'
    heading: 'Three products chosen by hand'
    source: picked
    products:
      - 57c8bab6-6d37-4e34-ace4-3e176966c59d
      - 6a99329d-7e2d-4238-a890-95b9889ee8e0
      - 7b7c6c23-7ee7-4e22-b9b6-0ee24d3cd676
    columns: '3'
    all_link: false
  -
    id: U7PdZ7Yc
    type: team
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Team, compact'
    heading: 'Small photos'
    layout: compact
  -
    id: ZveFRgxU
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
    id: LdZguXCJ
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    layout: single
    testimonials:
      -
        id: a8lVN011
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
  -
    id: 0s2d0q8r
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
    id: z3gdfSsH
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
        id: khwSj306
        value: '12'
        label: 'A figure'
      -
        id: xyfkGBUQ
        value: 98%
        label: Another
      -
        id: uwSXd5VA
        value: 'RM 2k'
        label: 'Any short text'
      -
        id: o18oh0KW
        value: 24/7
        label: 'Up to four'
  -
    id: 4bSzXPCx
    type: faq
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Questions, side by side'
    heading: 'The heading beside the questions'
    layout: side
    items:
      -
        id: mHkNeUSK
        question: 'How do I order?'
        answer: 'Send us a WhatsApp message or the enquiry form with what you would like. We reply with the total and payment details (DuitNow QR or bank transfer), and post your order once it is paid.'
      -
        id: whvT0P3x
        question: 'Do you deliver outside Penang?'
        answer: 'Yes, anywhere in Malaysia, usually in one to three working days. Delivery is free on orders over RM 150; below that it is RM 10 to the peninsula and RM 15 to Sabah and Sarawak.'
      -
        id: rB8VlXBa
        question: 'When are the beans roasted?'
        answer: 'Every Tuesday and Friday. We post within two days of roasting, so your coffee is never more than a week old when it arrives.'
  -
    id: M4mCdRUR
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
        id: N0vxx5Vb
        label: Primary
        link: '#'
        style: primary
      -
        id: ByxhhKIV
        label: Secondary
        link: '#'
        style: secondary
    whatsapp: true
  -
    id: 9Vx9IOjD
    type: cta
    enabled: true
    tone: muted
    spacing: normal
    layout: panel
    heading: 'Call to action, as a panel'
    text: 'The panel takes the primary colour; its buttons turn around to stay readable.'
    buttons:
      -
        id: puHY9pEs
        label: Primary
        link: '#'
        style: primary
      -
        id: lkC6FtQQ
        label: Outline
        link: '#'
        style: outline
  -
    id: GpEAKQbn
    type: contact_form
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Enquiry form'
    heading: 'The form on its own'
    show_details: false
  -
    id: L7SjBoRl
    type: map_address
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Map and address'
    heading: 'Where to find us'
    show_hours: true
    zoom: 15
  -
    id: 9AlH9rtb
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
        id: yBGsxaJC
        label: Primary
        link: '#'
        style: primary
      -
        id: AwHDtTuJ
        label: Outline
        link: '#'
        style: outline
---
