/**
 * INIM Fire Intelligence - Main JavaScript
 * 
 * This file imports core dependencies and utilities.
 * Module-specific JS is loaded dynamically.
 */

// Import main styles
import '../css/app.css';

// Import core dependencies (available globally)
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Make Swiper and GSAP available globally for modules
window.Swiper = Swiper;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});

console.log('INIM Fire Intelligence theme loaded');
