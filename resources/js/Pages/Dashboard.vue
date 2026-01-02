<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler,
  ArcElement
} from 'chart.js';
import { Line, Doughnut } from 'vue-chartjs';
import { computed, ref, watch, onMounted } from 'vue';
import FloatingDollar from '@/Components/FloatingDollar.vue';

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  ArcElement,
  Title,
  Tooltip,
  Legend,
  Filler
);

const props = defineProps({
    stats: Object,
    chart: Object,
    breakdown: Object,
    filters: Object,
    auth: Object,
});

const selectedYear = ref(props.filters?.year || new Date().getFullYear());
const selectedMonth = ref(props.filters?.month || new Date().getMonth() + 1);

const months = [
    { value: 1, label: 'January' }, { value: 2, label: 'February' }, { value: 3, label: 'March' },
    { value: 4, label: 'April' }, { value: 5, label: 'May' }, { value: 6, label: 'June' },
    { value: 7, label: 'July' }, { value: 8, label: 'August' }, { value: 9, label: 'September' },
    { value: 10, label: 'October' }, { value: 11, label: 'November' }, { value: 12, label: 'December' }
];

const years = Array.from({ length: 5 }, (_, i) => new Date().getFullYear() - i);

watch([selectedYear, selectedMonth], () => {
    router.get(route('dashboard'), {
        year: selectedYear.value,
        month: selectedMonth.value
    }, {
        preserveState: true,
        preserveScroll: true,
        only: ['stats', 'chart', 'breakdown', 'filters']
    });
});

const formatCurrency = (amount) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
};

// THEME DETECTION FOR CHARTS
const isMidnight = ref(false);

const themeColors = computed(() => ({
    income: isMidnight.value ? '#FFFFFF' : '#000000',
    outcome: isMidnight.value ? '#999999' : '#666666',
    grid: isMidnight.value ? 'rgba(255, 255, 255, 0.1)' : '#E5E5E5',
    text: isMidnight.value ? '#E5E5E5' : '#000000',
    mono: isMidnight.value 
        ? ['#FFFFFF', '#E5E5E5', '#CCCCCC', '#999999', '#666666', '#333333']
        : ['#000000', '#333333', '#666666', '#999999', '#CCCCCC', '#E5E5E5']
}));

// 1. LINE CHART (Trend)
const chartData = computed(() => ({
    labels: props.chart.labels,
    datasets: [
        {
            label: 'Income',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: themeColors.value.income,
            borderWidth: 2,
            data: props.chart.income,
            tension: 0.1,
            pointRadius: 0,
            pointHoverRadius: 4,
        },
        {
            label: 'Outcome',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: themeColors.value.outcome,
            borderWidth: 2,
            data: props.chart.expense,
            tension: 0.1,
            pointRadius: 0,
            pointHoverRadius: 4,
        }
    ]
}));

const chartOptions = computed(() => ({
    responsive: true,
    maintainAspectRatio: false,
    interaction: { intersect: false, mode: 'index' },
    plugins: {
        legend: { 
            position: 'bottom', 
            labels: { 
                font: { family: 'Courier New' }, 
                boxWidth: 10,
                color: themeColors.value.text 
            } 
        },
        tooltip: { 
            backgroundColor: isMidnight.value ? '#333333' : '#000000', 
            titleFont: { family: 'Courier New' }, 
            bodyFont: { family: 'Courier New' }, 
            padding: 10, 
            cornerRadius: 0, 
            displayColors: false 
        }
    },
    scales: {
        x: { 
            type: 'category', 
            grid: { display: false }, 
            ticks: { font: { family: 'Courier New' }, color: themeColors.value.text } 
        },
        y: { 
            beginAtZero: true, 
            grid: { color: themeColors.value.grid }, 
            ticks: { 
                font: { family: 'Courier New' }, 
                color: themeColors.value.text,
                callback: (value) => value.toLocaleString('id-ID') 
            } 
        }
    }
}));

const incomeBreakdownData = computed(() => ({
    labels: props.breakdown.income.labels,
    datasets: [{
        data: props.breakdown.income.data,
        backgroundColor: themeColors.value.mono,
        borderColor: isMidnight.value ? 'rgba(255,255,255,0.1)' : '#000000',
        borderWidth: 1,
    }]
}));

const outcomeBreakdownData = computed(() => ({
    labels: props.breakdown.expense.labels,
    datasets: [{
        data: props.breakdown.expense.data,
        backgroundColor: themeColors.value.mono,
        borderColor: isMidnight.value ? 'rgba(255,255,255,0.1)' : '#000000',
        borderWidth: 1,
    }]
}));

