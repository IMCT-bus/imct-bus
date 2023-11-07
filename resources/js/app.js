import './bootstrap';
import './bootstrap';
import '../css/app.scss';

// import 'vfonts/IBMPlexSans.css';
// import 'vfonts/FiraCode.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import InertiaLinks from './plugins/inertia-links';

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(InertiaLinks)
      .use(ZiggyVue, Ziggy)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});
