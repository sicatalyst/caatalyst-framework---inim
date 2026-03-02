/**
 * Header Module JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  // Mobile menu toggle
  const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
  const nav = document.querySelector('.nav');

  if (mobileMenuToggle && nav) {
    mobileMenuToggle.addEventListener('click', () => {
      nav.classList.toggle('mobile-active');
    });
  }
});
