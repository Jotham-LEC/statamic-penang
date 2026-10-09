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

// The theme switcher (components/site/theme-switcher): its choices go in a
// cookie the server reads, and the page reloads in the new theme. Choosing a
// preset starts again from that preset.
const themeForm = document.querySelector('[data-theme-form]');

if (themeForm) {
    const cookie = 'penang_theme';
    const save = (choices) => {
        document.cookie = `${cookie}=${encodeURIComponent(JSON.stringify(choices))}; path=/; max-age=2592000; SameSite=Lax`;
        window.location.reload();
    };

    themeForm.querySelector('[name="preset"]').addEventListener('change', (event) => {
        save({ preset: event.target.value });
    });

    themeForm.addEventListener('submit', (event) => {
        event.preventDefault();
        save(Object.fromEntries(new FormData(themeForm)));
    });

    themeForm.querySelector('[data-theme-reset]').addEventListener('click', () => {
        document.cookie = `${cookie}=; path=/; max-age=0; SameSite=Lax`;
        window.location.reload();
    });
}
