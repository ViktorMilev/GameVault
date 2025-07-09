import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    viteStaticCopy({
      targets: [
        {
          src: 'resources/images/favicon/*',
          dest: 'images/favicon'
        },
        {
          src: 'resources/images/game_covers/*',
          dest: 'images/game_covers'
        },
        {
          src: 'resources/images/platform_icons/*',
          dest: 'images/platform_icons'
        }
      ]
    })
  ],
});