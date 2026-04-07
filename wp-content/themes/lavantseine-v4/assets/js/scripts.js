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
  });

  const swiperVisuels = new Swiper('.swiper-visuels', {
    slidesPerView : 2,
    spaceBetween : 40,
    loop: true,
    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
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
      el.addEventListener('click', event => {
        event.preventDefault()
        el.nextElementSibling.classList.add('displayed')
      })
    })




  /* SAISONS ARCHIVES */

  const archives_groups = document.querySelectorAll('.archives_group');

  if(archives_groups) {
    archives_groups.forEach( el => {
      console.log(el);
      const title = el.querySelector('.group_title');
      const list = el.querySelector('.group_list');

      const list_height = list.offsetHeight;
      list.style.maxHeight = list_height + 'px';

      list.classList.add('small')

      title.addEventListener('click', () => {

        const small = document.querySelector('.group_list:not(.small)')
        if(small) small.classList.add('small');

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
    const data = new FormData();
    const ajaxurl = ajax_datas.ajaxUrl;
    data.set('nonce', ajax_datas.nonce);

    const fetchAndDisplayDatas = async ( append = false ) => {
        console.log('fetchAndDisplayDatas', data)

        data.set('action', 'get_events');

        fetch(ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Cache-Control': 'no-cache',
            },
            body: new URLSearchParams(data),
        })
        .then( response => { console.log(response); return response.json();  } )
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

                  const swiperCalendar = new Swiper('.swiper-calendar', {
                    slidesPerView : 3,
                    slidesPerGroup: 3,
                    spaceBetween : 20,
                    navigation: {
                      nextEl: '.cal-btn-next',
                      prevEl: '.cal-btn-prev',
                    },
                  });

                  const swiperDates = new Swiper('.swiper-dates', {
                    slidesPerView : 14,
                    slidesPerGroup: 14,
                    spaceBetween : 10,
                    navigation: {
                      nextEl: '.dates-btn-next',
                      prevEl: '.dates-btn-prev',
                    },
                  });


            }, 1000)
        })
        .then( () => {

          setTimeout( () => {
            calendar.classList.remove('loading')
            calendar_inner.classList.add('visible')
            loader.classList.add('hidden');
          }, 1000 )

        });
    }



    fetchAndDisplayDatas( false ).then( () => {

        });



  }
  

  /* EVENTS */

  document.addEventListener("scroll", documentIsScrolling, false);

})