

jQuery(function($){

  console.log('hello');

  var bLazy = new Blazy({
  });


  $.fn.extend({


  		resetForms: function () {
      	document.forms['prog-filters'].reset();
  		},

    /**
     * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
     *
     * @param  {[object]} e           [Mouse event]
     * @param  {[integer]} intWidth   [Popup width defalut 500]
     * @param  {[integer]} intHeight  [Popup height defalut 400]
     * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
     */
      customerPopup: function (e, intWidth, intHeight, blnResize) {
    
        // Prevent default anchor event
        e.preventDefault();
        
        // Set values for window
        intWidth = intWidth || '500';
        intHeight = intHeight || '400';
        strResize = (blnResize ? 'yes' : 'no');

        // Set title and open popup with focus on it
        var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
            strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
            objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
      },


      loadFiltersResults: function ( that ) {

        prog_filters = $('#prog_filters');


        var discipline_value = $('select[name="discipline"]').val();
        var rdv_value = $('select[name="rdv"]').val();
        var public_value = $('select[name="public"]').val();
        var tarif_value = $('select[name="tarif"]').val();
        var saison_value = $('input[name="radio-saison"]:checked').val();

        var is_archives = $('#switch-passed').is(':checked');
        var is_tocome = $('#switch-tocome').is(':checked');


        if( $('#msg').length > 0 ) {
          $('#msg').html('<br><br>Nous recherchons dans la programmation...');

        }
        else {
          $('#agenda-maingrid').append('<div id="msg" class=" m-16col h_2"><br><br>Nous recherchons dans la programmation...</div>');
        }

        $('#agenda-maingrid').find('.event-outer').remove();

        jQuery.post(
            ajaxurl,
            {
                'action': 'get_events_filtered',
                'discipline_value': discipline_value,
                'rdv_value': rdv_value,
                'public_value': public_value,
                'tarif_value': tarif_value,
                'is_archives': is_archives,
                'saison_value': saison_value,
            },
            function(response){

              if( saison_value !== '0' ) {
                $('.load-more').hide();
              }

              $('#msg').remove();
              $('#agenda-maingrid').append(response);
              
              if( $('.no-posts').length == 1 ) {
                $('.load-more').hide();
              } 

              bLazy.revalidate();

            }
        );

      
      },


      getPostsFromTerm: function ( term_slug, keyword = '' ) {

        $('.js-postmeta-term').removeClass('active');
        $(".postmeta-term[cat-slug='" + term_slug + "']").addClass('active');
        var grid = document.getElementById('salgrid_3');
        $('.webmag-grid').addClass('loading');

        jQuery.post(
            ajaxurl,
            {
                'action': 'get_posts_from_term',
                'term': term_slug,
                'keyword': keyword
            },
            function(response){
              $('#salgrid_3').html(response);
              
              salvattore.registerGrid(grid);
              bLazy.revalidate();

              $('.nav-links').hide();
              var posts_found = $('.load-more-posts').attr('posts_found');

             // POSTS CAT >> LOAD MORE
              var posts_step = 12;
              var posts_offset = posts_step; 
              var message = $('.load-more-posts').html();

              if(posts_found < posts_offset) {
                $('.load-more-posts').hide();
              }
              $('.webmag-grid').removeClass('loading');


              $('.load-more-posts').on('click', function( event ) {
                event.preventDefault();
                
                $(this).html('Nous recherchons les articles...');
                
                jQuery.post(
                    ajaxurl,
                    {
                        'action': 'load_more_posts',
                        'offset': posts_offset,
                        'step': posts_step,
                        'cat': term_slug
                    },
                    function(response){
                      posts_offset = posts_offset + posts_step;

                      var grid = document.querySelector('#salgrid_3');
                      var mydata =  $($.parseHTML(response)).filter(".bloc-article"); 

                      salvattore.appendElements(grid, mydata);

                      $('.load-more-posts').html( message );

                      if(posts_found < posts_offset) {
                        $('.load-more-posts').hide();
                      }
                      
                      bLazy.revalidate();

                    }
                );
              });


            });
        	} 

  }); // END FUNCS




// HAM MENU

    var ham_trigger = $('#js-menuTrigger');
    var ham_menu = $('#ham-menu');
    
    $(ham_trigger).on('click', function( event ) {
      event.preventDefault();
      ham_menu.toggleClass('active');
      $(this).find('.hamburger').toggleClass('is-active');
      $('body').toggleClass('no-scroll menu-is-open');
    });

    ham_menu.find('.menu-item-has-children > a').on('click', function( event ) {

      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
      } 
      else {
        //event.preventDefault();
      }
    });



// ON SCROLL THINGS

	$(window).scroll(function(){
		if ( jQuery(this).scrollTop() > 100 ) {
	    $('body').addClass('scrolling');
	  } else {
	  	$('body').removeClass('scrolling');
	  }
  });



/*
 * Smooth scrolling
 * Add smooth when clicking an anchor
 */

    var hashTagActive = "";
    $(".scroll").click(function (event) {

        event.preventDefault();

        if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
            event.preventDefault();
            //calculate destination place
            var dest = 0;
            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                dest = $(document).height() - $(window).height();
            } else {
                dest = $(this.hash).offset().top;
            }

            //go to destination
            $('html,body').animate({
                scrollTop: dest
            }, 1000, 'swing');
            hashTagActive = this.hash;
        }
    });



