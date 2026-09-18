import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#A80707',
                    hover: '#8B0505',
                },
                secondary: '#FFFFFF',
                accent: '#F8F5F0',
                ink: '#222222',
                border: '#ECECEC',
            },
            fontFamily: {
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
                body: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                steam: {
                    '0%': { transform: 'translateY(0) scale(1)', opacity: '0.5' },
                    '50%': { transform: 'translateY(-20px) scale(1.15)', opacity: '0.2' },
                    '100%': { transform: 'translateY(-40px) scale(1.3)', opacity: '0' },
                },
                floaty: {
                    '0%, 100%': { transform: 'translateY(0) rotate(0deg)' },
                    '50%': { transform: 'translateY(-14px) rotate(4deg)' },
                },
            },
            animation: {
                steam: 'steam 3.2s ease-in-out infinite',
                floaty: 'floaty 6s ease-in-out infinite',
            },
        },
    },
    plugins: [],
};
