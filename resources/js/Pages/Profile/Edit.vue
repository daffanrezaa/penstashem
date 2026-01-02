<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import FloatingDollar from '@/Components/FloatingDollar.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Account Settings" />

    <AuthenticatedLayout>
        <!-- BACKGROUND DECORATIONS (Scattered Dollars) -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <FloatingDollar class="absolute top-[10%] left-[5%] w-32 h-32" :duration="5000" :rotateRange="15" :yOffset="30" :opacity="0.5" />
            <FloatingDollar class="absolute top-[60%] left-[2%] w-48 h-48" :duration="7000" :rotateRange="-10" :yOffset="40" :delay="500" :opacity="0.5" />
            <FloatingDollar class="absolute top-[20%] right-[5%] w-40 h-40" :duration="6000" :rotateRange="20" :yOffset="25" :delay="1000" :opacity="0.5" />
            <FloatingDollar class="absolute top-[80%] right-[10%] w-36 h-36" :duration="5500" :rotateRange="-15" :yOffset="35" :delay="200" :opacity="0.5" />
        </div>

        <!-- HEADLINE SECTION -->
        <div 
            class="border-b-4 border-black dark:border-white pb-4 mb-8 md:mb-12 flex flex-col md:flex-row justify-between items-start md:items-end transition-colors duration-500 relative z-10"
            v-motion
            :initial="{ opacity: 0, y: 20 }"
            :enter="{ opacity: 1, y: 0, transition: { duration: 800, ease: 'easeOut' } }"
        >
            <div>
                <h2 class="font-serif text-3xl md:text-5xl font-black text-black dark:text-white leading-none tracking-tighter">
                    SETTINGS
                </h2>
                <p class="font-mono text-xs mt-2 text-gray-500 dark:text-gray-400 uppercase tracking-widest pl-1">
                    Your account and security information
                </p>
            </div>
            
            <div class="mt-4 md:mt-0 font-mono text-[10px] uppercase font-bold border-2 border-black dark:border-white px-3 py-1 bg-white dark:bg-[#1A1A1A] dark:text-white transition-colors duration-500">
                Personal Account
            </div>
        </div>

        <div class="space-y-8 md:space-y-12 pb-20 relative z-10">
            <!-- Profile Info -->
            <div 
                class="bg-white dark:bg-[#1A1A1A] p-4 md:p-8 border-2 border-black dark:border-white/20 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.05)] dark:md:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)] transition-colors duration-500"
                v-motion
                :initial="{ opacity: 0, y: 50 }"
                :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart' } }"
            >
                <div class="max-w-2xl">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                </div>
            </div>

            <!-- Password Update -->
            <div 
                class="bg-white dark:bg-[#1A1A1A] p-4 md:p-8 border-2 border-black dark:border-white/20 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.05)] dark:md:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)] transition-colors duration-500"
                v-motion
                :initial="{ opacity: 0, y: 50 }"
                :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart', delay: 100 } }"
            >
                <div class="max-w-2xl">
                    <UpdatePasswordForm />
                </div>
            </div>

            <!-- Delete Account -->
            <div 
                class="bg-white dark:bg-[#1A1A1A] p-4 md:p-8 border-2 border-black dark:border-white/20 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.05)] dark:md:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)] transition-colors duration-500"
                v-motion
                :initial="{ opacity: 0, y: 50 }"
                :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart', delay: 200 } }"
            >
                <div class="max-w-2xl">
                    <DeleteUserForm />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
