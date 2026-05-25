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
                'under-beige': '#F2F0E9', // Fondo poosuit
                'under-neon': '#CCFF00',  // Amarillo neón tech
                'under-green': '#00FF00', // Verde neón activo
                'uw-bg': 'var(--color-bg)',
                'uw-text': 'var(--color-text)',
                'uw-border': 'var(--color-border)',
                'uw-accent': 'var(--color-accent)',
                'uw-card': 'var(--color-card)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['"Syne"', 'sans-serif'], // Titulares pesados
                mono: ['"Space Mono"', 'monospace'], // Textos técnicos y botones
            },
            boxShadow: {
                // Sombras rígidas sin difuminado estilo Neo-Brutalista
                'brutal': '8px 8px 0px 0px var(--color-border)',
                'brutal-sm': '4px 4px 0px 0px var(--color-border)',
            }
        },
    },

    plugins: [forms],
};