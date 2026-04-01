console.log('script main')

document.addEventListener('DOMContentLoaded', () => {



  // Initialiser Swiper.js avec les options souhaitées
  const swiperCover = new Swiper('.swiper-cover', {
    slidesPerView : 1,
    spaceBetween : 0,
  });


  const swiperCalendar = new Swiper('.swiper-calendar', {
    slidesPerView : 3,
    spaceBetween : 20,
  });



  const swiperMagazine = new Swiper('.swiper-magazine', {
    slidesPerView : 3.5,
    spaceBetween : 20,
  });



})