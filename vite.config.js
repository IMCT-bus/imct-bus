import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';
import { NaiveUiResolver } from 'unplugin-vue-components/resolvers';

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
    hmr: {
      host: '127.0.0.1',
      port: 5173,
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.scss', 'resources/js/app.js'],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
      script: {
        defineModel: true,
      },
    }),
    Components({
      resolvers: [NaiveUiResolver()],
    }),
  ],
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: '@import "resources/css/mixins.scss";',
      },
    },
  },
});
