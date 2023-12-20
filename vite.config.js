import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/googleMaps/maps.js',
                'resources/js/main.js',
                'resources/js/products/productsIntoBasket.js',
                'resources/js/admin/app.js',
                'resources/js/admin/manufacturers/app.js',
                'resources/js/admin/categories/app.js',
                'resources/js/admin/products/app.js'
            ],
            refresh: true,
        }),
    ],
});
