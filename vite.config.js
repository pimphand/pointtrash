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
                'resources/assets/libs/lucide/umd/lucide.min.js',
                'resources/assets/libs/simplebar/simplebar.min.js',
                'resources/assets/libs/flatpickr/flatpickr.min.js',
                'resources/assets/libs/@frostui/tailwindcss/frostui.js',
                'resources/assets/js/pages/editor.init.js',
                'resources/assets/js/pages/wizard.init.js',
            ],
            refresh: true,
        }),
    ],
});
