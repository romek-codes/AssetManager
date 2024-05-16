import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("daisyui")],

    daisyui: {
        base: false,
        themes: [
            "light",
            "business",
            {
                dark: {
                    ...require("daisyui/src/theming/themes")["[data-theme=dark]"],
                    "base-200": '#1c1c1c',
                },
            },
        ],
    },
};

