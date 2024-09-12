import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/frontend/styles.scss',
                'resources/scss/frontend/app.scss',
                'resources/js/app.js',
                'resources/js/main.js',,
                'resources/js/cart/cartManager.js',
                'resources/js/cart/sessionCartManager.js',
                'resources/js/googleMaps/maps.js',
            ],
            refresh: true,
        }),
    ],
});
