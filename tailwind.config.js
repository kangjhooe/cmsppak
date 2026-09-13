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
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Pondok Pesantren Al-Falah Brand Colors
                primary: {
                    DEFAULT: '#008000', // Hijau dominan dari logo
                    light: '#00A000',
                    dark: '#006600',
                    50: '#f0fff0',
                    100: '#e0ffe0',
                    200: '#c0ffc0',
                    300: '#a0ffa0',
                    400: '#80ff80',
                    500: '#008000',
                    600: '#006600',
                    700: '#004d00',
                    800: '#003300',
                    900: '#001a00',
                },
                secondary: {
                    DEFAULT: '#CCFF99', // Hijau muda dari logo
                    light: '#E0FFB3',
                    dark: '#B3FF80',
                    50: '#f9fff9',
                    100: '#f3fff3',
                    200: '#e7ffe7',
                    300: '#dbffdb',
                    400: '#cfffcf',
                    500: '#CCFF99',
                    600: '#B3FF80',
                    700: '#99ff66',
                    800: '#80ff4d',
                    900: '#66ff33',
                },
                accent: {
                    DEFAULT: '#FFFF00', // Kuning dari logo
                    light: '#FFFF33',
                    dark: '#E6E600',
                    50: '#fffff0',
                    100: '#ffffe0',
                    200: '#ffffc0',
                    300: '#ffffa0',
                    400: '#ffff80',
                    500: '#FFFF00',
                    600: '#E6E600',
                    700: '#cccc00',
                    800: '#b3b300',
                    900: '#999900',
                },
                highlight: {
                    DEFAULT: '#FFFFFF', // Putih dari logo
                    light: '#FFFFFF',
                    dark: '#F0F0F0',
                    50: '#ffffff',
                    100: '#fafafa',
                    200: '#f5f5f5',
                    300: '#f0f0f0',
                    400: '#e5e5e5',
                    500: '#FFFFFF',
                    600: '#F0F0F0',
                    700: '#e0e0e0',
                    800: '#d0d0d0',
                    900: '#c0c0c0',
                },
                // Text colors
                'text-dark': '#222222',
                'text-light': '#FFFFFF',
                // Background colors
                'bg-primary': '#f0fff0', // Light green background
                'bg-secondary': '#f9fff9', // Very light green background
            },
            boxShadow: {
                'primary': '0 4px 14px 0 rgba(0, 128, 0, 0.15)',
                'secondary': '0 4px 14px 0 rgba(204, 255, 153, 0.15)',
                'accent': '0 4px 14px 0 rgba(255, 255, 0, 0.25)',
                'highlight': '0 4px 14px 0 rgba(255, 255, 255, 0.15)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'bounce-gentle': 'bounceGentle 2s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                bounceGentle: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-5px)' },
                }
            }
        },
    },

    plugins: [forms, typography],
};
