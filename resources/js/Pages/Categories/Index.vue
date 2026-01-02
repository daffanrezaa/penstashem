<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import FloatingDollar from '@/Components/FloatingDollar.vue';
import { ref } from 'vue';

const props = defineProps({
    categories: Array,
});

const form = useForm({
    name: '',
    type: 'expense',
});

const editingCategory = ref(null);
const showingEditModal = ref(false);
const editForm = useForm({
    name: '',
    type: '',
});

const submit = () => {
    form.post(route('categories.store'), {
        onSuccess: () => form.reset(),
    });
};

const startEdit = (category) => {
    editingCategory.value = category;
    editForm.name = category.name;
    editForm.type = category.type;
    showingEditModal.value = true;
};

const closeEditModal = () => {
    showingEditModal.value = false;
    editingCategory.value = null;
    editForm.reset();
};

const updateCategory = () => {
    editForm.put(route('categories.update', editingCategory.value.id), {
        onSuccess: () => closeEditModal(),
    });
};

const confirmingCategoryDeletion = ref(false);
const categoryToDelete = ref(null);

const confirmCategoryDeletion = (id) => {
    categoryToDelete.value = id;
    confirmingCategoryDeletion.value = true;
};

const closeModal = () => {
    confirmingCategoryDeletion.value = false;
    categoryToDelete.value = null;
};

