<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header class="border-b border-gray-200 dark:border-white/10 pb-4 mb-6">
            <h2 class="font-serif text-2xl font-black text-black dark:text-white uppercase">
                Profile Info
            </h2>

            <p class="mt-1 font-mono text-xs text-gray-500 dark:text-gray-400 uppercase tracking-tight">
                Update your account's name and email address.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="space-y-6"
        >
            <div>
                <InputLabel for="name" value="Your Name" class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white font-serif bg-white dark:bg-[#0D0D0D] dark:text-white"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2 font-mono text-[10px]" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email Address" class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white font-mono text-sm bg-white dark:bg-[#0D0D0D] dark:text-white"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2 font-mono text-[10px]" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm font-serif italic text-gray-800 dark:text-gray-300">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline font-bold hover:text-black dark:hover:text-white transition"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-mono text-[10px] uppercase font-bold text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent.
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <PrimaryButton :disabled="form.processing" class="px-8 py-3 dark:bg-white dark:text-black dark:border-white">Save Changes</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="font-mono text-[10px] uppercase font-bold text-gray-500 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>