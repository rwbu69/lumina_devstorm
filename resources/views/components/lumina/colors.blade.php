<style>
    :root {
        /* Lumina palette (single source of truth) */
        --lumina-blue: #1a4fd9;
        --lumina-gold: #f2c94c;
        --lumina-cream: #fdfbf7;
        --lumina-white: #ffffff;
        --lumina-black: #111827;
        --lumina-red: #ef4444;

        /* RGB (space-separated) for Tailwind "rgb(var(--...)/<alpha>)" */
        --lumina-blue-rgb: 26 79 217;
        --lumina-gold-rgb: 242 201 76;
        --lumina-cream-rgb: 253 251 247;
        --lumina-white-rgb: 255 255 255;
        --lumina-black-rgb: 17 24 39;
        --lumina-red-rgb: 239 68 68;

        /* App semantic tokens */
        --lm-primary: var(--lumina-blue);
        --lm-accent: var(--lumina-gold);
        --lm-bg: var(--lumina-cream);
        --lm-text: var(--lumina-black);

        /* Bootstrap theme mappings */
        --bs-primary: var(--lm-primary);
        --bs-primary-rgb: 26, 79, 217;
        --bs-warning: var(--lm-accent);
        --bs-warning-rgb: 242, 201, 76;
        --bs-danger: var(--lumina-red);
        --bs-danger-rgb: 239, 68, 68;
        --bs-body-bg: var(--lm-bg);
        --bs-body-color: var(--lm-text);
        --bs-link-color: var(--lm-primary);
        --bs-link-hover-color: var(--lm-primary);
    }
</style>
