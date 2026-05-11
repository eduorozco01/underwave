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
            },
            fontFamily: {
                // Títulos Pop-Art / Industriales
                serif: ['"Times New Roman"', 'Georgia', ...defaultTheme.fontFamily.serif],
                // Datos técnicos y UI Techwear
                mono: ['"Courier New"', 'Courier', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                // Sombras rígidas sin difuminado estilo Neo-Brutalista
                'brutal': '8px 8px 0px 0px rgba(0,0,0,1)',
                'brutal-sm': '4px 4px 0px 0px rgba(0,0,0,1)',
            }
        },
    },

    plugins: [forms],
};