// GET POSTS FROM CAT TERM

    $('.js-postmeta-term').on('click', function( event ) {
      event.preventDefault();

      var keyword = $('#search_in_magazine').find('input[type="text"]').val();
      var term_slug = $(this).attr('cat-slug');

      $('.webmag-grid').attr('data-cat', term_slug);

      $(window).getPostsFromTerm( term_slug, keyword );

    });

    $('#search_in_magazine').on('submit', function(event) {

      event.preventDefault();

      var keyword = $('#search_in_magazine').find('input[type="text"]').val();
      var term_slug = $('.webmag-grid').attr('data-cat');

      console.log(keyword);
      console.log(term_slug);

      $('#salgrid_3').css('opacity', '.5');

      jQuery.post(
          ajaxurl,
          {
              'action': 'search',
              'keyword': keyword,
              'magazine': true,
              'term_slug': term_slug
          },
          function(response){
            if( response ) {
              
              $('#salgrid_3').html(response);

              var grid = document.getElementById('salgrid_3');
              salvattore.registerGrid(grid);
              bLazy.revalidate();
      
            }
            else {
              $('#salgrid_3').html('Désolé, il n\'y a aucun résulat pour votre recherche...');
            }
            
            $('#salgrid_3').css('opacity', '1');
            $('.paging-navigation').hide();

          }
      );

    });

    if( $('.page-category').length == 1 ) {

      var keyword = $(this).find('input[type="text"]').val();
      var term_slug = $('.page-category').attr('cat-slug');

      $(window).getPostsFromTerm( term_slug );

    }




// SOCIAL

    $('#js-shareTrigger').on('click', function( event ) {
      event.preventDefault();

      $(this).parent().toggleClass('open');
      $('.box-share-list').css('height', 'auto').css('visibility', 'visible');
    });



// SEARCH
  var modal = $('#modal');
  var modal_content = $('#modal-content');
  var modal_title = $('#modal-title');

    $('#searchform-close').on('click', function( event ) {
      event.preventDefault();
      $('#siteMenus-searchform').hide()
      modal.hide();
    })

    $('#js-searchTrigger').on('click', function( event ) {
      event.preventDefault();

      $('#siteMenus-searchform').css('display', 'flex');

      if( modal.is(':visible') ) {
        modal.hide();
      }
    });

    $('#searchform').on('submit', function( event ) {
      event.preventDefault();

      var keyword = $(this).find('input[type="text"]').val();
      
      if( modal.is(':visible') ) {
        modal_content.css('opacity', '.5');
        modal_title.show();
        modal_title.html('Nous cherchons encore...')
      }
      else {
        modal.show();
      }

      jQuery.post(
          ajaxurl,
          {
              'action': 'search',
              'keyword': keyword
          },
          function(response){
            if( response ) {
              modal_content.html(response);
              modal_title.hide(); 

              var grid = document.getElementById('salgrid_3');
              salvattore.registerGrid(grid);
              bLazy.revalidate();
      
              modal_content.css('opacity', '1');

            }
            else {
              modal_title.html('Désolé, il n\'y a aucun résulat pour votre recherche...');
            }
            //modal.show();
 
          }
      );
    });




