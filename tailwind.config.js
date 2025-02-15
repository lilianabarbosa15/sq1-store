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
                orange: {
                    400: '#A86A3D',
                },
                blue: {
                    50: '#DEDFE1',
                    100: '#DBD0CC',
                    500: '#1456FF',
                    950: '#323334',
                },
                gray: { 
                    25: '#F5F5F5',
                    50: '#F3F3F3',
                    100: '#F1F1F1',
                    150: '#DEDEDE',
                    200: '#CCCCCC',
                    400: '#8A8A8A',
                    600: '#666666',
                    700: '#484848',
                    900: '#191919',
                },
                primary: {
                    50: '#F8F8F8',
                    100: '#FDEFEE',
                    200: '#F8CCCC',
                    400: '#FF706B',
                    500: '#DA3F3F',
                    550: '#EF2D2D',
                    600: '#ED1C24',     //
                },
            },
            screens: {
                'xs': '375px',
                '2xs': '427px',
                'sm': '500px',
                '2sm': '670px',
                'md': '768px',
                '2md': '860px',
                '3md': '1024px',
                'l': '1060px',
                'xl': '1280px',
                '2xl': '1536px',
            },
            keyframes: {
                "full-tl": {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(-100%)" },
                },
                "full-tr": {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(100%)" },
                },
            },
            animation: {
                "full-tl": "full-tl 25s linear infinite",
                "full-tr": "full-tr 25s linear infinite",
            },
            fontFamily: {
                roboto: ['Roboto', 'sans-serif'],   //
                sans: ['Poppins', ...defaultTheme.fontFamily.sans], //
                volkhov: ['Volkhov', 'serif'],
                jost: ['Jost', 'sans-serif'],
            },
        },
    },

    plugins: [ forms ],
};
