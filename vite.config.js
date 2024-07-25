// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'


export default defineConfig({
    base: '/',
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        })
    ],
    build: {
    rollupOptions: {
      output: {
        chunkFileNames: '[name]-[hash].js',
        entryFileNames: '[name]-[hash].js',

        assetFileNames: ({ name }) => {
          if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')) {
            return '[name]-[hash][extname]'
          }

          if (/\.css$/.test(name ?? '')) {
            return '[name]-[hash][extname]'
          }

          // default value
          // ref: https://rollupjs.org/guide/en/#outputassetfilenames
          return '[name]-[hash][extname]'
        }
      }
    }
  }
});
