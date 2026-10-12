---
id: ba226acd-5c3f-4797-9bfd-59d82e9a124f
blueprint: page
title: Components
template: showcase
seo:
  noindex: true
  sitemap: false
blocks:
  -
    id: 7v7ceXH9
    type: hero
    enabled: true
    tone: default
    spacing: normal
    layout: centred
    eyebrow: 'Hero, centred'
    heading: 'A centred hero, with a picture below'
    text:
      -
        type: text
        text: 'Heroes come centred, '
      -
        type: text
        marks:
          -
            type: bold
        text: 'beside a picture'
      -
        type: text
        text: ' (on either side), or as '
      -
        type: text
        marks:
          -
            type: italic
        text: 'text on a photo'
      -
        type: text
        text: '. Buttons go to a page, WhatsApp, a phone call, an email or a file.'
    image: images/cafe-evening.jpg
    buttons:
      -
        id: DDWla4kK
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: mnvYEOqB
        type: phone
        label: 'Call us'
        style: outline
      -
        id: NUZlNuRK
        type: email
        label: 'Email us'
        style: secondary
  -
    id: tizoSrLF
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
    id: kVq2z11x
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
        id: EEiHVtc3
        type: link
        label: 'A button'
        link: '#'
        style: primary
  -
    id: 4UR07Kh2
    type: image_text
    enabled: true
    tone: muted
    spacing: normal
    image: images/chemex.jpg
    more_images:
      - images/hand-grinder.jpg
      - images/copper-kettle.jpg
    pictures_layout: collage
    image_position: left
    image_shape: landscape
    eyebrow: 'Picture and text, several pictures'
    heading: 'A collage with captions'
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'Up to four pictures, as a collage or a column, each with the caption from its details.'
  -
    id: fyvASgbr
    type: gallery
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Gallery, masonry'
    heading: 'Pictures in their own shapes'
    intro:
      -
        type: text
        text: 'Click one to see it larger; the arrow keys move through them.'
    layout: masonry
    columns: '4'
    captions: true
    lightbox: true
    images:
      - images/green-beans.jpg
      - images/team-mei-ling.jpg
      - images/espresso-machine.jpg
      - images/chemex.jpg
      - images/tamping.jpg
      - images/latte-pour.jpg
      - images/hand-grinder.jpg
      - images/cafe-evening.jpg
  -
    id: pcCF8bBn
    type: video
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Video
    heading: 'A video beside text'
    source: file
    file: videos/pour-over.mp4
    title: 'Hot water poured over coffee, then milk into a cup'
    poster: images/hero-pour-over.jpg
    layout: split
    video_position: right
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'YouTube, Vimeo or your own file. Nothing loads from YouTube or Vimeo until the visitor presses play.'
  -
    id: L9bvvU2d
    type: steps
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Steps, as a timeline'
    heading: 'From farm to cup'
    layout: vertical
    steps:
      -
        id: YkCVoRuK
        label: Jan
        title: Harvest
        text: 'Sofia visits the farms as the cherries are picked.'
      -
        id: uSaLZtdd
        label: Mar
        title: Shipping
        text: 'Green coffee arrives in George Town.'
      -
        id: ADgvGaHG
        label: Tue
        title: Roasting
        text: 'Every Tuesday and Friday, in small batches.'
      -
        id: 4vWA8QjJ
        title: 'Your cup'
        text: 'Steps are numbered unless they have a label.'
  -
    id: 2RBRnLEU
    type: tabs
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Tabs
    heading: 'One panel at a time'
    tabs:
      -
        id: v68XFoMw
        title: Espresso
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Fine grind, 18 g in, 36 g out, about 28 seconds. Tabs suit a few parallel answers: brew methods, services, locations.'
        image: images/blog-espresso-shot.jpg
      -
        id: wRRB1yM2
        title: Pour-over
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Medium-fine grind, 15 g to 250 g of water.'
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
                        text: 'Rinse the paper'
              -
                type: listItem
                content:
                  -
                    type: paragraph
                    content:
                      -
                        type: text
                        text: 'Bloom for 30 seconds'
              -
                type: listItem
                content:
                  -
                    type: paragraph
                    content:
                      -
                        type: text
                        text: 'Pour slowly in circles'
        image: images/blog-gooseneck.jpg
      -
        id: bIGp7fZN
        title: Kopi
        content:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Dark roast, a cloth sock and condensed milk. The arrow keys move between tabs.'
  -
    id: WOSiiWVh
    type: table
    enabled: true
    tone: default
    spacing: normal
    eyebrow: Table
    heading: 'Which coffee for which brewer'
    header_row: true
    header_column: true
    table:
      -
        cells:
          - ''
          - Espresso
          - Pour-over
          - Kopi
      -
        cells:
          - 'House Blend'
          - 'Yes'
          - Good
          - 'Yes'
      -
        cells:
          - 'Johor Liberica'
          - Good
          - 'Yes'
          - 'Yes'
      -
        cells:
          - 'Tenom Robusta'
          - 'With milk'
          - 'No'
          - 'Yes'
    caption: 'A Text section can hold a table too.'
  -
    id: T5A5Bwtz
    type: pricing
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Prices
    heading: 'Wholesale plans'
    intro:
      -
        type: text
        text: 'Up to four packages; one can '
      -
        type: text
        marks:
          -
            type: bold
        text: 'stand out'
      -
        type: text
        text: .
    plans:
      -
        id: 04b7zRSU
        name: 'Café starter'
        price: 'RM 420'
        period: 'per month'
        description: 'For a small café getting started.'
        features:
          - '5 kg of House Blend'
          - 'Grinder on loan'
          - 'One training session'
        buttons:
          -
            id: AZMfgc5N
            type: link
            label: 'Ask about it'
            link: '#'
            style: outline
      -
        id: 5HcU4Foi
        name: Café
        badge: 'Most popular'
        highlight: true
        price: 'RM 780'
        period: 'per month'
        description: 'Our most common plan.'
        features:
          - '10 kg, any coffee'
          - 'Grinder on loan'
          - 'Training for your staff'
          - 'Free delivery'
        buttons:
          -
            id: QUvGaWgX
            type: whatsapp
            label: 'Ask on WhatsApp'
            style: primary
      -
        id: MrHu4Aqx
        name: Office
        price: 'From RM 150'
        period: 'per month'
        description: 'Drip bags and beans for the team.'
        features:
          - 'Drip bags or beans'
          - 'Delivered monthly'
        buttons:
          -
            id: FpnTOhjZ
            type: link
            label: 'Ask about it'
            link: '#'
            style: outline
    note: 'Prices before delivery. Cancel any month.'
  -
    id: AVeVse1e
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
        id: JTrOGgAv
        icon: coffee
        title: Icons
        text: 'Each point can have an icon.'
      -
        id: FT8TcHIN
        icon: award
        title: Cards
        text: 'Points as cards, as plain icons, or listed beside the heading.'
      -
        id: zIpID0vL
        icon: users
        title: Columns
        text: 'Two, three or four columns.'
      -
        id: EySHfrqu
        icon: sparkles
        title: Tones
        text: 'Any section can sit on any background.'
  -
    id: cLwkG4N8
    type: feature_grid
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Features, with pictures'
    heading: 'A picture in place of the icon'
    layout: cards
    columns: '3'
    items:
      -
        id: 7weAbL7r
        image: images/cup-of-beans.jpg
        title: 'House Blend'
        text: 'Any point can show a picture instead of an icon.'
      -
        id: btF2wgpm
        image: images/drip-set.jpg
        title: 'Drip bags'
        text: 'Handy for a product, a service or a place.'
      -
        id: JGPwmlt1
        image: images/copper-kettle.jpg
        title: 'Brewing gear'
        text: 'Pictures and icons can mix in one section.'
  -
    id: 1ud8fQCV
    type: feature_grid
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Features, beside the heading'
    heading: 'The heading on the left'
    intro:
      -
        type: text
        text: 'The offset layout lists the points beside the heading.'
    layout: offset
    items:
      -
        id: kArWVNKP
        icon: shield-check
        title: One
        text: 'A point with an icon.'
      -
        id: UNyh7uIG
        icon: heart
        title: Two
        text: 'Another point.'
      -
        id: 0AH8Tdfm
        icon: gift
        title: Three
        text: 'A third.'
      -
        id: 7B72jz5x
        icon: package
        title: Four
        text: 'And a fourth.'
  -
    id: ITp7Wg1t
    type: product_cards
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Products, chosen'
    heading: 'Three products chosen by hand'
    source: picked
    products:
      - 59be4a92-5d23-4c5b-81ef-5ed01b554073
      - 1240854c-bef1-439e-9679-fd42cfe8cdb0
      - 178a33f2-3411-4f8e-9545-75c6f0c30bf7
    columns: '3'
    all_link: false
  -
    id: DWSZVy9H
    type: team
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Team, compact'
    heading: 'Small photos'
    layout: compact
  -
    id: USvfXEC2
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
    id: yIQfPWPx
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    layout: single
    testimonials:
      -
        id: nndctlrf
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
        rating: '5'
        logo: logos/roti-ah-seng.svg
  -
    id: Lv4iX1U4
    type: testimonial
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Testimonials, carousel'
    heading: 'With stars and where they were left'
    layout: carousel
    testimonials:
      -
        id: 3L19EqR2
        quote: 'The House Blend is the only coffee my whole office agrees on. Orders arrive two days after roasting, every time.'
        name: 'Farah Aziz'
        role: 'Office manager, Lorong Studio'
        rating: '5'
        source: google
      -
        id: nndctlrf
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
        rating: '5'
        logo: logos/roti-ah-seng.svg
      -
        id: eCFtysjG
        quote: 'Mei Ling spent an hour helping me set up my new grinder. That’s the kind of shop this is.'
        name: 'Priya Raman'
        role: 'Home brewer'
        rating: '5'
        source: facebook
      -
        id: bpyWVwQi
        quote: 'Good coffee, fair prices and the drip bags are perfect for the office. Delivery to KL took two days.'
        name: 'Daniel Wong'
        role: 'Kuala Lumpur'
        rating: '4'
        source: google
  -
    id: p5IB843f
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Testimonials, a note from the team'
    layout: single
    testimonials:
      -
        id: 90GY0PfC
        quote: |-
          Ten years ago we roasted our first batch on a borrowed machine, and burnt most of it.

          Thank you for every cup since: for coming back, for telling your friends, and for your patience on the Tuesdays we sold out.
        name: ''
    signatories:
      -
        id: qb5qSMk2
        name: 'Lim Mei Ling'
        role: Founder
        photo: images/team-mei-ling.jpg
      -
        id: 0zIwtsSk
        name: 'Luca Moretti'
        role: 'Café manager'
        photo: images/team-luca.jpg
    sign_off: 'With thanks,'
    signature_names: true
    buttons:
      -
        id: rdgiZQTE
        type: link
        label: 'Meet the team'
        link: '/about#team'
        style: outline
  -
    id: 7OPT6n7q
    type: logo_strip
    enabled: true
    tone: default
    spacing: compact
    heading: 'Logos, scrolling'
    layout: scrolling
    logos:
      - logos/lorong-studio.svg
      - logos/roti-ah-seng.svg
      - logos/tanjung-florist.svg
      - logos/pulau-print.svg
      - logos/seri-hotel.svg
  -
    id: ncG3M7Wm
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
    id: 5dMfWapj
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
        id: xljataJL
        value: '12'
        label: 'A figure'
      -
        id: alDszTyd
        value: 98%
        label: Another
      -
        id: kDPgYMfX
        value: 'RM 2k'
        label: 'Any short text'
      -
        id: V7X1Wu1a
        value: 24/7
        label: 'Up to four'
  -
    id: vvLT8TZX
    type: faq
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Questions, side by side'
    heading: 'The heading beside the questions'
    layout: side
    items:
      -
        id: UzgyVQAi
        question: 'How do I order?'
        answer: 'Send us a WhatsApp message or the enquiry form with what you would like. We reply with the total and payment details (DuitNow QR or bank transfer), and post your order once it is paid.'
      -
        id: ozLcTw3K
        question: 'Do you deliver outside Penang?'
        answer: 'Yes, anywhere in Malaysia, usually in one to three working days. Delivery is free on orders over RM 150; below that it is RM 10 to the peninsula and RM 15 to Sabah and Sarawak.'
      -
        id: FGjeiQxS
        question: 'When are the beans roasted?'
        answer: 'Every Tuesday and Friday. We post within two days of roasting, so your coffee is never more than a week old when it arrives.'
  -
    id: fA9JT0wN
    type: cta
    enabled: true
    tone: default
    spacing: normal
    layout: split
    heading: 'Call to action, beside a picture'
    text:
      -
        type: text
        text: 'Also centred, or as a panel in the primary colour.'
    image: images/latte-table.jpg
    buttons:
      -
        id: yPrEYa44
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: bBU1V8hD
        type: whatsapp
        label: WhatsApp
        style: secondary
  -
    id: pMKGom52
    type: cta
    enabled: true
    tone: muted
    spacing: normal
    layout: panel
    heading: 'Call to action, as a panel'
    text:
      -
        type: text
        text: 'The panel takes the primary colour; its buttons turn around to stay readable.'
    buttons:
      -
        id: 7Agkgxi2
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: zHDcrWoC
        type: link
        label: Outline
        link: '#'
        style: outline
  -
    id: RxoWXuxF
    type: contact_form
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Enquiry form'
    heading: 'The form on its own'
    show_details: false
  -
    id: VWAciyvl
    type: map_address
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Map and address'
    heading: 'Where to find us'
    show_hours: true
    zoom: 15
  -
    id: XmOfa2rz
    type: hero
    enabled: true
    tone: default
    spacing: normal
    layout: background
    eyebrow: 'Hero, on a video'
    heading: 'Text on a silent video loop'
    text:
      -
        type: text
        text: 'The picture shows until the video plays, and instead of it for visitors who turn off motion.'
    image: images/hero-pour-over.jpg
    video: videos/pour-over.mp4
    buttons:
      -
        id: gNWMrYl7
        type: link
        label: Primary
        link: '#'
        style: primary
  -
    id: j4kHJzvA
    type: hero
    enabled: true
    tone: primary
    spacing: normal
    layout: split
    image_position: right
    eyebrow: 'Hero, split'
    heading: 'Text beside a picture'
    text:
      -
        type: text
        text: 'The split hero puts the picture on either side.'
    image: images/espresso-machine.jpg
    buttons:
      -
        id: ensDzxPz
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: LtZ6yNd9
        type: link
        label: Outline
        link: '#'
        style: outline
---
