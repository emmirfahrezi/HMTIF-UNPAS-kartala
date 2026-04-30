import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/pages/activities.js',
                'resources/js/dashboard/main.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
