// Smooth Scroll Animation Composable with GSAP ScrollTrigger
import { onMounted, onUnmounted } from 'vue'
import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

export function useScrollReveal() {
  const animateOnScroll = (selector, options = {}) => {
    const {
      trigger = selector,
      start = 'top 85%',
      end = 'bottom 15%',
      scrub = false,
      markers = false,
      y = 60,
      opacity = 0,
      duration = 1,
      stagger = 0.15,
      ease = 'power3.out',
      scale = 1,
      rotateX = 0,
      rotateY = 0,
      ...rest
    } = options

    return gsap.from(selector, {
      scrollTrigger: {
        trigger,
        start,
        end,
        scrub,
        markers,
        toggleActions: 'play none none reverse',
        ...rest
      },
      y,
      opacity,
      scale,
      rotateX,
      rotateY,
      duration,
      stagger,
      ease
    })
  }

  const cleanup = () => {
    ScrollTrigger.getAll().forEach(trigger => trigger.kill())
  }

  onUnmounted(() => {
    cleanup()
  })

  return {
    animateOnScroll,
    cleanup,
    ScrollTrigger
  }
}
