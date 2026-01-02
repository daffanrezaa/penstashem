<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header class="border-b border-gray-200 dark:border-white/10 pb-4 mb-6">
            <h2 class="font-serif text-2xl font-black text-black dark:text-white uppercase">
                Update Password
            </h2>

            <p class="mt-1 font-mono text-xs text-gray-500 dark:text-gray-400 uppercase tracking-tight">
                Change your password to keep your account secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="space-y-6">
            <div>
                <InputLabel for="current_password" value="Current Password" class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white font-mono bg-white dark:bg-[#0D0D0D] dark:text-white"
                    autocomplete="current-password"
                />

                <InputError
                    :message="form.errors.current_password"
                    class="mt-2 font-mono text-[10px]"
                />
            </div>

            <div>
                <InputLabel for="password" value="New Password" class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white font-mono bg-white dark:bg-[#0D0D0D] dark:text-white"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2 font-mono text-[10px]" />
            </div>

            <div>
                <InputLabel
                    for="password_confirmation"
                    value="Confirm New Password"
                    class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white font-mono bg-white dark:bg-[#0D0D0D] dark:text-white"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2 font-mono text-[10px]"
                />
            </div>

            <div class="flex items-center gap-4 pt-4">
                <PrimaryButton :disabled="form.processing" class="px-8 py-3 dark:bg-white dark:text-black dark:border-white">Update Password</PrimaryButton>

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
                        Success: Password changed.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>