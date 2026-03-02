/**
 * Hero Module JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  // Video autoplay fallback
  const heroVideo = document.querySelector('.hero-video');
  
  if (heroVideo) {
    heroVideo.play().catch(error => {
      console.log('Video autoplay prevented:', error);
    });
  }
});
