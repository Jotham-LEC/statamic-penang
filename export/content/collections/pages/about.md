---
id: 2d965e8a-4b77-4e1f-9cd6-607b50994e5f
blueprint: page
title: About
blocks:
  -
    id: patVVllB
    type: hero
    enabled: true
    tone: default
    spacing: normal
    layout: split
    image_position: left
    eyebrow: 'About us'
    heading: 'It started with one roaster in a shophouse'
    text:
      -
        type: text
        text: 'Kopi Lane began in 2016 with a 5 kg roaster, a borrowed shophouse kitchen and a lot of burnt beans. Ten years on, we roast for cafés, offices and kitchens across Malaysia.'
    image: images/espresso-machine.jpg
    buttons:
      -
        id: dEzeM1L0
        type: link
        label: 'Meet the team'
        link: '#team'
        style: outline
  -
    id: NoMcqWRd
    type: text
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Our story'
    heading: 'Good coffee, without the fuss'
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'Mei Ling grew up drinking her grandfather’s kopi in Air Itam, strong and sweet from a cloth sock. When she started roasting, she wanted coffee that tasted like it came from somewhere, without losing what made kopi good.'
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'We buy green coffee from farmers we know by name, in Sabah, Johor and Sumatra, and pay them well above the market price. We roast in small batches twice a week, so nothing sits on a shelf.'
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'The café on Lorong Kopi is where you can taste all of it, and where we test every new coffee before it goes in a bag.'
  -
    id: hGmMVKZi
    type: image_text
    enabled: true
    tone: muted
    spacing: normal
    image: images/green-beans.jpg
    image_position: right
    image_shape: square
    eyebrow: Sourcing
    heading: 'How we buy coffee'
    content:
      -
        type: paragraph
        attrs:
          textAlign: left
        content:
          -
            type: text
            text: 'Sofia visits every farm before we buy, and again at harvest. We agree a price before the season starts, so the farmers know what they will earn.'
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
                    text: 'We buy direct, or through one trusted partner'
          -
            type: listItem
            content:
              -
                type: paragraph
                content:
                  -
                    type: text
                    text: 'We publish what we pay for every lot'
          -
            type: listItem
            content:
              -
                type: paragraph
                content:
                  -
                    type: text
                    text: 'We buy again from the same farms every year'
  -
    id: gIBBMEPf
    type: gallery
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Inside
    heading: 'The roastery and the café'
    layout: grid
    columns: '3'
    captions: true
    lightbox: true
    images:
      - images/green-beans.jpg
      - images/tamping.jpg
      - images/espresso-machine.jpg
      - images/latte-pour.jpg
      - images/copper-kettle.jpg
      - images/cafe-evening.jpg
  -
    id: 3b2LQgkZ
    type: team
    enabled: true
    tone: default
    spacing: normal
    eyebrow: 'Our team'
    heading: 'The people behind the roaster'
    intro:
      -
        type: text
        text: 'Four of us, a roaster named Ah Kow, and a café full of regulars.'
    layout: cards
    anchor: team
  -
    id: OhqlzGgH
    type: logo_strip
    enabled: true
    tone: muted
    spacing: compact
    heading: 'Pouring our coffee'
    layout: row
    logos:
      - logos/lorong-studio.svg
      - logos/roti-ah-seng.svg
      - logos/tanjung-florist.svg
      - logos/pulau-print.svg
      - logos/seri-hotel.svg
  -
    id: Ugq0o7BY
    type: cta
    enabled: true
    tone: default
    spacing: normal
    layout: centred
    heading: 'Come and taste it'
    text:
      -
        type: text
        text: 'The café is open six days a week. The first cup for anyone who mentions this page is on us.'
    buttons:
      -
        id: gayaaUM1
        type: link
        label: 'Find the café'
        link: 'entry::00eafb8d-9bac-4cef-abd2-35d3d42c63dd'
        style: primary
---
