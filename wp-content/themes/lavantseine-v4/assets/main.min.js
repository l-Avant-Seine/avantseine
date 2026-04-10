console.log('script main')

document.addEventListener('DOMContentLoaded', () => {



  /* VARIABLES */
  $body = document.body;
  $masthead = document.getElementById('masthead');
  $main = document.getElementById('primary');
  $main_nav = document.getElementById('site-navigation');



  /* SWIPER */
  
  const swiperCover = new Swiper('.swiper-cover', {
    slidesPerView : 1,
    spaceBetween : 0,
    // autoplay: {
    //   delay: 4000
    // },
    loop: true,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
    on: {
      init: function() {
        console.log('swiper init');
        if( typeof Plyr !== 'undefined' ) {
          const players = Array.from(document.querySelectorAll('.js-player')).map((p) => new Plyr(p));
        }
      }
    }
  });

  const swiperSpectacles = new Swiper('.swiper-spectacles', {
    slidesPerView : 4,
    slidesPerGroup: 3,
    spaceBetween : 20,
    loop: true,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    breakpoints: {
      320: {
        slidesPerView : 1.2,
        slidesPerGroup: 1,
      },
      760: {
        slidesPerView : 2.2,
        slidesPerGroup: 1,
      },
      1000: {
        slidesPerView : 4,
        slidesPerGroup: 3,
      }
    }
  });

  const swiperVisuels = new Swiper('.swiper-visuels', {
    slidesPerView : 2,
    spaceBetween : 40,
    loop: true,
    centeredSlides: true,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    breakpoints: {
      320: {
        slidesPerView : 1.2,
        slidesPerGroup: 1,
      },
      1000: {
        slidesPerView : 2,
        slidesPerGroup: 2,
      }
    }
  });


  const swiperMagazine = new Swiper('.swiper-magazine', {
    slidesPerView : 3.5,
    slidesPerGroup: 3,
    spaceBetween : 20,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
    breakpoints: {
      320: {
        slidesPerView : 1.2,
        slidesPerGroup: 1,
      },
      600: {
        slidesPerView : 2.2,
        slidesPerGroup: 2,
      },
      1200: {
        slidesPerView : 4,
        slidesPerGroup: 3,
      }
    }
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
      el.addEventListener('click', event => {
        event.preventDefault()
        el.nextElementSibling.classList.add('displayed')
      })
    })


    const close_menu = document.querySelector('#close_menu');
    const menu_trigger = document.querySelector('#open_menu');
    const site_navigation = document.querySelector('#site-navigation');

    menu_trigger.addEventListener('click', () => {
      site_navigation.classList.add('open');
      $body.classList.add('no-scroll')
    })
    close_menu.addEventListener('click', () => {
      site_navigation.classList.remove('open');
      $body.classList.remove('no-scroll')
    })




  /* SAISONS ARCHIVES */

  const archives_groups = document.querySelectorAll('.archives_group');
  const archives_groups_not_first = document.querySelectorAll('.archives_group:not(:first-child)');

  if(archives_groups) {
    archives_groups.forEach( el => {
      const title = el.querySelector('.group_title');
      const list = el.querySelector('.group_list');

      const list_height = list.offsetHeight;
      list.style.maxHeight = list_height + 'px';

      // archives_groups_not_first.forEach( a => a.classList.add('small') );
      list.classList.add('small')
      
      title.addEventListener('click', () => {

//        if( title.classList.contains('') ) 
        const small = document.querySelector('.group_list:not(.small)')
        if( small ) small.classList.add('small');

        el.classList.toggle('open');
        list.classList.toggle('small');
        list.scrollIntoView();
      })

    })
  }


  /* ACCORDEONS */
  const accordeons = document.querySelectorAll('.entry-accordeon');

  if (accordeons) {
    accordeons.forEach( el => {

      const title = el.querySelector('.accordeon-title');
      const content = el.querySelector('.accordeon-content');
      const content_height = content.offsetHeight;
      content.style.maxHeight = content_height + 'px';

      el.classList.add('close');

      title.addEventListener('click', event => {
        event.preventDefault();

        el.classList.toggle('close');
        el.querySelector('span').classList.toggle('icon-fleche_accordeon').toggle('icon-fleche_accordeon-bottom');
      });
      
    })
  }






  const calendar = document.querySelector('.mod_calendar');
  const calendar_inner = document.querySelector('#calendar_inner');
  const loader = document.querySelector('#loader');

  if( calendar ) {

  // DATAS
    let swiperCalendar, swiperDates;
    const data = new FormData();
    const ajaxurl = ajax_datas.ajaxUrl;
    data.set('nonce', ajax_datas.nonce);

    const fetchAndDisplayDatas = async ( append = false ) => {

        data.set('action', 'get_events');

        fetch(ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Cache-Control': 'no-cache',
            },
            body: new URLSearchParams(data),
        })
        .then( response => { return response.json();  } )
        .then( body => {

            if (!body.success) return;

            if( append ) {
                setTimeout( () => {
                    calendar_inner.insertAdjacentHTML('beforeend', body.data); 
                }, 400)
            } else {
                setTimeout( () => {
                    calendar_inner.innerHTML = body.data;                   
                }, 400)
            }
          
        })
        .then( () => {
            console.log('then')
            setTimeout( () => {

                  swiperCalendar = new Swiper('.swiper-calendar', {
                    slidesPerView : 3,
                    slidesPerGroup: 3,
                    spaceBetween : 20,
                    fadeEffect: { crossFade: true, },
                    navigation: {
                      nextEl: '.cal-btn-next',
                      prevEl: '.cal-btn-prev',
                    },
                    breakpoints: {
                      320: {
                        slidesPerView : 1.2,
                        slidesPerGroup: 1,
                      },
                      600: {
                        slidesPerView : 2.2,
                        slidesPerGroup: 2,
                      },
                      1200: {
                        slidesPerView : 4,
                        slidesPerGroup: 3,
                      }
                    }
                  });

                  swiperDates = new Swiper('.swiper-dates', {
                    slidesPerView : 14,
                    slidesPerGroup: 7,
                    spaceBetween : 10,
                    navigation: {
                      nextEl: '.dates-btn-next',
                      prevEl: '.dates-btn-prev',
                    },
                    breakpoints: {
                      320: {
                        slidesPerView : 5,
                        slidesPerGroup: 4,
                      },
                      820: {
                        slidesPerView : 10,
                        slidesPerGroup: 7,
                      },
                      1200: {
                        slidesPerView : 14,
                        slidesPerGroup: 7,
                      },
                      1600: {
                        slidesPerView : 18,
                        slidesPerGroup: 15,
                      }
                    }
                  });


            }, 1000)
        })
        .then( () => {

          setTimeout( () => {
            calendar.classList.remove('loading')
            calendar_inner.classList.add('visible')
            loader.classList.add('hidden');


            const dates = document.querySelectorAll('.date');
            dates.forEach( el => {
              el.addEventListener('click', () => {
                console.log('fgege')

                const i = el.getAttribute('data-index');

                swiperCalendar.slideTo(i, 100)

              })
            })
          }, 1000 )

        });
    }

    fetchAndDisplayDatas( false );

  }
  



  /* EVENTS */

  document.addEventListener("scroll", documentIsScrolling, false);

})