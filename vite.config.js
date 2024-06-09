import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.sass', 
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/css/main.scss',
                'resources/plugins/swiper/swiper-bundle.css',
                'resources/plugins/swiper/swiper-bundle.js',
            ],
            refresh: true,
        }),
    ],
});