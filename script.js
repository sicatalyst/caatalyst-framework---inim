// Initialize Swiper sliders

// Logo Slider (top)
const logoSwiper = new Swiper('.logo-swiper', {
  slidesPerView: 2,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 2500,
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

// Sectors Navigation Swiper
const sectorsNavSwiper = new Swiper('.sectors-nav-swiper', {
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
const sectorsContentSwiper = new Swiper('.sectors-content-swiper', {
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

// Products Swiper
const productsSwiper = new Swiper('.products-swiper', {
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

// Clients Swiper (bottom)
const clientsSwiper = new Swiper('.clients-swiper', {
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

// Mobile menu toggle (placeholder - expand as needed)
const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
const nav = document.querySelector('.nav');

if (mobileMenuToggle) {
  mobileMenuToggle.addEventListener('click', () => {
    nav.classList.toggle('mobile-active');
  });
}

// Smooth scroll for anchor links
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

// Video autoplay fallback
const heroVideo = document.querySelector('.hero-video');
if (heroVideo) {
  heroVideo.play().catch(error => {
    console.log('Video autoplay prevented:', error);
  });
}
