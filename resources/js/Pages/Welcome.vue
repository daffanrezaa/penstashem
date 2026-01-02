<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FloatingDollar from '@/Components/FloatingDollar.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen bg-paper-texture text-black font-sans flex flex-col pt-16 relative overflow-hidden">
        
        <!-- BACKGROUND DECORATIONS (Pulsing Dollars) -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <FloatingDollar class="absolute top-[15%] left-[5%] w-32 h-32" :duration="6000" :rotateRange="20" :yOffset="0" :scaleRange="0.1" :opacity="0.4" />
            <FloatingDollar class="absolute top-[65%] left-[8%] w-48 h-48" :duration="8000" :rotateRange="-15" :yOffset="0" :scaleRange="0.15" :delay="500" :opacity="0.3" />
            <FloatingDollar class="absolute top-[20%] right-[10%] w-40 h-40" :duration="7500" :rotateRange="25" :yOffset="0" :scaleRange="0.1" :delay="1000" :opacity="0.4" />
            <FloatingDollar class="absolute top-[75%] right-[5%] w-36 h-36" :duration="6500" :rotateRange="-20" :yOffset="0" :scaleRange="0.12" :delay="200" :opacity="0.3" />
        </div>

        <!-- HEADER -->
        <header class="bg-white/80 backdrop-blur-md border-b-2 border-black fixed top-0 left-0 w-full z-50 transition-colors duration-500">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex h-16 justify-between items-center">
                <div class="font-serif text-xl md:text-3xl font-black uppercase tracking-tighter shrink-0">
                    penStashem
                </div>
                <nav v-if="canLogin" class="flex space-x-3 md:space-x-6 items-center">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="text-[10px] md:text-[11px] font-bold uppercase tracking-widest text-black hover:underline underline-offset-4"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-[10px] md:text-[11px] font-bold uppercase tracking-widest text-black hover:underline underline-offset-4"
                        >
                            Log In
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="text-[10px] md:text-[11px] font-bold uppercase tracking-widest border-2 border-black bg-black text-white px-3 md:px-4 py-1 hover:bg-white hover:text-black transition duration-200"
                        >
                            Sign Up
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <!-- MAIN HERO -->
        <main class="flex-grow flex items-center justify-center p-4 md:p-6 relative z-10">
            <div class="max-w-4xl w-full text-center space-y-6 md:space-y-8">
                
                <div 
                    class="border-t-2 border-b-2 border-black py-2 inline-block mb-4 md:mb-6"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.9 }"
                    :enter="{ opacity: 1, scale: 1, transition: { duration: 500, ease: 'easeOutBack', delay: 100 } }"
                >
                    <span class="font-mono text-[10px] md:text-xs uppercase tracking-[0.3em]">Established 2025</span>
                </div>

                <h1 
                    class="font-serif text-5xl md:text-7xl font-black leading-none uppercase tracking-tighter text-black"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.9 }"
                    :enter="{ opacity: 1, scale: 1, transition: { duration: 500, ease: 'easeOutBack', delay: 200 } }"
                >
                    Manage Your<br class="hidden sm:block"> Money
                </h1>

                <p 
                    class="font-serif text-lg md:text-2xl italic text-gray-700 max-w-2xl mx-auto leading-relaxed px-2"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.9 }"
                    :enter="{ opacity: 1, scale: 1, transition: { duration: 500, ease: 'easeOutBack', delay: 300 } }"
                >
                    "A simple way to track your income and outcome. Record every transaction, see your trends, and stay in control of your wealth."
                </p>

                <div 
                    class="pt-6 md:pt-8 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6 w-full max-w-xs mx-auto sm:max-w-none"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.9 }"
                    :enter="{ opacity: 1, scale: 1, transition: { duration: 500, ease: 'easeOutBack', delay: 400 } }"
                >
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="w-full sm:w-auto bg-white text-black px-8 py-3 md:px-12 md:py-4 font-bold uppercase tracking-widest border-2 border-black hover:bg-black hover:text-white transition duration-300 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.1)]"
                    >
                        Sign Up
                    </Link>
                    <Link
                        :href="route('login')"
                        class="w-full sm:w-auto bg-white text-black px-8 py-3 md:px-12 md:py-4 font-bold uppercase tracking-widest border-2 border-black hover:bg-black hover:text-white transition duration-300 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.1)]"
                    >
                        Log In
                    </Link>
                </div>

            </div>
        </main>

        <!-- FOOTER -->
        <footer class="border-t border-black bg-white py-6">
            <div class="mx-auto max-w-7xl px-4 text-center">
                <p class="font-mono text-xs uppercase tracking-widest opacity-60">
                    &copy; 2025 penStashem — Simple Money Tracking.
                </p>
            </div>
        </footer>
    </div>
</template>