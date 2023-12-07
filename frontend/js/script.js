// Controle dos CARDS
var swiper = new Swiper(".slide-content", {
  slidesPerView: 4,
  spaceBetween: 40,
  loop: false,
  centerSlide: 'false',
  fade: 'false',
  grabCursor: 'true',
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints:{
      0: {
          slidesPerView: 1,
      },
      520: {
          slidesPerView: 2,
      },
      950: {
          slidesPerView: 4,
      },
  },
});