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
    ArcElement,
} from 'chart.js';
import { Line, Doughnut } from 'vue-chartjs';
import { computed, ref, watch, onMounted } from 'vue';
import FloatingDollar from '@/Components/FloatingDollar.vue';
import { useLenis } from '@/Composables/useLenis';

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    ArcElement,
    Title,
    Tooltip,
    Legend,
    Filler,
);

const props = defineProps({
    stats: Object,
    chart: Object,
    breakdown: Object,
    filters: Object,
    auth: Object,
});

const { scrollTo } = useLenis();

// Smooth scroll to content
const scrollToContent = () => {
    const mainContent = document.querySelector('.main-report-grid');
    if (mainContent) {
        scrollTo(mainContent, { offset: -100, duration: 1.5 });
    }
};

const selectedYear = ref(props.filters?.year || new Date().getFullYear());
const selectedMonth = ref(props.filters?.month || new Date().getMonth() + 1);

const months = [
    { value: 1, label: 'January' },
    { value: 2, label: 'February' },
    { value: 3, label: 'March' },
    { value: 4, label: 'April' },
    { value: 5, label: 'May' },
    { value: 6, label: 'June' },
    { value: 7, label: 'July' },
    { value: 8, label: 'August' },
    { value: 9, label: 'September' },
    { value: 10, label: 'October' },
    { value: 11, label: 'November' },
    { value: 12, label: 'December' },
];

const years = Array.from({ length: 5 }, (_, i) => new Date().getFullYear() - i);

watch([selectedYear, selectedMonth], () => {
    router.get(
        route('dashboard'),
        {
            year: selectedYear.value,
            month: selectedMonth.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['stats', 'chart', 'breakdown', 'filters'],
        },
    );
});

const formatCurrency = (amount) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
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
        : ['#000000', '#333333', '#666666', '#999999', '#CCCCCC', '#E5E5E5'],
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
        },
    ],
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
                color: themeColors.value.text,
            },
        },
        tooltip: {
            backgroundColor: isMidnight.value ? '#333333' : '#000000',
            titleFont: { family: 'Courier New' },
            bodyFont: { family: 'Courier New' },
            padding: 10,
            cornerRadius: 0,
            displayColors: false,
        },
    },
    scales: {
        x: {
            type: 'category',
            grid: { display: false },
            ticks: {
                font: { family: 'Courier New' },
                color: themeColors.value.text,
            },
        },
        y: {
            beginAtZero: true,
            grid: { color: themeColors.value.grid },
            ticks: {
                font: { family: 'Courier New' },
                color: themeColors.value.text,
                callback: (value) => value.toLocaleString('id-ID'),
            },
        },
    },
}));

const incomeBreakdownData = computed(() => ({
    labels: props.breakdown.income.labels,
    datasets: [
        {
            data: props.breakdown.income.data,
            backgroundColor: themeColors.value.mono,
            borderColor: isMidnight.value ? 'rgba(255,255,255,0.1)' : '#000000',
            borderWidth: 1,
        },
    ],
}));

const outcomeBreakdownData = computed(() => ({
    labels: props.breakdown.expense.labels,
    datasets: [
        {
            data: props.breakdown.expense.data,
            backgroundColor: themeColors.value.mono,
            borderColor: isMidnight.value ? 'rgba(255,255,255,0.1)' : '#000000',
            borderWidth: 1,
        },
    ],
}));

const doughnutOptions = computed(() => ({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false },
        tooltip: {
            backgroundColor: isMidnight.value ? '#333333' : '#000000',
            bodyFont: { family: 'Courier New' },
            cornerRadius: 0,
        },
    },
}));

const cashFlowLabel = computed(() =>
    props.stats.cash_flow >= 0 ? 'SURPLUS' : 'DEFICIT',
);

const balanceFontSizeClass = computed(() => {
    const len = formatCurrency(props.stats.balance).length;
    if (len > 15) return 'text-4xl md:text-6xl';
    if (len > 12) return 'text-5xl md:text-7xl';
    if (len > 10) return 'text-6xl md:text-8xl';
    return 'text-7xl md:text-9xl';
});

