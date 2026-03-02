/**
 * Module Settings - GSAP Animations
 */

document.addEventListener('DOMContentLoaded', () => {
  const { gsap, ScrollTrigger } = window;
  
  if (!gsap || !ScrollTrigger) {
    console.warn('GSAP or ScrollTrigger not loaded');
    return;
  }

  // Find all modules with animation settings
  const animatedModules = document.querySelectorAll('[data-animation-type]');

  animatedModules.forEach(module => {
    const animationType = module.getAttribute('data-animation-type');
    const duration = parseFloat(module.getAttribute('data-animation-duration')) || 1;
    const delay = parseFloat(module.getAttribute('data-animation-delay')) || 0;
    const easing = module.getAttribute('data-animation-easing') || 'power2.out';

    // Define animation properties based on type
    let fromVars = {};
    let toVars = {
      duration: duration,
      delay: delay,
      ease: easing,
      scrollTrigger: {
        trigger: module,
        start: 'top 80%',
        toggleActions: 'play none none none',
      }
    };

    switch (animationType) {
      case 'fade-in':
        fromVars = { opacity: 0 };
        toVars.opacity = 1;
        break;
      
      case 'slide-up':
        fromVars = { opacity: 0, y: 50 };
        toVars.opacity = 1;
        toVars.y = 0;
        break;
      
      case 'slide-down':
        fromVars = { opacity: 0, y: -50 };
        toVars.opacity = 1;
        toVars.y = 0;
        break;
      
      case 'slide-left':
        fromVars = { opacity: 0, x: 50 };
        toVars.opacity = 1;
        toVars.x = 0;
        break;
      
      case 'slide-right':
        fromVars = { opacity: 0, x: -50 };
        toVars.opacity = 1;
        toVars.x = 0;
        break;
      
      case 'scale-up':
        fromVars = { opacity: 0, scale: 0.8 };
        toVars.opacity = 1;
        toVars.scale = 1;
        break;
      
      case 'rotate-in':
        fromVars = { opacity: 0, rotation: -10 };
        toVars.opacity = 1;
        toVars.rotation = 0;
        break;
      
      default:
        return; // No animation
    }

    // Apply animation
    gsap.fromTo(module, fromVars, toVars);
  });
});
