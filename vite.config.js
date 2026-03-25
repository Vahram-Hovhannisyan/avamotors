import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin/cars-index.css',
                'resources/css/admin/analogs.css',
                'resources/css/admin/categories.css',
                'resources/css/admin/orders.css',
                'resources/css/admin/products.css',
                'resources/css/admin/dashboard.css',
                'resources/css/admin/users.css',
                'resources/css/admin/pricing-tiers.css',
                'resources/js/admin/cars-index.js',
                'resources/js/admin/categories.js',
                'resources/js/catalog.js',
                'resources/css/auth.css',
                'resources/css/cart.css',
                'resources/css/catalog.css',
                'resources/css/welcome.css',
                'resources/css/orders.css',
                'resources/js/admin/products.js',
                'resources/js/admin/dashboard.js',
                'resources/js/cart.js',
                'resources/js/admin/pricing-tiers.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        cors: true,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
