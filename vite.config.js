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

                //frontend css
                'resources/assets/frontend/css/bootstrap.css',
                'resources/assets/frontend/css/icofont.css',
                'resources/assets/frontend/css/jquery.fancybox.min.css',
                'resources/assets/frontend/css/animate.css',
                'resources/assets/frontend/css/nice-select.css',
                'resources/assets/frontend/css/color.css',
                'resources/assets/frontend/css/base.css',
                'resources/assets/frontend/css/style.css',
                'resources/assets/frontend/css/style-2.css',
                'resources/assets/frontend/css/responsive.css',
                'resources/assets/frontend/css/fontawesome-all.css',

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

                //frontend js
                'resources/assets/frontend/js/jquery.js',
                'resources/assets/frontend/js/popper.min.js',
                'resources/assets/frontend/js/owl.js',
                'resources/assets/frontend/js/bootstrap.min.js',
                'resources/assets/frontend/js/jquery.nice-select.min.js',
                'resources/assets/frontend/js/wow.js',
                'resources/assets/frontend/js/appear.js',
                'resources/assets/frontend/js/jquery.fancybox.js',
                'resources/assets/frontend/js/parallax.min.js',
                'resources/assets/frontend/js/script.js',
            ],
            refresh: true,
        }),
    ],
});
