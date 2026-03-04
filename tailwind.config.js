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
                'electric-blue': '#1447d4',
                'off-white-blue': '#f4f4f3',
                'off-white': '#f9f9f8',
                'light-gray': '#e8e8e7',
                'navy-blue': '#04247b',
                'like-green': '#10a810',
            },
            spacing: {
                '1.5': '0.375rem',
            },
            fontFamily: {
                // Set General Sans as your primary sans-serif
                sans: ['General Sans', ...defaultTheme.fontFamily.sans],

                // Formula Variations
                'formula': ['PP Formula', 'sans-serif'],
                'formula-cond': ['PP Formula Condensed', 'sans-serif'],
                'formula-ext': ['PP Formula Extended', 'sans-serif'],
                'formula-narrow': ['PP Formula Narrow', 'sans-serif'],
                'formula-semi-cond': ['PP Formula SemiCondensed', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
