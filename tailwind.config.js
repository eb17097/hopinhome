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
            },
            spacing: {
                '1.5': '0.375rem',
            },
            fontFamily: {
                sans: ['General Sans Variable', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
