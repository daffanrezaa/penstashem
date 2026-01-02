<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FloatingDollar from '@/Components/FloatingDollar.vue';
import { ref, computed, watch, onMounted } from 'vue';

const props = defineProps({
    transactions: Object,
    categories: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');

let searchTimeout = null;
watch(search, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('transactions.index'), { search: value }, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onFinish: () => {
                if (window.lenis) {
                    window.lenis.scrollTo('#transaction-archives', { offset: -120 });
                }
            }
        });
    }, 750);
});

// CREATE FORM
const form = useForm({
    type: 'expense',
    category_id: '',
    amount: '',
    transaction_date: new Date().toISOString().substr(0, 10),
    note: '',
});

const selectType = (type) => {
    form.type = type;
    form.category_id = '';
};

const submit = () => {
    form.post(route('transactions.store'), {
        onSuccess: () => form.reset('amount', 'note'),
    });
};

// EDIT LOGIC
const editingTransaction = ref(null);
const showingEditModal = ref(false);
const editForm = useForm({
    category_id: '',
    amount: '',
    transaction_date: '',
    note: '',
    type: '', 
});

const openEditModal = (transaction) => {
    editingTransaction.value = transaction;
    editForm.category_id = transaction.category_id;
    editForm.amount = transaction.amount;
    editForm.transaction_date = transaction.transaction_date;
    editForm.note = transaction.note;
    editForm.type = transaction.type;
    showingEditModal.value = true;
};

const closeEditModal = () => {
    showingEditModal.value = false;
    editingTransaction.value = null;
    editForm.reset();
};

const updateTransaction = () => {
    editForm.put(route('transactions.update', editingTransaction.value.id), {
        onSuccess: () => closeEditModal(),
    });
};

// DELETE LOGIC
const confirmingTransactionDeletion = ref(false);
const transactionToDelete = ref(null);

const confirmTransactionDeletion = (id) => {
    transactionToDelete.value = id;
    confirmingTransactionDeletion.value = true;
};

const closeModal = () => {
    confirmingTransactionDeletion.value = false;
    transactionToDelete.value = null;
};

const deleteTransaction = () => {
    router.delete(route('transactions.destroy', transactionToDelete.value), {
        onSuccess: () => closeModal(),
    });
};

// HELPERS
const formatCurrency = (amount) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'decimal',
        minimumFractionDigits: 0
    }).format(amount);
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        day: '2-digit', month: 'short', year: '2-digit'
    }).toUpperCase();
};

const filteredCategories = computed(() => {
    return props.categories.filter(c => c.type === form.type);
});

const filteredEditCategories = computed(() => {
    return props.categories.filter(c => c.type === editForm.type);
});

// JUMP TO PAGE
const jumpToPage = (event) => {
    router.visit(event.target.value, {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => {
            if (window.lenis) {
                window.lenis.scrollTo('#transaction-archives', { offset: -120 });
            }
        }
    });
};

// THEME DETECTION
const isMidnight = ref(false);
onMounted(() => {
    isMidnight.value = document.documentElement.classList.contains('dark');
    const observer = new MutationObserver(() => {
        isMidnight.value = document.documentElement.classList.contains('dark');
    });
    observer.observe(document.documentElement, { attributes: true });
});
</script>

