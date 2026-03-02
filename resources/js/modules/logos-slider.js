/**
 * Logos Slider (Bottom) Module JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  const clientsSwiper = new window.Swiper('.clients-swiper', {
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      640: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 50,
      },
    },
  });
});