const doughnutOptions = computed(() => ({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false },
        tooltip: { 
            backgroundColor: isMidnight.value ? '#333333' : '#000000', 
            bodyFont: { family: 'Courier New' }, 
            cornerRadius: 0 
        }
    }
}));

const cashFlowLabel = computed(() => props.stats.cash_flow >= 0 ? 'SURPLUS' : 'DEFICIT');

const balanceFontSizeClass = computed(() => {
    const len = formatCurrency(props.stats.balance).length;
    if (len > 15) return 'text-4xl md:text-6xl';
    if (len > 12) return 'text-5xl md:text-7xl';
    if (len > 10) return 'text-6xl md:text-8xl';
    return 'text-7xl md:text-9xl';
});

// GREETING LOGIC
const quotes = [
    "A budget is telling your money where to go instead of wondering where it went.",
    "Do not save what is left after spending, but spend what is left after saving.",
    "The goal is not more money. The goal is living life on your terms.",
    "Financial freedom is available to those who learn about it and work for it.",
    "Beware of little expenses; a small leak will sink a great ship.",
    "An investment in knowledge pays the best interest.",
    "Wealth consists not in having great possessions, but in having few wants."
];

const currentDay = new Date().getDay();
const dailyQuote = quotes[currentDay];
const fullGreeting = computed(() => `Hello, ${props.auth?.user?.name || 'User'}! ${dailyQuote}`);

