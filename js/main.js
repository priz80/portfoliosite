new WOW().init();
/* const swiper = new Swiper('.swiper', {
  speed: 400,
  spaceBetween: 100,
}); */
const swiper = new Swiper('.swiper', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });