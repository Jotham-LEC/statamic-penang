// Light and dark: the header's switch saves the visitor's choice (the layout
// applies it before the page paints).
document.querySelectorAll('[data-mode-toggle]').forEach((button) => {
    const root = document.documentElement;
    const isDark = () =>
        root.dataset.theme === 'dark' ||
        (!root.dataset.theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
    const label = () => button.setAttribute('aria-pressed', String(isDark()));

    label();
    button.addEventListener('click', () => {
        const mode = isDark() ? 'light' : 'dark';
        root.dataset.theme = mode;
        try {
            localStorage.setItem('penang-mode', mode);
        } catch (e) {}
        label();
    });
});

// The theme switcher (components/site/theme-switcher): the chosen preset goes
// in a cookie the server reads, and the page reloads in it.
const themeForm = document.querySelector('[data-theme-form]');

if (themeForm) {
    const cookie = 'penang_theme';
    const reload = (value, maxAge) => {
        document.cookie = `${cookie}=${value}; path=/; max-age=${maxAge}; SameSite=Lax`;
        window.location.reload();
    };

    themeForm.querySelector('[name="preset"]').addEventListener('change', (event) => {
        reload(encodeURIComponent(JSON.stringify({ preset: event.target.value })), 2592000);
    });
    themeForm.addEventListener('submit', (event) => event.preventDefault());
    themeForm.querySelector('[data-theme-reset]').addEventListener('click', () => reload('', 0));
}

// Dropdowns (the main menu's second level): the button shows and hides its
// list; Escape, a click elsewhere or moving focus away closes it.
document.querySelectorAll('[data-disclosure]').forEach((item) => {
    const button = item.querySelector('[data-disclosure-button]');
    const list = document.getElementById(button.getAttribute('aria-controls'));
    const toggle = (open) => {
        button.setAttribute('aria-expanded', String(open));
        list.hidden = !open;
    };

    button.addEventListener('click', () => toggle(button.getAttribute('aria-expanded') !== 'true'));
    item.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !list.hidden) {
            toggle(false);
            button.focus();
        }
    });
    item.addEventListener('focusout', (event) => {
        if (!item.contains(event.relatedTarget)) toggle(false);
    });
    document.addEventListener('click', (event) => {
        if (!item.contains(event.target)) toggle(false);
    });
});

// The announcement bar: closing it keeps it closed until its text changes.
document.querySelectorAll('[data-announcement-close]').forEach((button) => {
    const bar = button.closest('[data-announcement]');
    button.addEventListener('click', () => {
        bar.hidden = true;
        try {
            localStorage.setItem('penang-announcement', bar.dataset.announcement);
        } catch (e) {}
    });
});

// Gallery: a picture opens larger in the section's <dialog>. Escape closes
// it (the browser does), the arrow keys and buttons move through them.
document.querySelectorAll('[data-gallery]').forEach((gallery) => {
    const dialog = gallery.parentElement.querySelector('[data-gallery-dialog]');
    const items = [...gallery.querySelectorAll('[data-gallery-item]')];
    const image = dialog.querySelector('[data-gallery-image]');
    const caption = dialog.querySelector('[data-gallery-caption]');
    const count = dialog.querySelector('[data-gallery-count]');
    let current = 0;
    let opener = null;

    const show = (index) => {
        current = (index + items.length) % items.length;
        const item = items[current];
        image.src = item.href;
        image.alt = item.querySelector('img')?.alt ?? '';
        caption.textContent = item.dataset.caption ?? '';
        count.textContent = `${current + 1} / ${items.length}`;
    };

    items.forEach((item, index) =>
        item.addEventListener('click', (event) => {
            event.preventDefault();
            opener = item;
            show(index);
            dialog.showModal();
        }),
    );
    dialog.querySelector('[data-gallery-prev]').addEventListener('click', () => show(current - 1));
    dialog.querySelector('[data-gallery-next]').addEventListener('click', () => show(current + 1));
    dialog.querySelector('[data-gallery-close]').addEventListener('click', () => dialog.close());
    dialog.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') show(current - 1);
        if (event.key === 'ArrowRight') show(current + 1);
    });
    // A click on the backdrop (outside the picture and buttons) closes it.
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });
    dialog.addEventListener('close', () => opener?.focus());
    if (items.length < 2) {
        dialog.querySelectorAll('[data-gallery-prev], [data-gallery-next]').forEach((b) => (b.hidden = true));
    }
});

// Video: nothing loads from YouTube or Vimeo until the visitor presses play;
// then the cover becomes the player.
document.querySelectorAll('[data-video-play]').forEach((button) => {
    button.addEventListener('click', () => {
        const box = button.closest('[data-video]');
        const player =
            box.dataset.video === 'file' ? document.createElement('video') : document.createElement('iframe');
        player.src = box.dataset.videoSrc;
        player.title = box.dataset.videoTitle;
        player.className = 'absolute inset-0 size-full';
        if (box.dataset.video === 'file') {
            player.controls = true;
            player.autoplay = true;
        } else {
            player.allow = 'autoplay; encrypted-media; picture-in-picture; fullscreen';
            player.allowFullscreen = true;
        }
        box.replaceChildren(player);
        player.focus();
    });
});

// Tabs: the ARIA tabs pattern. Arrow keys, Home and End move between tabs.
document.querySelectorAll('[data-tabs]').forEach((tabs) => {
    const buttons = [...tabs.querySelectorAll('[role="tab"]')];
    const select = (tab, focus = false) => {
        buttons.forEach((b) => {
            const selected = b === tab;
            b.setAttribute('aria-selected', String(selected));
            b.tabIndex = selected ? 0 : -1;
            document.getElementById(b.getAttribute('aria-controls')).hidden = !selected;
        });
        if (focus) tab.focus();
    };

    buttons.forEach((tab, index) => {
        tab.addEventListener('click', () => select(tab));
        tab.addEventListener('keydown', (event) => {
            const to = { ArrowRight: index + 1, ArrowLeft: index - 1, Home: 0, End: buttons.length - 1 }[event.key];
            if (to === undefined) return;
            event.preventDefault();
            select(buttons[(to + buttons.length) % buttons.length], true);
        });
    });
});

// Carousel (Testimonials): the buttons scroll by one card.
document.querySelectorAll('[data-carousel]').forEach((carousel) => {
    const track = carousel.querySelector('[data-carousel-track]');
    const step = () => track.firstElementChild.getBoundingClientRect().width + 24;
    carousel.querySelector('[data-carousel-prev]').addEventListener('click', () => track.scrollBy({ left: -step() }));
    carousel.querySelector('[data-carousel-next]').addEventListener('click', () => track.scrollBy({ left: step() }));
});

// The hero's background video plays, unless the visitor turns off motion.
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('[data-hero-video]').forEach((video) => {
        video.play().catch(() => {});
    });
}
