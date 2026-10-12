---
id: 049ed0c0-9796-43f7-b158-4f6129328c12
blueprint: page
title: Home
blocks:
  -
    id: qY7iUmFr
    type: hero
    enabled: true
    tone: default
    spacing: normal
    layout: background
    eyebrow: 'Roasted in George Town'
    heading: 'Coffee worth slowing down for'
    text:
      -
        type: text
        text: 'We roast small batches of beans from '
      -
        type: text
        marks:
          -
            type: bold
        text: 'Malaysian and Southeast Asian farms'
      -
        type: text
        text: ' every week, and brew them in our café on Lorong Kopi.'
    image: images/hero-baristas.jpg
    buttons:
      -
        id: BsyMEK5r
        type: link
        label: 'Shop our coffee'
        link: 'entry::7ebbe4d3-7376-4f23-9a3a-1c2f281d5e1d'
        style: primary
      -
        id: 2TURgUYB
        type: link
        label: 'Visit the café'
        link: 'entry::00eafb8d-9bac-4cef-abd2-35d3d42c63dd'
        style: outline
    from_price: true
  -
    id: lN6NnkTh
    type: feature_grid
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Why Kopi Lane'
    heading: 'From the farm to your cup, done properly'
    intro:
      -
        type: text
        text: 'Everything we sell is roasted by us, in Penang, within the week.'
    layout: grid
    columns: '3'
    items:
      -
        id: 2ESx3xyD
        icon: leaf
        title: 'Bought from people we know'
        text: 'We buy straight from farms in Sabah, Johor and Sumatra, and pay well above the market price.'
      -
        id: C0kh9TK8
        icon: clock
        title: 'Roasted twice a week'
        text: 'Every Tuesday and Friday, in small batches, so your coffee is never more than a week old.'
      -
        id: OJAFYaDb
        icon: truck
        title: 'Delivered across Malaysia'
        text: 'Order by noon and we post the same day. Free delivery on orders over RM 150.'
  -
    id: c5hOkY2f
    type: product_cards
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Shop
    heading: 'Our coffee and gear'
    source: featured
    limit: 4
    columns: '4'
    all_link: true
  -
    id: SqUsQN1w
    type: image_text
    enabled: true
    tone: default
    spacing: normal
    image: images/latte-pour.jpg
    image_position: left
    image_shape: landscape
    eyebrow: 'The café'
    heading: 'A quiet corner of George Town'
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'Our café is a restored shophouse two streets from the waterfront, with the roaster at the back and the coffee we roasted that week on the bar.'
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'Come for a kopi, stay for a pour-over, and leave with a bag of whatever you liked best.'
    buttons:
      -
        id: uLyvTgnD
        type: link
        label: 'Opening hours'
        link: 'entry::00eafb8d-9bac-4cef-abd2-35d3d42c63dd'
        style: outline
  -
    id: wn3kdIxc
    type: stats
    enabled: true
    tone: primary
    spacing: normal
    heading: 'Ten years of roasting'
    layout: row
    stats:
      -
        id: dv760ZrO
        value: '2016'
        label: 'Roasting since'
      -
        id: RbY3FdHB
        value: '14'
        label: 'Farms we buy from'
      -
        id: B36sTuP3
        value: '6,000+'
        label: 'Bags roasted last year'
      -
        id: OvFwAGW7
        value: '4.9'
        label: 'Average Google rating'
  -
    id: U1NoHx4C
    type: testimonial
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Kind words'
    heading: 'What our customers say'
    layout: grid
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
    id: BqukMu3X
    type: recent_posts
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: 'From the blog'
    heading: 'Notes from the roastery'
    layout: cards
    limit: 3
    all_link: true
  -
    id: TYU1lDlk
    type: cta
    enabled: true
    tone: default
    spacing: normal
    layout: panel
    heading: 'Coffee for your café or office'
    text:
      -
        type: text
        text: 'Wholesale prices from 5 kg a month, a grinder on loan, and training for your staff.'
    buttons:
      -
        id: 6zPaBB7c
        type: link
        label: 'Ask about wholesale'
        link: 'entry::00eafb8d-9bac-4cef-abd2-35d3d42c63dd'
        style: primary
      -
        id: r3iyl3Kg
        type: whatsapp
        label: 'WhatsApp us'
        style: outline
        whatsapp_message: 'Hello Kopi Lane! I’d like to ask about wholesale.'
seo:
  title: 'Kopi Lane Roasters: small-batch coffee from George Town, Penang'
---
