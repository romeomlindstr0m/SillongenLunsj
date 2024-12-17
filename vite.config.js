import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/authentication-failure.js', 'resources/js/item-input.js', 'resources/js/navbar.js', 'resources/js/select-menu.js'],
            refresh: true,
        }),
    ],
});
