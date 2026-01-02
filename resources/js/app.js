import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { MotionPlugin } from '@vueuse/motion';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue';
import Lenis from 'lenis';

const appName = 'penStashem';

// Initialize Lenis Smooth Scroll
const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 1,
    smoothTouch: false,
    touchMultiplier: 2,
    infinite: false,
});

// Expose lenis to window for global access
window.lenis = lenis;

// RAF loop for Lenis
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

// --- LOGIKA SPINNER NAVIGASI ---
router.on('start', () => {
    // Tampilkan spinner kecil saat navigasi dimulai
    const spinner = document.getElementById('page-spinner');
    if (spinner) spinner.classList.add('spinner-visible');
});

router.on('finish', () => {
    // Sembunyikan spinner setelah selesai
    const spinner = document.getElementById('page-spinner');
    if (spinner) spinner.classList.remove('spinner-visible');
});

createInertiaApp({
    title: (title) => appName,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(MotionPlugin)
            .use(autoAnimatePlugin);

        try {
            // 1. Mount aplikasi
            app.mount(el);

            // 2. Logika Loading (Sukses)
            const preloader = document.getElementById('preloader');
            const progressBar = document.getElementById('preloader-bar');
            
            if (progressBar) progressBar.style.width = '100%';
            
            // Langsung hilangkan preloader segera setelah mount berhasil
            // Menggunakan timeout 10ms hanya untuk memastikan render cycle browser selesai
            setTimeout(() => {
                if (preloader) {
                    preloader.classList.add('preloader-hidden');
                    if (window.lenis) window.lenis.start();
                    // Hapus dari DOM setelah transisi CSS selesai (300ms di CSS)
                    setTimeout(() => preloader.remove(), 350);
                }
            }, 10);

        } catch (error) {
            console.error("Vue Mount Error:", error);
            // Emergency removal agar error terlihat
            const preloader = document.getElementById('preloader');
            if (preloader) preloader.remove();
            if (window.lenis) window.lenis.start();
        }

        return app;
    },
    // Matikan NProgress default karena kita pakai custom spinner
    progress: false,
});