<script setup>
import { ref, onMounted, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showingNavigationDropdown = ref(false);

// DARK MODE LOGIC
const isDark = ref(localStorage.getItem('edition') === 'midnight');

const toggleEdition = () => {
    isDark.value = !isDark.value;
};

watch(isDark, (val) => {
    if (val) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('edition', 'midnight');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('edition', 'morning');
    }
}, { immediate: true });

onMounted(() => {
    router.on('finish', () => {
        // Smooth scroll to top on page change
        if (window.lenis) {
            window.lenis.scrollTo(0, { immediate: true });
        }
    });
});
</script>

<template>
    <div class="min-h-screen bg-paper-texture font-sans text-ink transition-colors duration-500">
        
        <!-- MODERN EDITORIAL HEADER -->
        <header class="bg-white/80 dark:bg-[#0D0D0D]/80 backdrop-blur-md border-b-2 border-black dark:border-white/20 sticky top-0 z-50 transition-colors duration-500">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    
                    <!-- LEFT: LOGO -->
                    <div class="flex shrink-0 items-center">
                        <Link :href="route('dashboard')">
                            <h1 class="font-serif text-2xl md:text-3xl font-black uppercase tracking-tighter text-black dark:text-white">
                                penStashem
                            </h1>
                        </Link>
                    </div>

                    <!-- RIGHT: NAVIGATION (Desktop) -->
                    <nav class="hidden sm:flex space-x-8 items-center">
                        <Link 
                            :href="route('dashboard')" 
                            class="text-xs font-bold uppercase tracking-widest transition-all duration-200"
                            :class="route().current('dashboard') ? 'text-black dark:text-white underline underline-offset-4 decoration-2' : 'text-gray-500 hover:text-black dark:hover:text-white'"
                        >
                            Dashboard
                        </Link>
                        
                        <Link 
                            :href="route('transactions.index')" 
                            class="text-xs font-bold uppercase tracking-widest transition-all duration-200"
                            :class="route().current('transactions.*') ? 'text-black dark:text-white underline underline-offset-4 decoration-2' : 'text-gray-500 hover:text-black dark:hover:text-white'"
                        >
                            Transactions
                        </Link>

                        <Link 
                            :href="route('categories.index')" 
                            class="text-xs font-bold uppercase tracking-widest transition-all duration-200"
                            :class="route().current('categories.*') ? 'text-black dark:text-white underline underline-offset-4 decoration-2' : 'text-gray-500 hover:text-black dark:hover:text-white'"
                        >
                            Categories
                        </Link>

                        <!-- EDITION SWITCH (Theme Toggle) -->
                        <div class="flex items-center space-x-2">
                            <button 
                                @click="toggleEdition"
                                class="relative inline-flex h-5 w-10 shrink-0 cursor-pointer border-2 border-black dark:border-white transition-colors duration-200 ease-in-out focus:outline-none bg-white dark:bg-black rounded-full"
                                title="Toggle Theme"
                            >
                                <span 
                                    class="pointer-events-none inline-block h-4 w-4 transform bg-black dark:bg-white shadow ring-0 transition duration-200 ease-in-out rounded-full"
                                    :class="isDark ? 'translate-x-5' : 'translate-x-0'"
                                ></span>
                            </button>
                        </div>

                        <!-- PROFILE DROPDOWN (Avatar) -->
                        <div class="ml-2">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-black dark:border-white bg-white dark:bg-[#1A1A1A] text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition duration-200 focus:outline-none">
                                        <span class="font-serif font-black text-sm uppercase leading-none">
                                            {{ $page.props.auth.user.name.charAt(0) }}
                                        </span>
                                    </button>
                                </template>

                                <template #content>
                                    <div class="bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 rounded-none shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)] p-1 overflow-hidden">
                                        <div class="px-4 py-3 border-b border-gray-100 dark:border-white/10 mb-1">
                                            <p class="font-mono text-[9px] uppercase text-gray-400 tracking-wider">Signed in as</p>
                                            <p class="font-serif text-sm font-bold truncate dark:text-white mt-0.5">{{ $page.props.auth.user.name }}</p>
                                        </div>
                                        <DropdownLink :href="route('profile.edit')" class="font-mono text-[10px] uppercase font-bold hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition dark:text-gray-300">
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink 
                                            :href="route('logout')" 
                                            method="post" 
                                            as="button" 
                                            class="w-full text-left font-mono text-[10px] uppercase font-bold text-red-600 hover:bg-red-600 hover:text-white transition"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                    </nav>

                    <!-- MOBILE MENU BUTTON -->
                    <div class="flex items-center sm:hidden">
                        <button
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="p-2 text-black dark:text-white transition duration-150 ease-in-out"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- MOBILE MENU (Dropdown) -->
            <div
                v-if="showingNavigationDropdown"
                class="sm:hidden border-b-4 border-black dark:border-white bg-white/95 dark:bg-[#0D0D0D]/95 backdrop-blur-md animate-paper transition-colors duration-500"
            >
                <div class="space-y-1 pb-3 pt-2 px-4">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('transactions.index')" :active="route().current('transactions.*')">
                        Transactions
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('categories.index')" :active="route().current('categories.*')">
                        Categories
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                        Profile
                    </ResponsiveNavLink>
                    
                    <!-- MOBILE THEME SWITCH (Styled like NavLink) -->
                    <div class="w-full ps-3 pe-4 py-3 border-l-8 border-transparent flex items-center justify-between text-start text-sm font-bold uppercase tracking-widest text-gray-500 hover:text-black hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out">
                        <span>Edition</span>
                        <button 
                            @click="toggleEdition"
                            class="relative inline-flex h-6 w-12 shrink-0 cursor-pointer border-2 border-black dark:border-white transition-colors duration-200 ease-in-out focus:outline-none bg-white dark:bg-black rounded-full"
                        >
                            <span 
                                class="pointer-events-none inline-block h-5 w-5 transform bg-black dark:bg-white shadow ring-0 transition duration-200 ease-in-out rounded-full"
                                :class="isDark ? 'translate-x-6' : 'translate-x-0'"
                            ></span>
                        </button>
                    </div>
                </div>
                <div class="border-t border-black/10 dark:border-white/10 pb-6 pt-4">
                    <div class="px-4 flex flex-col items-center space-y-3">
                        <div class="text-center">
                            <span class="font-mono text-[9px] text-gray-400 uppercase tracking-tight">Signed in as</span>
                            <div class="font-serif text-base font-bold text-black dark:text-white leading-none mt-0.5">{{ $page.props.auth.user.name }}</div>
                        </div>
                        
                        <Link 
                            :href="route('logout')" 
                            method="post" 
                            as="button" 
                            class="w-full text-center border border-black dark:border-white py-2 font-bold uppercase text-[10px] tracking-widest hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black dark:text-white transition"
                        >
                            Log Out
                        </Link>
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <slot />
        </main>

        <!-- FOOTER -->
        <footer class="border-t border-black dark:border-white/10 mt-12 py-8 text-center text-xs uppercase tracking-widest opacity-60 text-black dark:text-white transition-colors duration-500">
            &copy; {{ new Date().getFullYear() }} penStashem — Keep track of your money.
        </footer>
    </div>
</template>