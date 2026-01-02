<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section>
        <header class="border-b border-gray-200 dark:border-white/10 pb-4 mb-6">
            <h2 class="font-serif text-2xl font-black text-black dark:text-white uppercase">
                Delete Account
            </h2>

            <p class="mt-1 font-mono text-xs text-gray-500 dark:text-gray-400 uppercase tracking-tight">
                Warning: This process is irreversible. All records will be gone.
            </p>
        </header>

        <div class="mb-6"></div>

        <DangerButton @click="confirmUserDeletion" class="px-8 py-3 !bg-black !text-white hover:!bg-gray-800">
            Delete My Account
        </DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal" maxWidth="md">
            <div class="p-6 bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="font-serif text-xl font-black text-black uppercase border-b border-black pb-2 mb-4">
                    Delete Account
                </h2>

                <p class="font-serif text-base text-gray-800 italic">
                    "Are you sure? This will delete all your information. Please enter your password to confirm."
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="font-mono text-[9px] font-bold uppercase tracking-widest text-gray-400"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full rounded-none border-2 border-black focus:ring-0 focus:border-black font-mono h-9 text-sm"
                        placeholder="••••••••"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2 font-mono text-[9px]" />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <SecondaryButton @click="closeModal" class="px-4 py-2 text-[10px]">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3 px-4 py-2 !bg-black !text-white hover:!bg-gray-800 text-[10px]"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>