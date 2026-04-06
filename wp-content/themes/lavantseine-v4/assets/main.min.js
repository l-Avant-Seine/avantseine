console.log('script main')

document.addEventListener('DOMContentLoaded', () => {



  /* VARIABLES */

  $masthead = document.getElementById('masthead');
  $main = document.getElementById('primary');
  $main_nav = document.getElementById('site-navigation');



  /* SWIPER */
  
  const swiperCover = new Swiper('.swiper-cover', {
    slidesPerView : 1,
    spaceBetween : 0,
    autoplay: {
      delay: 4000
    },
    loop: true,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
  });


  const swiperSpectacles = new Swiper('.swiper-spectacles', {
    slidesPerView : 4,
    spaceBetween : 20,
    loop: true,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
  });


  const swiperCalendar = new Swiper('.swiper-calendar', {
    slidesPerView : 3,
    slidesPerGroup: 3,
    spaceBetween : 20,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
  });


  const swiperMagazine = new Swiper('.swiper-magazine', {
    slidesPerView : 3.5,
    slidesPerGroup: 3,
    spaceBetween : 20,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
  });




  /* HEAD */

  let didScroll;
  let lastScrollTop = 0;
  let delta = 20;

    const documentIsScrolling = function () {
        didScroll = true;

        // Handle menu
        setInterval(function() {
            if (didScroll) {
                handleScrollForMenu();
                didScroll = false;
            }
        }, 250);
    }


    const handleScrollForMenu = function () {
        let st = window.scrollY;

        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;
        
        if( st < 50 ) {
            //console.log('documentIsScrolling BACKTOTHETOP');
            document.getElementById('page').classList.remove('scrolling')
            $masthead.classList.remove('fixed');
            $masthead.classList.remove('in');
        }
        else if (st > lastScrollTop ){
            // console.log('documentIsScrolling DOWN');
            document.getElementById('page').classList.add('scrolling')
            $masthead.classList.add('fixed');
            $masthead.classList.remove('in');
        } 
        else {
            // console.log('documentIsScrolling UP');
            document.getElementById('page').classList.add('scrolling')
            $masthead.classList.add('in');
        }

        lastScrollTop = st;
    }


    const parent_items = document.querySelectorAll('.menu-item-has-children > a');
    const sub_menus = document.querySelectorAll('.sub-menu');

    parent_items.forEach(el => {
      console.log(el );
      el.addEventListener('click', event => {
        event.preventDefault()
        el.nextElementSibling.classList.add('displayed')
      })
    })




  /* EVENTS */

  document.addEventListener("scroll", documentIsScrolling, false);

})