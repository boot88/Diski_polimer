// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Instrument Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Основной акцентный цвет (оранжевый/песок)
                primary: {
                    50: '#fef8ec',
                    100: '#fcedca',
                    200: '#f8d88f',
                    300: '#f4bd54',
                    400: '#f1a229', // Основной акцент
                    500: '#eb8610',
                    600: '#d0650b',
                    700: '#ad480d',
                    800: '#8d3811',
                    900: '#732f11',
                },
                // Дополнительный цвет (синий для доверия)
                secondary: {
                    50: '#eff9ff',
                    100: '#def1ff',
                    200: '#b6e4ff',
                    300: '#76d0ff',
                    400: '#2eb7ff',
                    500: '#029bf1',
                    600: '#007bce',
                    700: '#0062a7',
                    800: '#02528a',
                    900: '#084572',
                },
                // Нейтральный темный (серый/уголь)
                neutral: {
    50: '#f7f7f7',
    100: '#e3e3e3',
    200: '#c8c8c8',
    300: '#a4a4a4',
    400: '#818181',
    500: '#666666',
    600: '#515151',
    700: '#434343',
    800: '#383838',
    900: '#121212', // Добавьте 900 если нужно
    950: '#000000'  // Или 950 для совсем черного
}
            },
        },
    },
    plugins: [],
}
