import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // offline-pos.js is its own entry so jsPDF (~400 KB) ships only to
            // the offline till screen, not to every page of the app.
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/offline-pos.js'],
            refresh: true,
        }),
    ],
});
