import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const mountedApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);

        // Fade out CSS splash screen once app is mounted and ready
        setTimeout(() => {
            const splash = document.getElementById('css-splash');
            if (splash) {
                splash.classList.add('fade-out');
                setTimeout(() => splash.remove(), 300); // Remove from DOM after transition
            }
            
            // Hide native Android splash screen if we are in the mobile app
            if (window.AndroidBridge && window.AndroidBridge.hideSplash) {
                window.AndroidBridge.hideSplash();
            }
        }, 150);

        return mountedApp;
    },
    progress: {
        color: '#4B5563',
    },
});
