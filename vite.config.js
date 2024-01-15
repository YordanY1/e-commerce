import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/frontend/styles.scss',
                'resources/scss/frontend/app.scss',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/js/products/productsIntoBasket.js',
                'resources/js/cart/cartManager.js',
                'resources/js/cart/sessionCartManager.js',
                'resources/js/checkout/checkout.js',
                'resources/scss/admin/app.scss',
                'resources/js/admin/app.js',
                'resources/js/admin/manufacturers/app.js',
                'resources/js/admin/categories/app.js',
                'resources/js/admin/products/app.js',
                'resources/js/googleMaps/maps.js',
            ],
            refresh: true,
        }),
    ],
});
