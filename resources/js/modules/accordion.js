/**
 * Accordion Module JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
  const accordionItems = document.querySelectorAll('[data-accordion-item]');
  
  accordionItems.forEach(item => {
    const header = item.querySelector('.accordion-header');
    const content = item.querySelector('.accordion-content');
    
    if (!header || !content) return;
    
    header.addEventListener('click', function() {
      const isOpen = item.classList.contains('is-open');
      
      // Close all other accordion items (optional - remove for multi-open)
      accordionItems.forEach(otherItem => {
        if (otherItem !== item) {
          otherItem.classList.remove('is-open');
          const otherContent = otherItem.querySelector('.accordion-content');
          const otherHeader = otherItem.querySelector('.accordion-header');
          if (otherContent) otherContent.style.display = 'none';
          if (otherHeader) otherHeader.setAttribute('aria-expanded', 'false');
        }
      });
      
      // Toggle current item
      if (isOpen) {
        item.classList.remove('is-open');
        content.style.display = 'none';
        header.setAttribute('aria-expanded', 'false');
      } else {
        item.classList.add('is-open');
        content.style.display = 'block';
        header.setAttribute('aria-expanded', 'true');
      }
    });
  });
});