// GREETING LOGIC
const quotes = [
    'A budget is telling your money where to go instead of wondering where it went.',
    'Do not save what is left after spending, but spend what is left after saving.',
    'The goal is not more money. The goal is living life on your terms.',
    'Financial freedom is available to those who learn about it and work for it.',
    'Beware of little expenses; a small leak will sink a great ship.',
    'An investment in knowledge pays the best interest.',
    'Wealth consists not in having great possessions, but in having few wants.',
];

const currentDay = new Date().getDay();
const dailyQuote = quotes[currentDay];
const fullGreeting = computed(
    () => `Hello, ${props.auth?.user?.name || 'User'}! ${dailyQuote}`,
);

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
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <FloatingDollar
                class="absolute left-[5%] top-[10%] h-32 w-32"
                :duration="5000"
                :rotateRange="15"
                :yOffset="30"
                :opacity="0.5"
            />
            <FloatingDollar
                class="absolute left-[2%] top-[60%] h-48 w-48"
                :duration="7000"
                :rotateRange="-10"
                :yOffset="40"
                :delay="500"
                :opacity="0.5"
            />
            <FloatingDollar
                class="absolute right-[5%] top-[20%] h-40 w-40"
                :duration="6000"
                :rotateRange="20"
                :yOffset="25"
                :delay="1000"
                :opacity="0.5"
            />
            <FloatingDollar
                class="absolute right-[10%] top-[80%] h-36 w-36"
                :duration="5500"
                :rotateRange="-15"
                :yOffset="35"
                :delay="200"
                :opacity="0.5"
            />
            <FloatingDollar
                class="absolute right-[20%] top-[40%] h-24 w-24"
                :duration="4500"
                :rotateRange="10"
                :yOffset="20"
                :delay="800"
                :opacity="0.5"
            />
        </div>

        <!-- COVER PAGE (MINIMALIST HERO) -->
        <div
            class="relative z-10 flex min-h-[calc(100vh-120px)] flex-col items-center justify-between py-12"
        >
            <!-- Masthead Top -->
            <div
                class="flex w-full items-center justify-between border-b border-black px-1 pb-2 dark:border-white/20"
            >
                <span
                    class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400"
                    >Vol. I — No. 001</span
                >
                <span
                    class="font-mono text-[10px] font-bold uppercase tracking-widest text-gray-400"
                    >Edition: 2025</span
                >
            </div>

            <!-- Main Branding -->
            <div class="flex w-full flex-col items-center text-center">
                <h2
                    class="mb-2 font-serif text-6xl font-black uppercase leading-none tracking-tighter text-black md:text-8xl dark:text-white"
                    v-motion
                    :initial="{ opacity: 0, scale: 0.95 }"
                    :enter="{
                        opacity: 1,
                        scale: 1,
                        transition: {
                            duration: 2000,
                            ease: 'easeOutQuart',
                            delay: 800,
                        },
                    }"
                >
                    The Daily Ledger
                </h2>

                <p
                    class="font-mono text-base uppercase tracking-[0.3em] text-gray-500 md:text-xl dark:text-gray-400"
                    v-motion
                    :initial="{ opacity: 0 }"
                    :enter="{
                        opacity: 1,
                        transition: {
                            duration: 2000,
                            ease: 'easeOut',
                            delay: 1200,
                        },
                    }"
                >
                    Your Personal Money Tracker
                </p>

                <div
                    class="mt-12 w-full max-w-none overflow-hidden border-y border-black/10 py-10 dark:border-white/10"
                >
                    <p
                        class="px-4 text-center font-serif text-lg italic leading-relaxed text-black md:text-2xl dark:text-white"
                        v-motion
                        :initial="{
                            opacity: 0,
                            filter: 'blur(10px)',
                            letterSpacing: '0.2em',
                        }"
                        :enter="{
                            opacity: 1,
                            filter: 'blur(0px)',
                            letterSpacing: '0em',
                            transition: {
                                duration: 2000,
                                ease: 'easeOut',
                                delay: 800,
                            },
                        }"
                    >
                        "{{ fullGreeting }}"
                    </p>
                </div>
            </div>

            <!-- Footer Controls -->
            <div
                class="mt-12 flex w-full flex-col items-center gap-12"
                v-motion
                :initial="{ opacity: 0, y: 20 }"
                :enter="{
                    opacity: 1,
                    y: 0,
                    transition: {
                        duration: 1500,
                        ease: 'easeOut',
                        delay: 1400,
                    },
                }"
            >
                <div
                    class="flex flex-col items-center space-y-4 border-2 border-black bg-white p-4 px-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-colors duration-500 sm:flex-row sm:space-x-6 sm:space-y-0 dark:border-white dark:bg-[#1A1A1A] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,0.1)]"
                >
                    <span
                        class="font-mono text-xs font-bold uppercase text-gray-400"
                        >Select Edition:</span
                    >
                    <div class="flex items-center space-x-4">
                        <select
                            v-model="selectedMonth"
                            class="cursor-pointer border-none bg-transparent px-2 py-0 pr-8 text-right font-mono text-base font-black uppercase text-black transition-colors hover:underline focus:ring-0 dark:text-white"
                        >
                            <option
                                v-for="m in months"
                                :key="m.value"
                                :value="m.value"
                                class="dark:bg-[#1A1A1A]"
                            >
                                {{ m.label }}
                            </option>
                        </select>
                        <span
                            class="font-mono text-base font-black text-black dark:text-white"
                            >/</span
                        >
                        <select
                            v-model="selectedYear"
                            class="cursor-pointer border-none bg-transparent px-2 py-0 pr-8 font-mono text-base font-black text-black transition-colors hover:underline focus:ring-0 dark:text-white"
                        >
                            <option
                                v-for="y in years"
                                :key="y"
                                :value="y"
                                class="dark:bg-[#1A1A1A]"
                            >
                                {{ y }}
                            </option>
                        </select>
                    </div>
                </div>

                <div
                    @click="scrollToContent"
                    class="flex animate-bounce cursor-pointer items-center space-x-4 text-black opacity-40 transition-all hover:opacity-70 dark:text-white"
                >
                    <svg
                        v-for="i in 3"
                        :key="i"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="4"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m19.5 8.25-7.5 7.5-7.5-7.5"
                        />
                    </svg>
                </div>
            </div>
        </div>

        <!-- MAIN REPORT GRID -->
        <div
            class="main-report-grid grid grid-cols-1 gap-12 pt-20 lg:grid-cols-12 lg:gap-16"
        >
            <!-- ROW 1: KEY POSITION -->
            <div class="lg:col-span-7">
                <div
                    class="group relative z-10 flex h-full flex-col items-center justify-center overflow-hidden border-y-4 border-black bg-white p-10 text-center transition-colors duration-500 dark:border-white dark:bg-[#1A1A1A]"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{
                        opacity: 1,
                        y: 0,
                        transition: { duration: 700, ease: 'easeOutQuart' },
                    }"
                >
                    <h3
                        class="mb-6 bg-black px-6 py-2 font-mono text-xs font-black uppercase tracking-widest text-white dark:bg-white dark:text-black"
                    >
                        Current Balance
                    </h3>

                    <div class="relative">
                        <span
                            class="block font-sans font-black leading-none tracking-tighter text-black transition-all duration-300 dark:text-white"
                            :class="balanceFontSizeClass"
                        >
                            {{ formatCurrency(stats.balance) }}
                        </span>
                    </div>

                    <p
                        class="mx-auto mt-8 w-full max-w-xl border-t-2 border-dashed border-black pt-6 font-serif text-xl italic leading-relaxed text-gray-800 dark:border-white/20 dark:text-gray-300"
                    >
                        "The total liquid assets available at your disposal as
                        of today."
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-center lg:col-span-5">
                <div
                    class="h-full border-2 border-black bg-white p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-colors duration-500 dark:border-white/20 dark:bg-[#1A1A1A] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.05)]"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{
                        opacity: 1,
                        y: 0,
                        transition: {
                            duration: 700,
                            ease: 'easeOutQuart',
                            delay: 200,
                        },
                    }"
                >
                    <h3
                        class="mb-6 border-b-4 border-black pb-2 font-serif text-2xl font-black uppercase dark:border-white dark:text-white"
                    >
                        Summary
                    </h3>
                    <div class="space-y-6">
                        <div
                            class="flex items-center justify-between border-b border-gray-200 pb-3 dark:border-white/10"
                        >
                            <span
                                class="font-mono text-xs uppercase tracking-widest text-gray-500 dark:text-gray-400"
                                >Income</span
                            >
                            <span class="text-xl font-bold dark:text-white">{{
                                formatCurrency(stats.monthly_income)
                            }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between border-b border-gray-200 pb-3 dark:border-white/10"
                        >
                            <span
                                class="font-mono text-xs uppercase tracking-widest text-gray-500 dark:text-gray-400"
                                >Outcome</span
                            >
                            <span class="text-xl font-bold dark:text-white">{{
                                formatCurrency(stats.monthly_expense)
                            }}</span>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <span
                                class="bg-black px-2 py-1 font-mono text-sm font-black uppercase text-white dark:bg-white dark:text-black"
                                >Net Flow</span
                            >
                            <span
                                class="font-mono text-2xl font-black dark:text-white"
                            >
                                {{ props.stats.cash_flow >= 0 ? '+' : '-' }}
                                {{ formatCurrency(Math.abs(stats.cash_flow)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 2: FULL WIDTH CHART -->
            <div class="my-12 lg:col-span-12 lg:my-16">
                <div
                    class="border border-black bg-white p-8 transition-colors duration-500 dark:border-white/20 dark:bg-[#1A1A1A]"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{
                        opacity: 1,
                        y: 0,
                        transition: { duration: 700, ease: 'easeOutQuart' },
                    }"
                >
                    <div
                        class="mb-6 flex flex-col justify-between gap-4 border-b border-black pb-4 md:flex-row md:items-end dark:border-white/20"
                    >
                        <h3
                            class="font-sans text-3xl font-bold uppercase tracking-tighter dark:text-white"
                        >
                            <span
                                class="mr-3 bg-black px-3 py-1 align-middle text-sm uppercase tracking-widest text-white dark:bg-white dark:text-black"
                                >Chart</span
                            >
                            Money Trend Analysis
                        </h3>
                        <p
                            class="font-mono text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400"
                        >
                            Daily Income and Outcome movement
                        </p>
                    </div>
                    <div
                        class="relative h-96 border border-gray-200 p-4 dark:border-white/10"
                    >
                        <Line
                            :data="chartData"
                            :options="chartOptions"
                            :key="`${selectedYear}-${selectedMonth}-${isMidnight}`"
                        />
                    </div>
                </div>
            </div>

            <!-- ROW 3: THREE COLUMNS -->
            <div
                class="mb-12 flex flex-col lg:col-span-4"
                v-motion
                :initial="{ opacity: 0, y: 100, scale: 0.9 }"
                :visibleOnce="{
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    transition: {
                        duration: 800,
                        ease: 'easeOutQuart',
                        delay: 100,
                    },
                }"
            >
                <div
                    class="flex h-full flex-col border-2 border-black bg-white p-8 transition-all duration-300 hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,0.1)] dark:border-white/20 dark:bg-[#1A1A1A] dark:hover:shadow-[12px_12px_0px_0px_rgba(255,255,255,0.05)]"
                >
                    <h4
                        class="mb-6 border-b-2 border-black pb-2 text-xs font-bold uppercase tracking-widest dark:border-white dark:text-white"
                    >
                        Income Sources
                    </h4>
                    <div
                        class="relative flex min-h-[250px] flex-grow items-center justify-center"
                    >
                        <div class="h-full w-full">
                            <Doughnut
                                :data="incomeBreakdownData"
                                :options="{
                                    ...doughnutOptions,
                                    maintainAspectRatio: false,
                                }"
                            />
                        </div>
                        <div
                            v-if="breakdown.income.data.length === 0"
                            class="absolute inset-0 flex items-center justify-center text-xs italic text-gray-400"
                        >
                            No data
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mb-12 flex flex-col lg:col-span-4"
                v-motion
                :initial="{ opacity: 0, y: 100, scale: 0.9 }"
                :visibleOnce="{
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    transition: {
                        duration: 800,
                        ease: 'easeOutQuart',
                        delay: 250,
                    },
                }"
            >
                <div
                    class="flex h-full flex-col border-2 border-black bg-white p-8 transition-all duration-300 hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,0.1)] dark:border-white/20 dark:bg-[#1A1A1A] dark:hover:shadow-[12px_12px_0px_0px_rgba(255,255,255,0.05)]"
                >
                    <h4
                        class="mb-6 border-b-2 border-black pb-2 text-xs font-bold uppercase tracking-widest dark:border-white dark:text-white"
                    >
                        Outcome Split
                    </h4>
                    <div
                        class="relative flex min-h-[250px] flex-grow items-center justify-center"
                    >
                        <div class="h-full w-full">
                            <Doughnut
                                :data="outcomeBreakdownData"
                                :options="{
                                    ...doughnutOptions,
                                    maintainAspectRatio: false,
                                }"
                            />
                        </div>
                        <div
                            v-if="breakdown.expense.data.length === 0"
                            class="absolute inset-0 flex items-center justify-center text-xs italic text-gray-400"
                        >
                            No data
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mb-12 flex flex-col lg:col-span-4"
                v-motion
                :initial="{ opacity: 0, y: 100, scale: 0.9 }"
                :visibleOnce="{
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    transition: {
                        duration: 800,
                        ease: 'easeOutQuart',
                        delay: 400,
                    },
                }"
            >
                <div
                    class="flex h-full flex-col justify-between border-2 border-black bg-white p-8 transition-all duration-300 hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,0.1)] dark:border-white/20 dark:bg-[#1A1A1A] dark:hover:shadow-[12px_12px_0px_0px_rgba(255,255,255,0.05)]"
                >
                    <div>
                        <h4
                            class="mb-6 border-b border-black pb-2 text-xs font-bold uppercase tracking-[0.2em] text-black dark:border-white dark:text-white"
                        >
                            Money Analysis
                        </h4>
                        <div class="mb-8">
                            <p
                                class="mb-2 font-serif text-3xl font-black italic dark:text-white"
                            >
                                "{{ cashFlowLabel }}"
                            </p>
                            <p
                                class="font-serif text-sm leading-relaxed text-gray-700 dark:text-gray-300"
                            >
                                You are currently in a
                                <span
                                    class="font-bold text-black dark:text-white"
                                    >{{ cashFlowLabel.toLowerCase() }}</span
                                >
                                state. Maintain vigilance.
                            </p>
                        </div>
                        <div
                            v-if="stats.top_category"
                            class="mb-6 border border-gray-200 bg-gray-50 p-4 dark:border-white/10 dark:bg-white/5"
                        >
                            <p
                                class="mb-1 text-[10px] font-bold uppercase text-gray-500 dark:text-gray-400"
                            >
                                Biggest Spending
                            </p>
                            <p
                                class="font-serif text-lg font-bold leading-tight dark:text-white"
                            >
                                {{ stats.top_category.name }}
                            </p>
                            <p
                                class="mt-1 font-mono text-sm dark:text-gray-300"
                            >
                                {{ formatCurrency(stats.top_category.amount) }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="border-t-2 border-dashed border-black pt-4 dark:border-white"
                    >
                        <p
                            class="font-mono text-sm text-gray-500 dark:text-gray-400"
                        >
                            Daily Spend:
                            <span class="font-bold text-black dark:text-white"
                                >{{ formatCurrency(stats.burn_rate) }}/day</span
                            >
                        </p>
                    </div>
                </div>
            </div>

            <!-- ACTION SECTION -->
            <div class="mb-20 mt-12 text-center lg:col-span-12">
                <div
                    v-motion
                    :initial="{ opacity: 0, y: 50 }"
                    :visibleOnce="{
                        opacity: 1,
                        y: 0,
                        transition: { duration: 600, ease: 'easeOutQuart' },
                    }"
                >
                    <Link
                        :href="route('transactions.index')"
                        class="inline-block border-2 border-black bg-black px-12 py-5 text-sm font-black uppercase tracking-[0.2em] text-white transition-all duration-200 hover:bg-white hover:text-black hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:border-white dark:bg-white dark:text-black dark:hover:bg-black dark:hover:text-white dark:hover:shadow-[8px_8px_0px_0px_rgba(255,255,255,0.1)]"
                    >
                        + Add New Transaction
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