// LOAD MORE EVENTS

    // EVENTS >> LOAD MORE
    var step = 18;
    var offset = step; 
    $('.load-more').on('click', function( event ) {
      event.preventDefault();
      var pastEvents;
      var posts_found = $(this).attr('posts_found');
      var month = $('.box-month').last().attr('month');

      var is_archives = $('#switch-passed').is(':checked');
      var is_tocome = $('#switch-tocome').is(':checked');

      jQuery.post(
          ajaxurl,
          {
              'action': 'load_more',
              'offset': offset,
              'step': step,
              'previous_month': month,
              'pastEvents': pastEvents,
              'is_archives': is_archives,
          },
          function(response){
            offset = offset + step;
            $('#agenda-maingrid').append(response);

            if(posts_found < offset) {
              $('.load-more').hide();
            }
            
            bLazy.revalidate();

          }
      );
    });



// EVENTS >> GET EVENTS FROM FILTERS
    var prog_filters = $('#prog-filters')
    
    if( prog_filters.length > 0 ) {

      prog_filters.on('change', 'select', function( event ) {

        event.preventDefault();
        
        $(this).parents('.c-select').find('.c-select--icon').removeClass('c-select-icon--dot').addClass('c-select-icon--x')

        $(window).loadFiltersResults( $(this) );

      });

      prog_filters.on('change', '.switch .cmn-toggle', function( event ) {

        event.preventDefault();

        $(this).parent().siblings().find('input').prop('checked', false);

        $('.filter-saisons-list').toggle();

        $(window).loadFiltersResults( $(this) );

      });


      prog_filters.on('change', 'input[name="radio-saison"]', function( event ) {

        event.preventDefault();

        $(this).parent().siblings().find('input').prop('checked', false);

        $(window).loadFiltersResults( $(this) );

      });

      $('.c-select--icon').on('click', function( event ) {

        $(this).parents('.c-select').find('select').prop('selectedIndex',0);
        $(this).removeClass('c-select-icon--x').addClass('c-select-icon--dot');
        
        $(window).loadFiltersResults( $(this) );

      });

    }



// LOGO MOBILE

const isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

if (isMobile) {
  $('#site-logo').attr('src', '/assets/img/avtseine-logo-2019-mobile.png');
  console.log('mobile');
}


// BROCHURES

    $('.js-pdfTrigger').on('click', function( event ) {
      event.preventDefault();
      $(this).siblings('ul').toggleClass('hidden');
    });



// ACCORDEON


    var accordeon = $('.entry-accordeon .accordeon-title');

    accordeon.on('click', function(event){
      event.preventDefault();

      $(this).parent().toggleClass('open close');
      $(this).find('span').toggleClass('icon-fleche_accordeon icon-fleche_accordeon-bottom');
    });




// A votre service

  $('#js-toggle-services').on('click', function(event) {
    event.preventDefault();

    $('.services-outer').toggleClass('services-open');
    $(this).find('span').toggleClass('icon-close');

  });



// SLICK SLIDERS

  if( $('.home-slides').length > 0 ) {
  	$('.home-slides').slick({
  		  centerMode: true,
  		  centerPadding: '7.5%',
  		  slidesToShow: 1,
  		  prevArrow: '<a href="#" type="button" class="slick-prev icon-FLECHE"></a>',
  		  nextArrow: '<a href="#" type="button" class="slick-next icon-FLECHE"></a>',
  		  responsive: [
          {
            breakpoint: 1080,
            settings: {
              centerPadding: '2.5%',
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          },
  		    {
  		      breakpoint: 768,
  		      settings: {
  		        arrows: false,
  		        centerMode: true,
  		        centerPadding: '40px',
  		        slidesToShow: 1
  		      }
  		    },
  		    {
  		      breakpoint: 480,
  		      settings: {
  		        arrows: false,
  		        centerMode: true,
  		        centerPadding: '20px',
  		        slidesToShow: 1
  		      }
  		    }
  		  ]
  	});
  }

  if( $('.single-slides').length > 0 ) {
    $('.single-slides').slick({
        centerMode: false,
        prevArrow: '<a href="#" type="button" class="slick-prev icon-FLECHE"></a>',
        nextArrow: '<a href="#" type="button" class="slick-next icon-FLECHE"></a>',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
    });
  }



});

