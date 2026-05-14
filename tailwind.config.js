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
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                display: ['Syne', 'sans-serif'],
            },
            colors: {
                teal: {
                    50: '#f0fdf9',
                    100: '#ccfbef',
                    200: '#99f6e0',
                    300: '#5eead4',
                    400: '#2DC5A2',
                    500: '#14b8a6',
                    600: '#0d9488',
                    700: '#0f766e',
                },
                brand: '#2DC5A2',
            },
            keyframes: {
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' }
                },
                slideIn: {
                    '0%': { opacity: '0', transform: 'translateX(-20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' }
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' }
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' }
                },
                pulse2: {
                    '0%,100%': { opacity: '1', transform: 'scale(1)' },
                    '50%': { opacity: '.5', transform: 'scale(1.5)' }
                },
                ringPulse: {
                    '0%,100%': { opacity: '.15', transform: 'translate(-50%,-50%) scale(1)' },
                    '50%': { opacity: '.45', transform: 'translate(-50%,-50%) scale(1.04)' }
                },
                barGrow: {
                    '0%': { height: '0' },
                    '100%': { height: 'var(--h)' }
                },
                drawLine: {
                    '0%': { strokeDashoffset: '1000' },
                    '100%': { strokeDashoffset: '0' }
                },
                clipOut: {
                    '0%': { clipPath: 'inset(0 0 0 0)' },
                    '100%': { clipPath: 'inset(0 0 100% 0)' }
                },
            },
            animation: {
                fadeUp: 'fadeUp .6s cubic-bezier(.22,1,.36,1) forwards',
                slideIn: 'slideIn .6s cubic-bezier(.22,1,.36,1) forwards',
                fadeIn: 'fadeIn .5s ease forwards',
                pulse2: 'pulse2 2s ease-in-out infinite',
                ringPulse: 'ringPulse 3s ease-in-out infinite',
                clipOut: 'clipOut .75s cubic-bezier(.76,0,.24,1) forwards',
            },
        },
    },

    plugins: [forms],
};