onMounted(() => {
    isMidnight.value = document.documentElement.classList.contains('dark');
    const observer = new MutationObserver(() => {
        isMidnight.value = document.documentElement.classList.contains('dark');
    });
    observer.observe(document.documentElement, { attributes: true });
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="The Daily Ledger" />
        
        <!-- BACKGROUND DECORATIONS -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <FloatingDollar class="absolute top-[10%] left-[5%] w-32 h-32" :duration="5000" :rotateRange="15" :yOffset="30" :opacity="0.5" />
            <FloatingDollar class="absolute top-[60%] left-[2%] w-48 h-48" :duration="7000" :rotateRange="-10" :yOffset="40" :delay="500" :opacity="0.5" />
            <FloatingDollar class="absolute top-[20%] right-[5%] w-40 h-40" :duration="6000" :rotateRange="20" :yOffset="25" :delay="1000" :opacity="0.5" />
            <FloatingDollar class="absolute top-[80%] right-[10%] w-36 h-36" :duration="5500" :rotateRange="-15" :yOffset="35" :delay="200" :opacity="0.5" />
            <FloatingDollar class="absolute top-[40%] right-[20%] w-24 h-24" :duration="4500" :rotateRange="10" :yOffset="20" :delay="800" :opacity="0.5" />
        </div>

        <!-- COVER PAGE (MINIMALIST HERO) -->
        <div class="min-h-[calc(100vh-120px)] flex flex-col items-center justify-between py-12 relative z-10">
            
            <!-- Masthead Top -->
            <div class="w-full flex justify-between items-center border-b border-black dark:border-white/20 pb-2 px-1">
                <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400">Vol. I — No. 001</span>
                <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400">Edition: 2025</span>
            </div>

            <!-- Main Branding -->
            <div class="text-center flex flex-col items-center w-full">
                <h2 
                    class="font-serif text-6xl md:text-8xl font-black text-black dark:text-white leading-none tracking-tighter uppercase mb-2"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.95 }"
                    :enter="{ opacity: 1, scale: 1, transition: { duration: 2000, ease: 'easeOutQuart', delay: 800 } }"
                >
                    The Daily Ledger
                </h2>
                
                <p 
                    class="font-mono text-base md:text-xl text-gray-500 dark:text-gray-400 uppercase tracking-[0.3em]"
                    v-motion
                    :initial="{ opacity: 0 }"
                    :enter="{ opacity: 1, transition: { duration: 2000, ease: 'easeOut', delay: 1200 } }"
                >
                    Your Personal Money Tracker
                </p>

                <div class="max-w-none w-full border-y border-black/10 dark:border-white/10 py-10 mt-12 overflow-hidden">
                    <p 
                        class="font-serif text-lg md:text-2xl italic text-black dark:text-white leading-relaxed text-center px-4"
                        v-motion
                        :initial="{ opacity: 0, filter: 'blur(10px)', letterSpacing: '0.2em' }"
                        :enter="{ opacity: 1, filter: 'blur(0px)', letterSpacing: '0em', transition: { duration: 2000, ease: 'easeOut', delay: 800 } }"
                    >
                        "{{ fullGreeting }}"
                    </p>
                </div>
            </div>

            <!-- Footer Controls -->
            <div 
                class="w-full flex flex-col items-center gap-12 mt-12"
                v-motion
                :initial="{ opacity: 0, y: 20 }"
                :enter="{ opacity: 1, y: 0, transition: { duration: 1500, ease: 'easeOut', delay: 1400 } }"
            >
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 bg-white dark:bg-[#1A1A1A] p-4 px-8 border-2 border-black dark:border-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,0.1)] transition-colors duration-500">
                    <span class="font-mono text-xs font-bold uppercase text-gray-400">Select Edition:</span>
                    <div class="flex items-center space-x-4">
                        <select v-model="selectedMonth" class="border-none bg-transparent font-mono text-base font-black focus:ring-0 py-0 px-2 pr-8 cursor-pointer hover:underline uppercase text-black dark:text-white transition-colors text-right">
                            <option v-for="m in months" :key="m.value" :value="m.value" class="dark:bg-[#1A1A1A]">{{ m.label }}</option>
                        </select>
                        <span class="font-mono text-base font-black text-black dark:text-white">/</span>
                        <select v-model="selectedYear" class="border-none bg-transparent font-mono text-base font-black focus:ring-0 py-0 px-2 pr-8 cursor-pointer hover:underline text-black dark:text-white transition-colors">
                            <option v-for="y in years" :key="y" :value="y" class="dark:bg-[#1A1A1A]">{{ y }}</option>
                        </select>
                    </div>
                </div>

                <div class="animate-bounce opacity-40 flex items-center space-x-4 text-black dark:text-white transition-colors">
                    <svg v-for="i in 3" :key="i" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- MAIN REPORT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 pt-20">
            
            <!-- ROW 1: KEY POSITION -->
            <div class="lg:col-span-7">
                <div 
                    class="border-y-4 border-black dark:border-white bg-white dark:bg-[#1A1A1A] p-10 text-center relative overflow-hidden h-full flex flex-col justify-center items-center group z-10 transition-colors duration-500"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart' } }"
                >
                    <h3 class="font-mono text-xs font-black uppercase tracking-widest bg-black dark:bg-white text-white dark:text-black px-6 py-2 mb-6">
                        Current Balance
                    </h3>
                    
                    <div class="relative">
                        <span 
                            class="font-sans font-black text-black dark:text-white tracking-tighter leading-none block transition-all duration-300"
                            :class="balanceFontSizeClass"
                        >
                            {{ formatCurrency(stats.balance) }}
                        </span>
                    </div>

                    <p class="mt-8 font-serif text-xl italic leading-relaxed text-gray-800 dark:text-gray-300 max-w-xl mx-auto border-t-2 border-black dark:border-white/20 pt-6 border-dashed w-full">
                        "The total liquid assets available at your disposal as of today."
                    </p>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col justify-center">
                <div 
                    class="border-2 border-black dark:border-white/20 bg-white dark:bg-[#1A1A1A] p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)] h-full transition-colors duration-500"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart', delay: 200 } }"
                >
                    <h3 class="font-serif font-black text-2xl mb-6 border-b-4 border-black dark:border-white pb-2 dark:text-white uppercase">
                        Summary
                    </h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-white/10 pb-3">
                            <span class="font-mono text-xs uppercase tracking-widest text-gray-500 dark:text-gray-400">Income</span>
                            <span class="font-bold text-xl dark:text-white">{{ formatCurrency(stats.monthly_income) }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-white/10 pb-3">
                            <span class="font-mono text-xs uppercase tracking-widest text-gray-500 dark:text-gray-400">Outcome</span>
                            <span class="font-bold text-xl dark:text-white">{{ formatCurrency(stats.monthly_expense) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-mono text-sm uppercase font-black bg-black dark:bg-white text-white dark:text-black px-2 py-1">Net Flow</span>
                            <span class="font-black text-2xl font-mono dark:text-white">
                                {{ props.stats.cash_flow >= 0 ? '+' : '-' }} 
                                {{ formatCurrency(Math.abs(stats.cash_flow)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 2: FULL WIDTH CHART -->
            <div class="lg:col-span-12 my-12 lg:my-16">
                <div 
                    class="border border-black dark:border-white/20 bg-white dark:bg-[#1A1A1A] p-8 transition-colors duration-500"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart' } }"
                >
                    <div class="flex flex-col md:flex-row justify-between md:items-end mb-6 border-b border-black dark:border-white/20 pb-4 gap-4">
                        <h3 class="font-sans font-bold text-3xl dark:text-white uppercase tracking-tighter">
                            <span class="bg-black dark:bg-white text-white dark:text-black px-3 py-1 mr-3 text-sm uppercase tracking-widest align-middle">Chart</span>
                            Money Trend Analysis
                        </h3>
                        <p class="text-xs font-mono text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            Daily Income and Outcome movement
                        </p>
                    </div>
                    <div class="h-96 border border-gray-200 dark:border-white/10 p-4 relative">
                        <Line :data="chartData" :options="chartOptions" :key="`${selectedYear}-${selectedMonth}-${isMidnight}`" />
                    </div>
                </div>
            </div>

            <!-- ROW 3: THREE COLUMNS -->
            <div class="lg:col-span-4 flex flex-col mb-12">
                <div 
                    class="border-2 border-black dark:border-white/20 bg-white dark:bg-[#1A1A1A] p-8 h-full flex flex-col transition-colors duration-500"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart' } }"
                >
                    <h4 class="font-bold text-xs uppercase border-b-2 border-black dark:border-white pb-2 mb-6 tracking-widest dark:text-white">Income Sources</h4>
                    <div class="flex-grow relative min-h-[250px] flex items-center justify-center">
                        <div class="w-full h-full">
                            <Doughnut :data="incomeBreakdownData" :options="{ ...doughnutOptions, maintainAspectRatio: false }" />
                        </div>
                        <div v-if="breakdown.income.data.length === 0" class="absolute inset-0 flex items-center justify-center text-xs text-gray-400 italic">No data</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col mb-12">
                <div 
                    class="border-2 border-black dark:border-white/20 bg-white dark:bg-[#1A1A1A] p-8 h-full flex flex-col transition-colors duration-500"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart', delay: 150 } }"
                >
                    <h4 class="font-bold text-xs uppercase border-b-2 border-black dark:border-white pb-2 mb-6 tracking-widest dark:text-white">Outcome Split</h4>
                    <div class="flex-grow relative min-h-[250px] flex items-center justify-center">
                        <div class="w-full h-full">
                            <Doughnut :data="outcomeBreakdownData" :options="{ ...doughnutOptions, maintainAspectRatio: false }" />
                        </div>
                        <div v-if="breakdown.expense.data.length === 0" class="absolute inset-0 flex items-center justify-center text-xs text-gray-400 italic">No data</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col mb-12">
                <div 
                    class="border-2 border-black dark:border-white/20 bg-white dark:bg-[#1A1A1A] p-8 h-full flex flex-col justify-between transition-colors duration-500"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 700, ease: 'easeOutQuart', delay: 300 } }"
                >
                    <div>
                        <h4 class="font-bold text-xs uppercase tracking-[0.2em] mb-6 text-black dark:text-white border-b border-black dark:border-white pb-2">
                            Money Analysis
                        </h4>
                        <div class="mb-8">
                            <p class="font-serif text-3xl font-black italic mb-2 dark:text-white">"{{ cashFlowLabel }}"</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed font-serif">
                                You are currently in a 
                                <span class="font-bold text-black dark:text-white">{{ cashFlowLabel.toLowerCase() }}</span> state. 
                                Maintain vigilance.
                            </p>
                        </div>
                        <div v-if="stats.top_category" class="mb-6 bg-gray-50 dark:bg-white/5 p-4 border border-gray-200 dark:border-white/10">
                            <p class="font-bold text-[10px] uppercase mb-1 text-gray-500 dark:text-gray-400">Biggest Spending</p>
                            <p class="font-serif text-lg font-bold leading-tight dark:text-white">
                                {{ stats.top_category.name }}
                            </p>
                            <p class="font-mono text-sm mt-1 dark:text-gray-300">
                                {{ formatCurrency(stats.top_category.amount) }}
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 border-t-2 border-black dark:border-white border-dashed">
                        <p class="font-mono text-sm text-gray-500 dark:text-gray-400">
                            Daily Spend: <span class="text-black dark:text-white font-bold">{{ formatCurrency(stats.burn_rate) }}/day</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- ACTION SECTION -->
            <div class="lg:col-span-12 text-center mt-12 mb-20">
                <div 
                    v-motion
                    :initial="{ opacity: 0, y: 50 }"
                    :visibleOnce="{ opacity: 1, y: 0, transition: { duration: 600, ease: 'easeOutQuart' } }"
                >
                    <Link 
                        :href="route('transactions.index')" 
                        class="inline-block border-2 border-black dark:border-white bg-black dark:bg-white text-white dark:text-black px-12 py-5 font-black uppercase tracking-[0.2em] hover:bg-white dark:hover:bg-black hover:text-black dark:hover:text-white hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.1)] transition-all duration-200 text-sm"
                    >
                        + Add New Transaction
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>