/**
 * Sectors Slider Module JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  // Sectors Navigation Swiper
  const sectorsNavSwiper = new window.Swiper('.sectors-nav-swiper', {
    slidesPerView: 2,
    spaceBetween: 20,
    loop: false,
    pagination: {
      el: '.sectors-pagination',
      clickable: true,
    },
    breakpoints: {
      480: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 6,
        spaceBetween: 30,
      },
    },
  });

  // Sectors Content Swiper
  const sectorsContentSwiper = new window.Swiper('.sectors-content-swiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: false,
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    allowTouchMove: false,
  });

  // Connect sectors navigation to content slider
  const sectorNavItems = document.querySelectorAll('.sector-nav-item');

  sectorNavItems.forEach((item, index) => {
    item.addEventListener('click', () => {
      // Remove active class from all items
      sectorNavItems.forEach(navItem => navItem.classList.remove('active'));
      
      // Add active class to clicked item
      item.classList.add('active');
      
      // Get the sector index
      const sectorIndex = parseInt(item.getAttribute('data-sector'));
      
      // Slide to corresponding content
      sectorsContentSwiper.slideTo(sectorIndex);
    });
  });

  // Set first item as active by default
  if (sectorNavItems.length > 0) {
    sectorNavItems[0].classList.add('active');
  }
});
