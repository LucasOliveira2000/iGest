import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Quasar, Notify } from 'quasar';
import Flowbite from 'floating-vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Usa a função `import.meta.glob` para importar componentes de forma assíncrona
const pages = import.meta.glob('./Pages/**/*.vue');

createInertiaApp({
    title: (title) => ( title ),
    resolve: (name) => {
        const page = pages[`./Pages/${name}`];
        return page ? page().then(module => module.default) : null;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(Quasar, {
            plugins: [Notify]
        });
        app.use(Flowbite);
        return app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
