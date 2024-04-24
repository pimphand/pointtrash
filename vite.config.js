import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/assets/libs/icofont/icofont.min.css',
                'resources/assets/libs/flatpickr/flatpickr.min.css',
                'resources/assets/css/tailwind.min.css',

                //js
                'resources/assets/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
