---
id: 084260a5-b635-44f8-8f2f-f9f4b1c06f38
blueprint: page
title: Components
template: showcase
seo:
  noindex: true
  sitemap: false
blocks:
  -
    id: 4xpCjpld
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
        id: Aqap3BEN
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: N3fIntPS
        type: phone
        label: 'Call us'
        style: outline
      -
        id: Pc4fUybT
        type: email
        label: 'Email us'
        style: secondary
  -
    id: lxG3XPAn
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
    id: D2NgTWDj
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
        id: YF1dKgCy
        type: link
        label: 'A button'
        link: '#'
        style: primary
  -
    id: jaAx22yG
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
    id: wSh7Vx9Q
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
    id: k3Znm21C
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
    id: e7GI74aj
    type: steps
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Steps, as a timeline'
    heading: 'From farm to cup'
    layout: vertical
    steps:
      -
        id: hl85qwyZ
        label: Jan
        title: Harvest
        text: 'Sofia visits the farms as the cherries are picked.'
      -
        id: EJDuVdkx
        label: Mar
        title: Shipping
        text: 'Green coffee arrives in George Town.'
      -
        id: Vx9Q0hvR
        label: Tue
        title: Roasting
        text: 'Every Tuesday and Friday, in small batches.'
      -
        id: YtS0Hhhi
        title: 'Your cup'
        text: 'Steps are numbered unless they have a label.'
  -
    id: VD4tgwUP
    type: tabs
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Tabs
    heading: 'One panel at a time'
    tabs:
      -
        id: KfDM3AR9
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
        id: DTtEGF1b
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
        id: lIjH0poa
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
    id: UEaU3mVI
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
    id: wQJJ3J5O
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
        id: GCF36cYk
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
            id: bX4WvRHl
            type: link
            label: 'Ask about it'
            link: '#'
            style: outline
      -
        id: Ur9aU38R
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
            id: zTna34s0
            type: whatsapp
            label: 'Ask on WhatsApp'
            style: primary
      -
        id: 1tBxKzUA
        name: Office
        price: 'From RM 150'
        period: 'per month'
        description: 'Drip bags and beans for the team.'
        features:
          - 'Drip bags or beans'
          - 'Delivered monthly'
        buttons:
          -
            id: O0Mnd779
            type: link
            label: 'Ask about it'
            link: '#'
            style: outline
    note: 'Prices before delivery. Cancel any month.'
  -
    id: xrnRQaOY
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
        id: An4Nh2v9
        icon: coffee
        title: Icons
        text: 'Each point can have an icon.'
      -
        id: Fp54QNta
        icon: award
        title: Cards
        text: 'Points as cards, as plain icons, or listed beside the heading.'
      -
        id: zeP5sZJd
        icon: users
        title: Columns
        text: 'Two, three or four columns.'
      -
        id: jSyFHbX8
        icon: sparkles
        title: Tones
        text: 'Any section can sit on any background.'
  -
    id: TiWEkXDG
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
        id: gDqRylGY
        image: images/cup-of-beans.jpg
        title: 'House Blend'
        text: 'Any point can show a picture instead of an icon.'
      -
        id: Ei8qvUCH
        image: images/drip-set.jpg
        title: 'Drip bags'
        text: 'Handy for a product, a service or a place.'
      -
        id: bnwFGmmg
        image: images/copper-kettle.jpg
        title: 'Brewing gear'
        text: 'Pictures and icons can mix in one section.'
  -
    id: LfXDY7RY
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
        id: ELvN2HGm
        icon: shield-check
        title: One
        text: 'A point with an icon.'
      -
        id: DTBC7N9v
        icon: heart
        title: Two
        text: 'Another point.'
      -
        id: rCzdXIQU
        icon: gift
        title: Three
        text: 'A third.'
      -
        id: q86aH37Z
        icon: package
        title: Four
        text: 'And a fourth.'
  -
    id: ow3tvpK7
    type: product_cards
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Products, chosen'
    heading: 'Three products chosen by hand'
    source: picked
    products:
      - 01919e05-c2d9-41f6-a294-976145221060
      - c803e06c-e460-4161-af3d-28ad54d39d73
      - 2bdf60b3-6180-4340-bbdc-8755d2d131da
    columns: '3'
    all_link: false
  -
    id: pjvayorY
    type: team
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Team, compact'
    heading: 'Small photos'
    layout: compact
  -
    id: o79QwKMd
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
    id: aHUMBsWo
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    layout: single
    testimonials:
      -
        id: hNmp1oQ3
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
        rating: '5'
        logo: logos/roti-ah-seng.svg
  -
    id: W7VNShXI
    type: testimonial
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Testimonials, carousel'
    heading: 'With stars and where they were left'
    layout: carousel
    testimonials:
      -
        id: EPeDUSRA
        quote: 'The House Blend is the only coffee my whole office agrees on. Orders arrive two days after roasting, every time.'
        name: 'Farah Aziz'
        role: 'Office manager, Lorong Studio'
        rating: '5'
        source: google
      -
        id: hNmp1oQ3
        quote: 'We switched our café to Kopi Lane’s Liberica last year. Customers ask for it by name now.'
        name: 'Tan Wei Ming'
        role: 'Owner, Roti Ah Seng'
        rating: '5'
        logo: logos/roti-ah-seng.svg
      -
        id: dKeJ0I1D
        quote: 'Mei Ling spent an hour helping me set up my new grinder. That’s the kind of shop this is.'
        name: 'Priya Raman'
        role: 'Home brewer'
        rating: '5'
        source: facebook
      -
        id: vgoQW06c
        quote: 'Good coffee, fair prices and the drip bags are perfect for the office. Delivery to KL took two days.'
        name: 'Daniel Wong'
        role: 'Kuala Lumpur'
        rating: '4'
        source: google
  -
    id: WfvUqGJd
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Testimonials, a note from the team'
    layout: single
    testimonials:
      -
        id: 02fxfetd
        quote: |-
          Ten years ago we roasted our first batch on a borrowed machine, and burnt most of it.

          Thank you for every cup since: for coming back, for telling your friends, and for your patience on the Tuesdays we sold out.
        name: ''
    signatories:
      -
        id: MAau3G5e
        name: 'Lim Mei Ling'
        role: Founder
        photo: images/team-mei-ling.jpg
      -
        id: I3WCsEim
        name: 'Luca Moretti'
        role: 'Café manager'
        photo: images/team-luca.jpg
    sign_off: 'With thanks,'
    signature_names: true
    buttons:
      -
        id: S0UGLwxD
        type: link
        label: 'Meet the team'
        link: '/about#team'
        style: outline
  -
    id: oJ1mjfmU
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
    id: gEhB8mB9
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
    id: jALqgYx8
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
        id: Ctl3exJ2
        value: '12'
        label: 'A figure'
      -
        id: b8Cl9iHA
        value: 98%
        label: Another
      -
        id: PQiUlGm2
        value: 'RM 2k'
        label: 'Any short text'
      -
        id: 6BMT4gmD
        value: 24/7
        label: 'Up to four'
  -
    id: U6do8Ok5
    type: faq
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Questions, side by side'
    heading: 'The heading beside the questions'
    layout: side
    items:
      -
        id: 6opgqtO7
        question: 'How do I order?'
        answer: 'Send us a WhatsApp message or the enquiry form with what you would like. We reply with the total and payment details (DuitNow QR or bank transfer), and post your order once it is paid.'
      -
        id: KP4ICYcj
        question: 'Do you deliver outside Penang?'
        answer: 'Yes, anywhere in Malaysia, usually in one to three working days. Delivery is free on orders over RM 150; below that it is RM 10 to the peninsula and RM 15 to Sabah and Sarawak.'
      -
        id: tTtGsoNO
        question: 'When are the beans roasted?'
        answer: 'Every Tuesday and Friday. We post within two days of roasting, so your coffee is never more than a week old when it arrives.'
  -
    id: 6nYWGtKX
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
        id: 9gxaWtEn
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: 1H8XZoFc
        type: whatsapp
        label: WhatsApp
        style: secondary
  -
    id: EpVxguyC
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
        id: 6A1JT7j3
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: VoVcP7Ci
        type: link
        label: Outline
        link: '#'
        style: outline
  -
    id: ZEUTK0Bi
    type: contact_form
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Enquiry form'
    heading: 'The form on its own'
    show_details: false
  -
    id: j4jnXlvu
    type: map_address
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'Map and address'
    heading: 'Where to find us'
    show_hours: true
    zoom: 15
  -
    id: cdKcONED
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
        id: msGrRUph
        type: link
        label: Primary
        link: '#'
        style: primary
  -
    id: Omz3dbDF
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
        id: TL4wFfra
        type: link
        label: Primary
        link: '#'
        style: primary
      -
        id: I20cggXK
        type: link
        label: Outline
        link: '#'
        style: outline
---
