import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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
                serif: ['Playfair Display', 'Merriweather', 'serif'], // Font koran
            },
            colors: {
                paper: '#F4F1EA', // Warna kertas koran
                ink: '#1A1A1A',   // Hitam tinta (tidak pekat total agar nyaman)
                line: '#000000',  // Garis batas tegas
            }
        },
    },

    plugins: [forms],
};
