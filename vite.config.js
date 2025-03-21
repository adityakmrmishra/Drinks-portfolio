import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': path.resolve(__dirname, 'node_modules/jquery'),
            'jQuery': path.resolve(__dirname, 'node_modules/jquery'),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
    css: {
        devSourcemap: true,
    },
});
