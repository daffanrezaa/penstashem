<script setup>
import { computed } from 'vue';

const props = defineProps({
    class: {
        type: String,
        default: 'w-12 h-12'
    },
    duration: {
        type: Number,
        default: 3000
    },
    yOffset: {
        type: Number,
        default: 15
    },
    rotateRange: {
        type: Number,
        default: 5
    },
    delay: {
        type: Number,
        default: 0
    },
    opacity: {
        type: Number,
        default: 1
    },
    scaleRange: {
        type: Number,
        default: 0
    }
});

// Generate random direction for rotation to make it feel natural
const rotationDir = Math.random() > 0.5 ? 1 : -1;

const styleObject = computed(() => ({
    opacity: props.opacity,
    animationName: 'float-dollar',
    animationDuration: `${props.duration}ms`,
    animationDelay: `${props.delay}ms`,
    animationIterationCount: 'infinite',
    animationTimingFunction: 'ease-in-out',
    '--y-offset': `-${props.yOffset}px`,
    '--rotate-deg': `${props.rotateRange * rotationDir}deg`,
    '--scale-to': `${1 + props.scaleRange}`,
}));
</script>

<template>
    <div 
        :class="props.class"
        :style="styleObject"
        class="will-change-transform"
    >
        <img src="/images/dollar.png" alt="Dollar" class="w-full h-full object-contain pointer-events-none" />
    </div>
</template>

<style>
/* CSS Animation is much lighter on the CPU than JS animation */
@keyframes float-dollar {
    0%, 100% {
        transform: translateY(0) rotate(0deg) scale(1);
    }
    50% {
        transform: translateY(var(--y-offset)) rotate(var(--rotate-deg)) scale(var(--scale-to));
    }
}

.will-change-transform {
    will-change: transform; /* Hint to browser to use GPU */
}
</style>
