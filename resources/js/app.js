import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Quasar, QBtn, Notify } from 'quasar';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => ( title ),
    resolve: (name) => resolvePageComponent(`./Pages/${name}`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(Quasar, {
            components: { QBtn }, // Use QBtn como componente
            plugins: [Notify], // Adicione Notify como plugin
        });
        return app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
