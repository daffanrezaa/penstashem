import { onMounted, onUnmounted } from 'vue';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// Configure ScrollTrigger for smoother performance
ScrollTrigger.config({
    autoRefreshEvents: 'visibilitychange,DOMContentLoaded,load',
    ignoreMobileResize: true
});

export function useScrollAnimations() {
    const scrollTriggers = [];

    /**
     * Fade In Up - Classic smooth entrance
     */
    const fadeInUp = (element, options = {}) => {
        const {
            delay = 0,
            duration = 0.8,
            y = 40,
            ease = 'power2.out',
            start = 'top 85%',
            markers = false
        } = options;

        const trigger = gsap.from(element, {
            y,
            opacity: 0,
            duration,
            delay,
            ease,
            force3D: true,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none',
                markers,
                fastScrollEnd: true,
                preventOverlaps: true
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Fade In Left - Slide from left
     */
    const fadeInLeft = (element, options = {}) => {
        const {
            delay = 0,
            duration = 0.8,
            x = -60,
            ease = 'power2.out',
            start = 'top 85%'
        } = options;

        const trigger = gsap.from(element, {
            x,
            opacity: 0,
            duration,
            delay,
            ease,
            force3D: true,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none',
                fastScrollEnd: true
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Fade In Right - Slide from right
     */
    const fadeInRight = (element, options = {}) => {
        const {
            delay = 0,
            duration = 0.8,
            x = 60,
            ease = 'power2.out',
            start = 'top 85%'
        } = options;

        const trigger = gsap.from(element, {
            x,
            opacity: 0,
            duration,
            delay,
            ease,
            force3D: true,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none',
                fastScrollEnd: true
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Scale In - Zoom in effect
     */
    const scaleIn = (element, options = {}) => {
        const {
            delay = 0,
            duration = 0.9,
            scale = 0.9,
            ease = 'power2.out',
            start = 'top 85%'
        } = options;

        const trigger = gsap.from(element, {
            scale,
            opacity: 0,
            duration,
            delay,
            ease,
            force3D: true,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none',
                fastScrollEnd: true
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Stagger Children - Animate children elements one by one
     */
    const staggerChildren = (container, options = {}) => {
        const {
            delay = 0,
            duration = 0.8,
            stagger = 0.15,
            y = 40,
            ease = 'power2.out',
            start = 'top 80%',
            childSelector = '> *'
        } = options;

        const children = container.querySelectorAll(childSelector);

        const trigger = gsap.from(children, {
            y,
            opacity: 0,
            duration,
            delay,
            stagger,
            ease,
            scrollTrigger: {
                trigger: container,
                start,
                toggleActions: 'play none none none'
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Parallax Effect - Smooth parallax scrolling
     */
    const parallax = (element, options = {}) => {
        const {
            y = -100,
            ease = 'none',
            start = 'top bottom',
            end = 'bottom top',
            scrub = 1
        } = options;

        const trigger = gsap.to(element, {
            y,
            ease,
            scrollTrigger: {
                trigger: element,
                start,
                end,
                scrub
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Counter Animation - Animate numbers
     */
    const animateCounter = (element, options = {}) => {
        const {
            duration = 2,
            ease = 'power2.out',
            start = 'top 80%',
            onUpdate
        } = options;

        const target = { value: 0 };
        const endValue = parseFloat(element.textContent.replace(/[^0-9.-]/g, ''));

        const trigger = gsap.to(target, {
            value: endValue,
            duration,
            ease,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none'
            },
            onUpdate: () => {
                if (onUpdate) {
                    onUpdate(target.value);
                } else {
                    element.textContent = Math.round(target.value).toLocaleString();
                }
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Draw Line - Animate line/border drawing
     */
    const drawLine = (element, options = {}) => {
        const {
            duration = 1.5,
            ease = 'power2.inOut',
            start = 'top 85%',
            direction = 'horizontal' // or 'vertical'
        } = options;

        const fromVars = direction === 'horizontal' 
            ? { width: 0 } 
            : { height: 0 };

        const trigger = gsap.from(element, {
            ...fromVars,
            duration,
            ease,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none'
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Clip Path Reveal - Modern reveal effect
     */
    const clipReveal = (element, options = {}) => {
        const {
            duration = 1.2,
            ease = 'power3.inOut',
            start = 'top 85%',
            direction = 'left' // left, right, top, bottom
        } = options;

        const clipPaths = {
            left: 'inset(0 100% 0 0)',
            right: 'inset(0 0 0 100%)',
            top: 'inset(100% 0 0 0)',
            bottom: 'inset(0 0 100% 0)'
        };

        const trigger = gsap.from(element, {
            clipPath: clipPaths[direction],
            duration,
            ease,
            scrollTrigger: {
                trigger: element,
                start,
                toggleActions: 'play none none none'
            }
        });

        scrollTriggers.push(trigger.scrollTrigger);
        return trigger;
    };

    /**
     * Cleanup function - Remove all ScrollTriggers
     */
    const cleanup = () => {
        scrollTriggers.forEach(trigger => {
            if (trigger) trigger.kill();
        });
        scrollTriggers.length = 0;
    };

    // Auto cleanup on unmount
    onUnmounted(() => {
        cleanup();
    });

    return {
        fadeInUp,
        fadeInLeft,
        fadeInRight,
        scaleIn,
        staggerChildren,
        parallax,
        animateCounter,
        drawLine,
        clipReveal,
        cleanup,
        ScrollTrigger
    };
}
