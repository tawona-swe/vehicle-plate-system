import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  base: './',
  plugins: [
    laravel([
      'resources/sass/app.scss',
      'resources/js/app.js',
    ]),
  ],
});
