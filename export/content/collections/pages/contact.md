---
id: 6226ac0a-09f6-4f56-b65e-87dfae10b80f
blueprint: page
title: Contact
blocks:
  -
    id: GnfUNZYm
    type: hero
    enabled: true
    tone: default
    spacing: compact
    layout: centred
    eyebrow: Contact
    heading: 'Come and say hello'
    text:
      -
        type: text
        text: 'Questions about an order, wholesale, or which beans to try? Message us on WhatsApp, send the form, or drop by the café.'
  -
    id: NZ5GmXqE
    type: steps
    enabled: true
    tone: default
    spacing: compact
    eyebrow: Ordering
    heading: 'How ordering works'
    layout: horizontal
    steps:
      -
        id: eZnkz1VM
        icon: messages-square
        title: 'Tell us what you’d like'
        text: 'On WhatsApp or with the form below: the coffee, how much, and how you brew.'
      -
        id: 7FjBG741
        icon: receipt
        title: 'We send the total'
        text: 'With delivery, and how to pay: DuitNow QR or bank transfer.'
      -
        id: nHgOYitf
        icon: truck
        title: 'We roast and post'
        text: 'Within two days of roasting, anywhere in Malaysia.'
  -
    id: JYjSYfi3
    type: contact_form
    enabled: true
    tone: default
    spacing: normal
    heading: 'Send us a message'
    intro:
      -
        type: text
        text: 'We reply within one working day.'
    show_details: true
    anchor: enquiry
  -
    id: KdVJQl5c
    type: map_address
    enabled: true
    tone: muted
    spacing: normal
    eyebrow: Visit
    heading: 'The café on Lorong Kopi'
    intro:
      -
        type: text
        text: 'Two streets from the waterfront. Street parking on Lebuh Pantai after 6 pm and all day on Sundays.'
    show_hours: true
    zoom: 16
    anchor: visit
  -
    id: x6wTjSZq
    type: table
    enabled: true
    tone: default
    spacing: normal
    eyebrow: Delivery
    heading: 'Delivery across Malaysia'
    header_row: true
    header_column: true
    table:
      -
        cells:
          - Where
          - Delivery
          - 'Usually arrives'
      -
        cells:
          - Penang
          - 'Free over RM 80, else RM 6'
          - 'Next working day'
      -
        cells:
          - 'Peninsular Malaysia'
          - 'Free over RM 150, else RM 10'
          - '1–2 working days'
      -
        cells:
          - 'Sabah and Sarawak'
          - 'Free over RM 200, else RM 15'
          - '2–4 working days'
    caption: 'Cafés and offices on a wholesale plan get free delivery on every order.'
  -
    id: eG3qlqGq
    type: faq
    enabled: true
    tone: default
    spacing: normal
    eyebrow: FAQ
    heading: 'Questions we hear often'
    intro:
      -
        type: text
        text: 'Something else? '
      -
        type: text
        marks:
          -
            type: link
            attrs:
              href: '#enquiry'
        text: 'Send us a message'
      -
        type: text
        text: ' and we’ll answer within a day.'
    layout: accordion
    items:
      -
        id: UbkK5AKN
        question: 'How do I order?'
        answer: 'Send us a WhatsApp message or the enquiry form with what you would like. We reply with the total and payment details (DuitNow QR or bank transfer), and post your order once it is paid.'
      -
        id: xIjuZ0Tu
        question: 'Do you deliver outside Penang?'
        answer: 'Yes, anywhere in Malaysia, usually in one to three working days. Delivery is free on orders over RM 150; below that it is RM 10 to the peninsula and RM 15 to Sabah and Sarawak.'
      -
        id: kXiWqV5m
        question: 'When are the beans roasted?'
        answer: 'Every Tuesday and Friday. We post within two days of roasting, so your coffee is never more than a week old when it arrives.'
      -
        id: CNeAbPXz
        question: 'Whole beans or ground?'
        answer: 'Either. Tell us how you brew (espresso, pour-over, French press, kopi sock) and we grind for it.'
      -
        id: SySKJx31
        question: 'Do you supply cafés and offices?'
        answer: 'Yes. Wholesale prices start from 5 kg a month, and we lend cafés a grinder and train their staff. Ask Daniel through the enquiry form.'
---