const deleteCategory = () => {
    useForm({}).delete(route('categories.destroy', categoryToDelete.value), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <!-- BACKGROUND DECORATIONS (Scattered Dollars) -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <FloatingDollar class="absolute top-[20%] left-[8%] w-28 h-24" :duration="4500" :rotateRange="8" :yOffset="15" :opacity="0.5" />
            <FloatingDollar class="absolute top-[65%] left-[12%] w-20 h-20" :duration="5500" :rotateRange="-12" :yOffset="25" :delay="200" :opacity="0.5" />
            <FloatingDollar class="absolute top-[10%] right-[10%] w-36 h-36" :duration="6500" :rotateRange="18" :yOffset="35" :delay="800" :opacity="0.5" />
            <FloatingDollar class="absolute top-[80%] right-[12%] w-32 h-32" :duration="5000" :rotateRange="-10" :yOffset="20" :delay="400" :opacity="0.5" />
        </div>
        
        <!-- HEADER -->
        <div 
            class="border-b-2 border-black dark:border-white/20 pb-4 mb-8 relative group transition-colors duration-500"
            v-motion
            :initial="{ opacity: 0, y: 50 }"
            :visibleOnce="{ opacity: 1, y: 0, transition: { type: 'spring', stiffness: 250, damping: 20 } }"
        >
            <h2 class="font-serif text-3xl font-bold text-black dark:text-white uppercase tracking-wide">
                Categories
            </h2>
            <p class="font-mono text-xs mt-1 text-gray-600 dark:text-gray-400">
                Organize your transactions into groups
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-20">
            
            <!-- FORM SECTION (Sidebar) -->
            <div 
                class="md:col-span-1 z-10"
                v-motion
                :initial="{ opacity: 0, x: -50 }"
                :visibleOnce="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: 200, damping: 20, delay: 100 } }"
            >
                <div class="bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 p-5 relative transition-colors duration-500 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)]">
                    <h3 class="font-serif font-bold text-xl border-b border-black dark:border-white/20 pb-2 mb-4 dark:text-white">
                        Add Category
                    </h3>
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <InputLabel for="name" value="Name" class="font-mono uppercase text-xs font-bold dark:text-gray-400" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full rounded-none border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white shadow-none bg-white dark:bg-[#0D0D0D] dark:text-white font-serif"
                                v-model="form.name"
                                placeholder="e.g. Food"
                                required
                            />
                            <InputError class="mt-2 font-mono text-xs" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel value="Type" class="font-mono uppercase text-xs font-bold dark:text-gray-400" />
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="radio" v-model="form.type" value="income" class="text-black dark:text-white focus:ring-black dark:focus:ring-white border-black dark:border-white/20 rounded-none bg-transparent" />
                                    <span class="font-sans text-sm group-hover:underline dark:text-gray-300">Income</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="radio" v-model="form.type" value="expense" class="text-black dark:text-white focus:ring-black dark:focus:ring-white border-black dark:border-white/20 rounded-none bg-transparent" />
                                    <span class="font-sans text-sm group-hover:underline dark:text-gray-300">Outcome</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button 
                                :disabled="form.processing"
                                class="w-full bg-black text-white dark:bg-white dark:text-black py-3 font-bold uppercase tracking-widest text-xs hover:bg-gray-800 dark:hover:opacity-80 transition disabled:opacity-50 border border-transparent"
                            >
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- LIST SECTION (Main Content) -->
            <div 
                class="md:col-span-2 z-10"
                v-motion
                :initial="{ opacity: 0, x: 50 }"
                :visibleOnce="{ opacity: 1, x: 0, transition: { type: 'spring', stiffness: 200, damping: 20, delay: 200 } }"
            >
                <div class="bg-white dark:bg-[#1A1A1A] border border-black dark:border-white/20 p-0 transition-colors duration-500 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.05)]">
                    <div class="border-b border-black dark:border-white/20 p-4 bg-gray-100 dark:bg-white/5 flex justify-between items-center">
                        <h3 class="font-serif font-bold text-lg dark:text-white">Your Categories</h3>
                        <span class="font-mono text-xs border border-black dark:border-white/20 px-2 py-0.5 bg-white dark:bg-[#0D0D0D] dark:text-white">
                            Total: {{ categories.length }}
                        </span>
                    </div>

                    <div v-if="categories.length === 0" class="p-8 text-center font-serif italic text-gray-500 dark:text-gray-400">
                        No categories found.
                    </div>

                    <ul v-else class="divide-y divide-black dark:divide-white/10" v-auto-animate>
                        <li v-for="category in categories" :key="category.id" class="p-4 hover:bg-yellow-50 dark:hover:bg-white/5 transition-colors">
                            <div class="flex items-center justify-between group">
                                <div class="flex items-baseline space-x-3 md:space-x-4">
                                    <span 
                                        class="font-mono text-[10px] md:text-xs font-bold uppercase tracking-wider w-16 md:w-24 shrink-0 text-gray-500 dark:text-gray-400"
                                    >
                                        {{ category.type === 'income' ? 'INCOME' : 'OUTCOME' }}
                                    </span>
                                    <span class="font-serif text-base md:text-lg text-black dark:text-white leading-tight">
                                        {{ category.name }}
                                    </span>
                                </div>
                                
                                <div class="flex space-x-1 shrink-0">
                                    <button 
                                        @click="startEdit(category)" 
                                        class="p-2 md:p-1.5 transition-all border border-black/10 dark:border-white/10 hover:border-black dark:hover:border-white text-black dark:text-white bg-white dark:bg-transparent"
                                        title="Edit Category"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </button>
                                    <button 
                                        @click="confirmCategoryDeletion(category.id)" 
                                        class="p-2 md:p-1.5 transition-all border border-black/10 dark:border-white/10 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black text-black dark:text-white bg-white dark:bg-transparent"
                                        title="Delete Category"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- EDIT MODAL -->
        <Modal :show="showingEditModal" @close="closeEditModal" maxWidth="sm">
            <div class="p-6 bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.1)] transition-colors duration-500">
                <h2 class="font-serif text-xl font-black text-black dark:text-white uppercase border-b border-black dark:border-white/20 pb-2 mb-6">
                    Edit Category
                </h2>
                
                <form @submit.prevent="updateCategory" class="space-y-5">
                    <div>
                        <InputLabel for="edit_name" value="Name" class="font-mono uppercase text-xs font-bold dark:text-gray-400" />
                        <TextInput
                            id="edit_name"
                            type="text"
                            class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white bg-white dark:bg-[#0D0D0D] dark:text-white font-serif"
                            v-model="editForm.name"
                            required
                        />
                        <InputError class="mt-2 font-mono text-xs" :message="editForm.errors.name" />
                    </div>

                    <div>
                        <InputLabel value="Type" class="font-mono uppercase text-xs font-bold dark:text-gray-400" />
                        <div class="mt-2 flex space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer p-2 border border-black/10 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5 flex-1 justify-center transition-colors">
                                <input type="radio" v-model="editForm.type" value="income" class="text-black dark:text-white focus:ring-black dark:focus:ring-white border-black dark:border-white/20 rounded-none bg-transparent" />
                                <span class="font-sans text-sm font-bold dark:text-white">Income</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer p-2 border border-black/10 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5 flex-1 justify-center transition-colors">
                                <input type="radio" v-model="editForm.type" value="expense" class="text-black dark:text-white focus:ring-black dark:focus:ring-white border-black dark:border-white/20 rounded-none bg-transparent" />
                                <span class="font-sans text-sm font-bold dark:text-white">Outcome</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-white/10">
                        <SecondaryButton @click="closeEditModal" class="px-4 py-2 text-[10px]">Cancel</SecondaryButton>
                        <PrimaryButton :disabled="editForm.processing" class="px-4 py-2 text-[10px]">Update</PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- DELETE MODAL -->
        <Modal :show="confirmingCategoryDeletion" @close="closeModal" maxWidth="sm">
            <div class="p-6 bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.1)] transition-colors duration-500">
                <h2 class="font-serif text-xl font-black text-black dark:text-white uppercase border-b border-black dark:border-white/20 pb-2 mb-4">
                    Delete Category
                </h2>

                <p class="font-serif text-base text-gray-800 dark:text-gray-300 italic">
                    "Are you sure you want to delete this category? This cannot be undone."
                </p>

                <div class="mt-6 flex justify-end gap-3">
                    <SecondaryButton @click="closeModal" class="px-4 py-2 text-[10px]">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3 px-4 py-2 !bg-red-600 !text-white hover:!bg-red-700 text-[10px]"
                        @click="deleteCategory"
                    >
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>