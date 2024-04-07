// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import { quasar } from '@quasar/vite-plugin'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        quasar({
            sassVariables: 'resources/css/quasar-variables.sass'
        })
    ],
});
