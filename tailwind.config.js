import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        'node_modules/preline/dist/*.js',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                // Near-black surfaces
                ink: {
                    950: '#09090a',
                    900: '#0f0f11',
                    850: '#141417',
                    800: '#1a1a1e',
                    700: '#25252a',
                    600: '#393940',
                    500: '#55555d',
                },
                // Warm off-white for type and product tiles
                bone: {
                    DEFAULT: '#ece6dc',
                    50: '#f7f4ef',
                    100: '#efe9df',
                    200: '#e2dacd',
                    300: '#c9c0b1',
                    400: '#a39b8e',
                    500: '#8a8378',
                },
                // Single accent: ember / dried blood
                ember: {
                    DEFAULT: '#d4452b',
                    300: '#f08a6f',
                    400: '#e5603f',
                    500: '#d4452b',
                    600: '#b33620',
                    700: '#8f2a18',
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Anton', 'Impact', ...defaultTheme.fontFamily.sans],
                gothic: ['"UnifrakturMaguntia"', 'serif'],
            },
            letterSpacing: {
                widest2: '0.3em',
            },
            keyframes: {
                marquee: {
                    from: { transform: 'translateX(0)' },
                    to: { transform: 'translateX(-50%)' },
                },
                rise: {
                    from: { opacity: '0', transform: 'translateY(18px)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-14px)' },
                },
                glow: {
                    '0%, 100%': { opacity: '0.55' },
                    '50%': { opacity: '0.9' },
                },
            },
            animation: {
                marquee: 'marquee 38s linear infinite',
                'marquee-slow': 'marquee 60s linear infinite',
                rise: 'rise .7s cubic-bezier(.2,.7,.2,1) both',
                float: 'float 7s ease-in-out infinite',
                glow: 'glow 6s ease-in-out infinite',
            },
        },
    },
    plugins: [
        require('preline/plugin'),
    ],
};
