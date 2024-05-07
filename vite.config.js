import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/assets/css/summernote.css',
                'resources/assets/libs/icofont/icofont.min.css',
                'resources/assets/libs/flatpickr/flatpickr.min.css',
                'resources/assets/css/tailwind.min.css',

                //js
                'resources/assets/js/app.js',
                'resources/assets/js/jquery.js',
                'resources/assets/js/summernote.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
