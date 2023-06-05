import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')     // INSERIDA ESTA LINHA 

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './vendor/filament/**/*.blade.php',   //INSERIDA ESTA LINHA 


    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
//  INSERIDAS ESTAS LINHAS
            colors: { 
                danger: colors.rose,
                // primary: colors.blue,
                //INICIO DA CUSTOMIZAÇÃO
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#1e40af', // same as blue-800
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    
                        },

                //FIM
                success: colors.green,
                warning: colors.yellow,
            }, 
// FIM
        },
    },

    plugins: [forms, typography],
};
