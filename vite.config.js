import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',   // Styles Breeze (optionnel)
        'resources/js/app.js',     // JS
      ],
      refresh: true,
    }),
  ],
});
