<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-3 border-l-8 border-black text-start text-sm font-black uppercase tracking-widest text-black bg-gray-100 focus:outline-none transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-3 border-l-8 border-transparent text-start text-sm font-bold uppercase tracking-widest text-gray-500 hover:text-black hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
