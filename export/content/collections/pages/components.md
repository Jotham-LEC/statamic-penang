---
id: 494c4804-4f13-4b66-a6e3-93765159b75c
blueprint: page
title: Components
template: showcase
seo:
  noindex: true
  sitemap: false
blocks:
  -
    id: LwrnX1cm
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
        id: z0BTBbOc
        label: Primary
        link: '#'
        style: primary
      -
        id: 9guGKMIY
        label: Outline
        link: '#'
        style: outline
  -
    id: 4kPejdFN
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
    id: daqkJ5Ri
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
        id: 6ycsHbiO
        label: 'A button'
        link: '#'
        style: primary
  -
    id: aK44RvRz
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
        id: Zf71Glhh
        icon: coffee
        title: Icons
        text: 'Each point can have an icon.'
      -
        id: MVtn5Hkk
        icon: award
        title: Cards
        text: 'Points as cards, as plain icons, or listed beside the heading.'
      -
        id: iBXFYYMB
        icon: users
        title: Columns
        text: 'Two, three or four columns.'
      -
        id: ktRuOUIM
        icon: sparkles
        title: Tones
        text: 'Any section can sit on any background.'
  -
    id: Nz9yedTE
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
        id: olbw97Pa
        icon: shield-check
        title: One
        text: 'A point with an icon.'
      -
        id: Q42ViswZ
        icon: heart
        title: Two
        text: 'Another point.'
      -
        id: BKTkciuG
        icon: gift
        title: Three
        text: 'A third.'
      -
        id: 6d9FcFTR
        icon: package
        title: Four
        text: 'And a fourth.'
  -
    id: Zx69oFUR
    type: product_cards
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Products, chosen'
    heading: 'Three products chosen by hand'
    source: picked
    products:
      - 056ace10-1f21-440f-9d43-7461b0d5d880
      - 57b28e7b-961f-4665-bca8-0bb66695aa2e
      - 9f8d7e1c-0315-4e0a-92cb-06e188cfea62
    columns: '3'
    all_link: false
  -
    id: VRg7DPDF
    type: team
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Team, compact'
    heading: 'Small photos'
    layout: compact
  -
    id: q1hnKrzw
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
    id: uBQVGfBV
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    layout: single
    testimonials:
      -
        id: xwyOm555
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
  -
    id: qBK62Wyy
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
    id: 5XVndQcu
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
        id: NtucVMm9
        value: '12'
        label: 'A figure'
      -
        id: uTaKIZBt
        value: 98%
        label: Another
      -
        id: mAV0S9eb
        value: 'RM 2k'
        label: 'Any short text'
      -
        id: xSnsQeIy
        value: 24/7
        label: 'Up to four'
  -
    id: I0ZvUbtK
    type: faq
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Questions, side by side'
    heading: 'The heading beside the questions'
    layout: side
    items:
      -
        id: lxQGk4nb
        question: 'How do I order?'
        answer: 'Send us a WhatsApp message or the enquiry form with what you would like. We reply with the total and payment details (DuitNow QR or bank transfer), and post your order once it is paid.'
      -
        id: pE4myQkm
        question: 'Do you deliver outside Penang?'
        answer: 'Yes, anywhere in Malaysia, usually in one to three working days. Delivery is free on orders over RM 150; below that it is RM 10 to the peninsula and RM 15 to Sabah and Sarawak.'
      -
        id: iPv4ZcxJ
        question: 'When are the beans roasted?'
        answer: 'Every Tuesday and Friday. We post within two days of roasting, so your coffee is never more than a week old when it arrives.'
  -
    id: cX0YsPyl
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
        id: U2HpxT45
        label: Primary
        link: '#'
        style: primary
      -
        id: lA4ekG6P
        label: Secondary
        link: '#'
        style: secondary
    whatsapp: true
  -
    id: 6gPwPPIa
    type: cta
    enabled: true
    tone: muted
    spacing: normal
    layout: panel
    heading: 'Call to action, as a panel'
    text: 'The panel takes the primary colour; its buttons turn around to stay readable.'
    buttons:
      -
        id: 0DLZGXdb
        label: Primary
        link: '#'
        style: primary
      -
        id: 2siF9Bvk
        label: Outline
        link: '#'
        style: outline
  -
    id: k1UsATjy
    type: contact_form
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Enquiry form'
    heading: 'The form on its own'
    show_details: false
  -
    id: ErGspf3W
    type: map_address
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Map and address'
    heading: 'Where to find us'
    show_hours: true
    zoom: 15
  -
    id: nNNuCs8F
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
        id: sp0m0JDg
        label: Primary
        link: '#'
        style: primary
      -
        id: coGGP6tC
        label: Outline
        link: '#'
        style: outline
---
