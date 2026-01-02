<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import FloatingDollar from '@/Components/FloatingDollar.vue';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-paper-texture pt-6 px-6 sm:px-0 sm:justify-center sm:pt-0 relative overflow-hidden"
    >
        <!-- BACKGROUND DECORATIONS (3 Dollars) -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <FloatingDollar class="absolute top-[10%] left-[10%] w-24 h-24" :duration="5000" :rotateRange="15" :yOffset="20" :opacity="0.4" />
            <FloatingDollar class="absolute top-[60%] right-[5%] w-32 h-32" :duration="7000" :rotateRange="-10" :yOffset="30" :delay="500" :opacity="0.3" />
            <FloatingDollar class="absolute bottom-[10%] left-[5%] w-40 h-40" :duration="6000" :rotateRange="20" :yOffset="25" :delay="1000" :opacity="0.2" />
        </div>

        <!-- MODERN EDITORIAL HEADER -->
        <header class="bg-white/80 backdrop-blur-md border-b-2 border-black fixed top-0 left-0 w-full z-50 transition-colors duration-500">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    <!-- LEFT: BACK -->
                    <div class="w-24">
                        <Link href="/" class="p-2 border border-black hover:bg-black hover:text-white transition-colors inline-block rounded-full" title="Back to Home">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </Link>
                    </div>

                    <!-- CENTER: LOGO -->
                    <div class="flex shrink-0 items-center">
                        <Link href="/">
                            <h1 class="font-serif text-2xl md:text-3xl font-black uppercase tracking-tighter text-black">
                                penStashem
                            </h1>
                        </Link>
                    </div>

                    <!-- RIGHT: SPACER -->
                    <div class="w-24"></div>
                </div>
            </div>
        </header>

        <div
            class="relative w-full overflow-hidden bg-white px-6 py-4 border-2 border-black sm:max-w-md sm:rounded-none mt-24 sm:mt-0 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] z-10"
        >
            <slot />
        </div>
    </div>
</template>
