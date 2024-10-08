import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'bottom-left-right': '4px 4px 8px rgba(0, 0, 0, 0.3)',
            },
            colors: {
                'bright-green': {
                  200: '#A4DE02', // Customize this color
                },
                'contessa': {
                  300: '#C5832E', // Customize this color
                },
                'pale-violet': '#D291BC',
                'bright-green': {
                    200: '#A4C639',
                },
                'vivid-yellow': '#FFDD00',
                'contessa': {
                    300: '#C5832E',
                },
            },
        },
    },
    

    plugins: [forms, typography],
};
