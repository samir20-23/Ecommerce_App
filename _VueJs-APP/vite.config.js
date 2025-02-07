import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',  // This is the entry point for your Vue app
            ],
            refresh: true,  // Ensures automatic refresh on file changes
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,  // This is to ensure paths to assets are not altered
                    includeAbsolute: false,  // Avoid absolute paths in your templates
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',  // Resolves Vue to the right build
        },
    },
});
