<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        type="button"
        class="inline-flex items-center rounded-none border-2 border-black bg-white px-4 py-2 text-xs font-bold uppercase tracking-widest text-black shadow-none transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25"
    >
        <slot />
    </button>
</template>
