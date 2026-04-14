import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'lumina-blue': 'rgb(var(--lumina-blue-rgb) / <alpha-value>)',
                'lumina-gold': 'rgb(var(--lumina-gold-rgb) / <alpha-value>)',
                'lumina-cream': 'rgb(var(--lumina-cream-rgb) / <alpha-value>)',
                'lumina-white': 'rgb(var(--lumina-white-rgb) / <alpha-value>)',
                'lumina-black': 'rgb(var(--lumina-black-rgb) / <alpha-value>)',
                'lumina-red': 'rgb(var(--lumina-red-rgb) / <alpha-value>)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
