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
    outDir: 'public/build',
    assetsDir: 'assets',
    rollupOptions: {
        output: {
            assetFileNames: '[name].[hash].[ext]'
        }
    },
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
          return '[name]-[hash][extname]'
        }
      }
    }
  }
});
