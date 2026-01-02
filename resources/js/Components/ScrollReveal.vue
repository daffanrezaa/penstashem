<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    delay: {
        type: Number,
        default: 0
    }
});

const el = ref(null);
const isVisible = ref(false);
let observer = null;

onMounted(() => {
    observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                // Add a small delay for the observer itself to prevent instant triggers on load
                requestAnimationFrame(() => {
                    isVisible.value = true;
                });
                observer.disconnect();
            }
        },
        {
            threshold: 0.1, // Trigger when 10% visible
            rootMargin: '50px' // Start slightly before it enters viewport
        }
    );

    if (el.value) {
        observer.observe(el.value);
    }
});

onUnmounted(() => {
    if (observer) observer.disconnect();
});
</script>

<template>
    <div
        ref="el"
        class="transition-all duration-1000 ease-[cubic-bezier(0.25,0.8,0.25,1)] will-change-transform motion-reduce:transition-none motion-reduce:opacity-100 motion-reduce:transform-none"
        :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-16'"
        :style="{ transitionDelay: `${delay}ms` }"
    >
        <slot />
    </div>
</template>