<template>
    <Head title="Transactions" />

    <AuthenticatedLayout>
        <!-- BACKGROUND DECORATIONS -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <FloatingDollar class="absolute top-[15%] left-[10%] w-24 h-24" :duration="4000" :rotateRange="10" :yOffset="20" :opacity="0.5" />
            <FloatingDollar class="absolute top-[70%] left-[5%] w-36 h-36" :duration="6000" :rotateRange="-15" :yOffset="30" :delay="300" :opacity="0.5" />
            <FloatingDollar class="absolute top-[30%] right-[15%] w-32 h-32" :duration="5000" :rotateRange="12" :yOffset="25" :delay="600" :opacity="0.5" />
            <FloatingDollar class="absolute top-[85%] right-[5%] w-40 h-40" :duration="7000" :rotateRange="-8" :yOffset="40" :delay="100" :opacity="0.5" />
        </div>
        
        <!-- WRAPPER FOR SCROLL -->
        <div class="relative z-10 pb-32 lg:pb-20">
            <!-- HEADER -->
            <div 
                class="border-b-2 border-black dark:border-white/20 pb-4 mb-8 flex flex-col md:flex-row justify-between items-start md:items-end transition-colors duration-500 gap-4"
                v-motion
                :initial="{ opacity: 0, y: 20 }"
                :enter="{ opacity: 1, y: 0, transition: { duration: 800, ease: 'easeOut' } }"
            >
                <div>
                    <h2 class="font-serif text-3xl font-bold text-black dark:text-white uppercase tracking-wide">
                        Transactions
                    </h2>
                    <p class="font-mono text-xs mt-1 text-gray-600 dark:text-gray-400">
                        A history of your money in and out
                    </p>
                </div>
                <div class="font-mono text-[10px] border-2 border-black dark:border-white/20 px-3 py-1 bg-white dark:bg-[#1A1A1A] dark:text-white uppercase font-black tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.05)]">
                    Page {{ transactions.current_page }} of {{ transactions.last_page }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-8 items-stretch pb-20">
                
                <!-- ADD FORM SIDEBAR -->
                <div 
                    class="md:col-span-1 flex flex-col"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.98 }"
                    :enter="{ opacity: 1, scale: 1, transition: { duration: 1000, ease: 'easeOut', delay: 100 } }"
                >
                    <div class="bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 p-6 transition-colors duration-500 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)] md:h-full md:sticky md:top-24 flex flex-col">
                        <h3 class="font-serif font-bold text-xl border-b-2 border-black dark:border-white/20 pb-2 mb-6 dark:text-white">
                            Add Entry
                        </h3>
                        <form @submit.prevent="submit" class="space-y-6 flex-grow flex flex-col justify-between">
                            <div class="space-y-6 flex-grow flex flex-col">
                                <div>
                                    <InputLabel value="Type" class="font-mono uppercase text-[10px] font-bold dark:text-gray-400" />
                                    <div class="grid grid-cols-1 gap-2 mt-1">
                                        <button 
                                            type="button" @click="selectType('income')"
                                            class="py-3 text-[10px] font-bold uppercase tracking-widest transition-colors border-2 border-black dark:border-white/20"
                                            :class="form.type === 'income' ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-white text-gray-500 dark:bg-[#1A1A1A] hover:bg-gray-100'"
                                        >Income (+)</button>
                                        <button 
                                            type="button" @click="selectType('expense')"
                                            class="py-3 text-[10px] font-bold uppercase tracking-widest transition-colors border-2 border-black dark:border-white/20"
                                            :class="form.type === 'expense' ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-white text-gray-500 dark:bg-[#1A1A1A] hover:bg-gray-100'"
                                        >Outcome (-)</button>
                                    </div>
                                </div>

                                <div>
                                    <InputLabel value="Date" class="font-mono uppercase text-[10px] font-bold dark:text-gray-400" />
                                    <TextInput type="date" class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 focus:ring-0 focus:border-black bg-white dark:bg-[#0D0D0D] dark:text-white font-mono text-sm h-11" v-model="form.transaction_date" required />
                                </div>

                                <div>
                                    <InputLabel value="Category" class="font-mono uppercase text-[10px] font-bold dark:text-gray-400" />
                                    <select v-model="form.category_id" class="mt-1 block w-full rounded-none border-black dark:border-white/20 focus:ring-0 focus:border-black bg-white dark:bg-[#0D0D0D] dark:text-white font-serif text-sm h-11" required>
                                        <option value="" disabled>-- Select Category --</option>
                                        <option v-for="cat in filteredCategories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                    </select>
                                </div>

                                <div>
                                    <InputLabel value="Amount" class="font-mono uppercase text-[10px] font-bold dark:text-gray-400" />
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center font-mono text-sm dark:text-gray-500 pointer-events-none">Rp</span>
                                        <TextInput type="number" class="block w-full pl-10 rounded-none border-black dark:border-white/20 focus:ring-0 focus:border-black bg-white dark:bg-[#0D0D0D] dark:text-white font-mono h-11" v-model="form.amount" required />
                                    </div>
                                </div>

                                <div class="flex-grow flex flex-col min-h-[150px]">
                                    <InputLabel value="Note" class="font-mono uppercase text-[10px] font-bold dark:text-gray-400" />
                                    <textarea 
                                        v-model="form.note"
                                        placeholder="Details..."
                                        class="mt-1 block w-full flex-grow rounded-none border-black dark:border-white/20 focus:ring-0 focus:border-black dark:focus:border-white bg-white dark:bg-[#0D0D0D] dark:text-white font-serif italic text-sm resize-none p-3"
                                    ></textarea>
                                </div>
                            </div>

                            <div class="pt-8">
                                <PrimaryButton :disabled="form.processing" class="w-full justify-center py-4 text-sm">Add Record</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- TABLE SECTION (Main Content) -->
                <div 
                    id="transaction-archives"
                    class="md:col-span-2 flex flex-col"
                    v-motion
                    :initial="{ opacity: 0 }"
                    :enter="{ opacity: 1, transition: { duration: 1000, ease: 'easeOut', delay: 300 } }"
                >
                    <!-- SEARCH BAR -->
                    <div class="mb-8">
                        <div class="relative w-full">
                            <input 
                                type="text" 
                                v-model="search"
                                placeholder="Search transactions..." 
                                class="w-full border-b-2 border-black dark:border-white/20 border-t-0 border-l-0 border-r-0 bg-transparent px-0 py-3 font-mono text-sm focus:border-black dark:focus:border-white focus:ring-0 dark:text-white"
                            />
                            <div class="absolute right-0 top-3 dark:text-white/50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="border-t-4 border-b-4 border-black dark:border-white min-h-[500px] flex-grow transition-colors duration-500 overflow-hidden">
                        <!-- DESKTOP TABLE VIEW (md and up) -->
                        <div class="hidden md:block overflow-x-auto h-full">
                            <table class="w-full text-left h-full">
                                <thead class="bg-black text-white dark:bg-white dark:text-black font-mono text-[10px] uppercase tracking-wider">
                                    <tr>
                                        <th class="px-3 py-2 font-normal border-r border-white dark:border-black">Date</th>
                                        <th class="px-3 py-2 font-normal border-r border-white dark:border-black">Category</th>
                                        <th class="px-3 py-2 font-normal border-r border-white dark:border-black text-right">Amount</th>
                                        <th class="px-4 py-2 font-normal w-24 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <TransitionGroup tag="tbody" name="list" appear class="divide-y divide-black dark:divide-white/10 font-serif text-sm">
                                    <tr v-for="transaction in transactions.data" :key="transaction.id" class="hover:bg-yellow-50 dark:hover:bg-white/5 transition-colors group">
                                        <td class="px-3 py-1.5 font-mono text-[10px] border-r border-gray-300 dark:border-white/10 dark:text-gray-300">{{ formatDate(transaction.transaction_date) }}</td>
                                        <td class="px-3 py-1.5 border-r border-gray-300 dark:border-white/10 dark:text-white">
                                            <div class="font-bold text-xs">{{ transaction.category.name }}</div>
                                            <div v-if="transaction.note" class="text-[9px] italic text-gray-500 dark:text-gray-400 font-mono mt-0.5 truncate max-w-[150px]">"{{ transaction.note }}"</div>
                                        </td>
                                        <td class="px-3 py-1.5 text-right font-mono text-xs border-r border-gray-300 dark:border-white/10">
                                            <span :class="transaction.type === 'income' ? 'text-black dark:text-white font-bold' : 'text-gray-500 dark:text-gray-400'">
                                                {{ transaction.type === 'income' ? '+' : '-' }} {{ formatCurrency(transaction.amount) }}
                                            </span>
                                        </td>
                                        <td class="px-2 py-1.5 text-center space-x-1">
                                            <button 
                                                @click="openEditModal(transaction)" 
                                                class="p-1.5 transition-all border border-black/10 dark:border-white/10 hover:border-black dark:hover:border-white text-black dark:text-white"
                                                title="Edit Record"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                            </button>
                                            <button 
                                                @click="confirmTransactionDeletion(transaction.id)" 
                                                class="p-1.5 transition-all border border-black/10 dark:border-white/10 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black text-black dark:text-white"
                                                title="Delete Record"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </td>
                                    </tr>
                                </TransitionGroup>
                            </table>
                        </div>

                        <!-- MOBILE CARD VIEW (Below md) -->
                        <div class="md:hidden divide-y divide-black dark:divide-white/10 bg-white dark:bg-[#1A1A1A]">
                            <div v-if="transactions.data.length === 0" class="px-4 py-8 text-center italic text-gray-500 dark:text-gray-400 font-serif">No records found.</div>
                            <div v-for="transaction in transactions.data" :key="transaction.id" class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="font-mono text-[10px] uppercase text-gray-400">{{ formatDate(transaction.transaction_date) }}</span>
                                    <div class="flex space-x-2">
                                        <button @click="openEditModal(transaction)" class="p-2 border border-black dark:border-white text-black dark:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg></button>
                                        <button @click="confirmTransactionDeletion(transaction.id)" class="p-2 border border-black dark:border-white text-black dark:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                                    </div>
                                </div>
                                <div class="flex justify-between items-end">
                                    <div>
                                        <div class="font-serif font-black text-lg dark:text-white uppercase tracking-tight">{{ transaction.category.name }}</div>
                                        <div v-if="transaction.note" class="text-[9px] italic text-gray-500 dark:text-gray-400 font-mono mt-1">"{{ transaction.note }}"</div>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-mono text-lg font-black" :class="transaction.type === 'income' ? 'text-black dark:text-white' : 'text-gray-500 dark:text-gray-400'">
                                            {{ transaction.type === 'income' ? '+' : '-' }} {{ formatCurrency(transaction.amount) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COMPACT PAGINATION (Dropdown Only) -->
                    <div v-if="transactions.last_page > 1" class="mt-12 flex justify-center pb-10">
                        <div class="flex items-center space-x-3 bg-white dark:bg-[#1A1A1A] px-4 py-2 border-2 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.05)] transition-colors">
                            <span class="font-mono text-[10px] font-bold uppercase text-gray-400">Page:</span>
                            <select 
                                :value="transactions.links.find(l => l.active)?.url"
                                @change="jumpToPage"
                                class="border-none bg-transparent font-mono text-sm font-black focus:ring-0 py-0 pl-3 pr-10 cursor-pointer hover:underline text-black dark:text-white"
                            >
                                <option 
                                    v-for="page in Array.from({ length: transactions.last_page }, (_, i) => i + 1)" 
                                    :key="page" 
                                    :value="transactions.links[page]?.url || `${route('transactions.index')}?page=${page}`"
                                    class="dark:bg-[#1A1A1A]"
                                >
                                    {{ page }} OF {{ transactions.last_page }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <Modal :show="showingEditModal" @close="closeEditModal" maxWidth="md">
            <div class="p-8 bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-colors duration-500">
                <h2 class="font-serif text-2xl font-black text-black dark:text-white uppercase border-b-2 border-black dark:border-white/20 pb-2 mb-6">
                    Modify Record
                </h2>
                <form @submit.prevent="updateTransaction" class="space-y-5">
                    <div>
                        <InputLabel value="Category" class="font-mono text-[10px] font-bold uppercase text-gray-400" />
                        <select v-model="editForm.category_id" class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 bg-white dark:bg-[#0D0D0D] dark:text-white font-serif text-sm focus:ring-0">
                            <option v-for="cat in filteredEditCategories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                    </div>
                    <div>
                        <InputLabel value="Amount" class="font-mono text-[10px] font-bold uppercase text-gray-400" />
                        <TextInput type="number" class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 bg-white dark:bg-[#0D0D0D] dark:text-white font-mono" v-model="editForm.amount" />
                    </div>
                    <div>
                        <InputLabel value="Date" class="font-mono text-[10px] font-bold uppercase text-gray-400" />
                        <TextInput type="date" class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 bg-white dark:bg-[#0D0D0D] dark:text-white font-mono" v-model="editForm.transaction_date" />
                    </div>
                    <div>
                        <InputLabel value="Note" class="font-mono text-[10px] font-bold uppercase text-gray-400" />
                        <TextInput type="text" class="mt-1 block w-full rounded-none border-2 border-black dark:border-white/20 bg-white dark:bg-[#0D0D0D] dark:text-white font-serif italic" v-model="editForm.note" />
                    </div>
                    <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-white/10">
                        <SecondaryButton @click="closeEditModal" class="px-6">Cancel</SecondaryButton>
                        <PrimaryButton :disabled="editForm.processing" class="px-6">Update Record</PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- DELETE MODAL -->
        <Modal :show="confirmingTransactionDeletion" @close="closeModal" maxWidth="md">
            <div class="p-8 bg-white dark:bg-[#1A1A1A] border-2 border-black dark:border-white/20 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-colors duration-500">
                <h2 class="font-serif text-xl font-black text-black dark:text-white uppercase border-b border-black dark:border-white/20 pb-2 mb-4">Confirm Deletion</h2>
                <p class="font-serif text-base text-gray-800 dark:text-gray-300 italic">"Are you sure you want to delete this record? This action is permanent."</p>
                <div class="mt-8 flex justify-end gap-3">
                    <SecondaryButton @click="closeModal" class="px-6">Abort</SecondaryButton>
                    <DangerButton class="px-6 !bg-red-600 !text-white" @click="deleteTransaction">Delete</DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
