// Lenis Smooth Scroll Integration
import { onMounted, onUnmounted } from 'vue'

export function useLenis() {
  let lenis = null

  onMounted(() => {
    // Get global lenis instance
    lenis = window.lenis

    if (!lenis) {
      console.warn('Lenis not initialized')
      return
    }

    // Optional: Add custom scroll event listeners
    lenis.on('scroll', (e) => {
      // You can add custom scroll logic here
      // console.log('Scrolling:', e)
    })
  })

  onUnmounted(() => {
    if (lenis) {
      // Clean up listeners if needed
      lenis.off('scroll')
    }
  })

  const scrollTo = (target, options = {}) => {
    if (!lenis) return
    
    const defaultOptions = {
      offset: 0,
      duration: 1.2,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      ...options
    }

    lenis.scrollTo(target, defaultOptions)
  }

  const scrollToTop = () => {
    scrollTo(0, { duration: 1.5 })
  }

  const stop = () => {
    if (lenis) lenis.stop()
  }

  const start = () => {
    if (lenis) lenis.start()
  }

  return {
    lenis,
    scrollTo,
    scrollToTop,
    stop,
    start
  }
}
