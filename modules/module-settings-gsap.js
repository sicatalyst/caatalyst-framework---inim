/**
 * GSAP Module Settings Animation Handler
 * 
 * Requires: GSAP 3.x and ScrollTrigger plugin
 * 
 * Add to your theme:
 * <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
 * <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
 */

(function() {
  'use strict';
  
  // Wait for GSAP to load
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    console.warn('GSAP or ScrollTrigger not loaded. Module animations disabled.');
    return;
  }
  
  gsap.registerPlugin(ScrollTrigger);
  
  // Initialize animations when DOM is ready
  function initModuleAnimations() {
    const animatedModules = document.querySelectorAll('.gsap-animate');
    
    animatedModules.forEach(module => {
      const duration = parseFloat(module.dataset.animationDuration) || 1;
      const delay = parseFloat(module.dataset.animationDelay) || 0;
      const easing = module.dataset.animationEasing || 'power2.out';
      const stagger = parseFloat(module.dataset.animationStagger) || 0;
      
      // Determine animation type
      let animationType = 'fade';
      module.classList.forEach(className => {
        if (className.startsWith('animate-')) {
          animationType = className.replace('animate-', '');
        }
      });
      
      // Build animation properties
      const animProps = {
        opacity: 1,
        duration: duration,
        delay: delay,
        ease: easing,
        scrollTrigger: {
          trigger: module,
          start: 'top 85%',
          toggleActions: 'play none none none',
          once: true
        },
        onComplete: () => {
          module.classList.add('animated');
        }
      };
      
      // Add transform properties based on animation type
      switch (animationType) {
        case 'fadeUp':
          animProps.y = 0;
          break;
        case 'fadeDown':
          animProps.y = 0;
          break;
        case 'fadeLeft':
          animProps.x = 0;
          break;
        case 'fadeRight':
          animProps.x = 0;
          break;
        case 'scale':
          animProps.scale = 1;
          break;
        case 'slideUp':
          animProps.y = 0;
          break;
        case 'slideDown':
          animProps.y = 0;
          break;
        case 'slideLeft':
          animProps.x = 0;
          break;
        case 'slideRight':
          animProps.x = 0;
          break;
      }
      
      // Apply stagger to child elements if specified
      if (stagger > 0) {
        const children = module.children;
        if (children.length > 0) {
          animProps.stagger = stagger;
          gsap.to(children, animProps);
          return;
        }
      }
      
      // Animate the module itself
      gsap.to(module, animProps);
    });
  }
  
  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initModuleAnimations);
  } else {
    initModuleAnimations();
  }
  
  // Handle parallax backgrounds
  function initParallaxBackgrounds() {
    const parallaxModules = document.querySelectorAll('[data-parallax="true"]');
    
    parallaxModules.forEach(module => {
      const bgImage = module.style.backgroundImage;
      if (!bgImage) return;
      
      gsap.to(module, {
        backgroundPosition: '50% 100%',
        ease: 'none',
        scrollTrigger: {
          trigger: module,
          start: 'top bottom',
          end: 'bottom top',
          scrub: true
        }
      });
    });
  }
  
  // Initialize parallax
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initParallaxBackgrounds);
  } else {
    initParallaxBackgrounds();
  }
  
})();
