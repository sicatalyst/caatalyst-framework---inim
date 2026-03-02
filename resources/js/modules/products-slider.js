/**
 * Products Slider Module JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  const productsSwiper = new window.Swiper('.products-swiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    navigation: {
      nextEl: '.products-next',
      prevEl: '.products-prev',
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1440: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
    },
  });
});
