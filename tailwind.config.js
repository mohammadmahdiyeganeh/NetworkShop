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
            fontFamily: {
                // فونت پیش‌فرض: وزیر + Figtree + سیستم
                sans: ['Vazirmatn', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#1d4ed8',
                success: '#10b981',
                danger: '#ef4444',
            },
        },
    },

    plugins: [forms],
};