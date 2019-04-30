

;(function($){




  jQuery.fn.extend({


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


      alignProgGrid: function () {

        // Prog layout
        var progGrid_items = $('#prog-grid .m-2coll').not( ".m-first, .el-second, .el-thrid" );
        var progAside = $('.prog-aside ');
        var progAside_left = $('.prog-aside ').offset().left;
        var progAside_top = $('.prog-aside ').offset().top;
        var progAside_bottom = progAside_top + progAside.innerHeight();

        // console.log( 'aside left : ' + progAside_left );
        // console.log( 'aside height : ' + progAside.outerHeight() );
        // console.log( 'aside bottom : ' + progAside_bottom );

        if( progGrid_items.length === 0 ) {
            progAside.css('position', 'relative');
        }
  
        var j = 1;

        jQuery.each( progGrid_items, function( i, val ) {

          var item_left = $(this).offset().left;
          var item_right = item_left + $(this).outerWidth();
          var item_top = $(this).offset().top;

          $(this).removeClass('m-first el-second el-thrid');

          if( item_right > progAside_left) {
            if( item_top < progAside_bottom) {
              j = 1;
            }
          }
          if ( $(this).is(':first-child') ) {
            j = 1;
          }

          if( j == 1 ) {
            $(this).addClass('m-first');
            j++;
          }

          else if( j == 2 ) {
            $(this).addClass('el-second');
            j++;
          }

          else if( j % 3 === 0 ) {
            $(this).addClass('el-thrid');
            j = 1;
          }

        });
      },


      adaptFocusHeight: function () {

        var focus_el = $('.focusElement_item').first();
        var focus_el_height = focus_el.innerHeight();
        var focus_square_height = focus_el.find('.square').innerHeight();
        var focus_height = focus_el_height - focus_square_height;

        //$('.focusEvent_infos').outerHeight( focus_height );
      },


      getPostsFromTerm: function ( term_slug ) {

        $('.js-postmeta-term').removeClass('active');
        $(".postmeta-term[cat-slug='" + term_slug + "']").addClass('active');
        var grid = document.getElementById('salgrid_3');
        $('.webmag-grid').addClass('loading');

        jQuery.post(
            ajaxurl,
            {
                'action': 'get_posts_from_term',
                'term': term_slug
            },
            function(response){
              $('#salgrid_3').html(response);
              
              salvattore.registerGrid(grid);
//              bLazy.revalidate();

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
                      
                      //bLazy.revalidate();

                    }
                );
              });


            });
        	} 

  }); // END FUNCS
}(jQuery));





jQuery(function($) {



	console.log('hello');



    // HAM MENU

    var ham_trigger = $('#js-menuTrigger');
    var ham_menu = $('#ham-menu');
    
    $(ham_trigger).on('click', function( event ) {
      event.preventDefault();
      ham_menu.toggleClass('active');
      $(this).find('span').toggleClass('icon-close');
      $(this).find('span').toggleClass('icon-menu');
      $('body').toggleClass('no-scroll menu-is-open');
    });

    ham_menu.find('.menu-item-has-children > a').on('click', function( event ) {

      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
      } 
      else {
        event.preventDefault();
      }
    });


// ON SCROLL THINGS

	$(window).scroll(function(){
		if ( jQuery(this).scrollTop() !== 0 ) {
	    $('body').addClass('scrolling');
	  } else {
	  	$('body').removeClass('scrolling');
	  }
  });



// GET POSTS FROM CAT TERM
    $('.js-postmeta-term').on('click', function( event ) {
      event.preventDefault();
      var term_slug = $(this).attr('cat-slug');
      $(window).getPostsFromTerm( term_slug );
      console.log('go !')
    });

    if( $('.page-category').length == 1 ) {
      var term_slug = $('.page-category').attr('cat-slug');
      $(window).getPostsFromTerm( term_slug );
    }


// LAZY LOADING

	var bLazy = new Blazy({
		selector: '.b-lazy'
  });



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
              //bLazy.revalidate();
      
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
      var archives_value = $('input[name="is_archives"]').attr('checked');

      if( archives_value === undefined ) {
         pastEvents = true;
      } else {
         pastEvents = false;
      }

      jQuery.post(
          ajaxurl,
          {
              'action': 'load_more',
              'offset': offset,
              'step': step,
              'previous_month': month,
              'pastEvents': pastEvents
          },
          function(response){
            offset = offset + step;
            $('#agenda-grid-item').append(response);

            if(posts_found < offset) {
              $('.load-more').hide();
            }
            
            //bLazy.revalidate();

          }
      );
    });



// EVENTS >> GET EVENTS FROM FILTERS

    $('#prog-filters').on('change', function( event ) {
      event.preventDefault();

      var discipline_value = $(this).find('select[name="discipline"]').val();
      var rdv_value = $(this).find('select[name="rdv"]').val();
      var public_value = $(this).find('select[name="public"]').val();
      var tarif_value = $(this).find('select[name="tarif"]').val();
      var is_archives_value = $(this).find('input[name="is_archives"]').is(':checked');
      var saison_value = $(this).find('input[name="radio-saison"]:checked').val();

      $('#agenda-maingrid').append('<div class="msg">Nous recherchons dans la programmation...</div>');

      $('#agenda-maingrid').find('.event-outer').remove();

      jQuery.post(
          ajaxurl,
          {
              'action': 'get_events_filtered',
              'discipline_value': discipline_value,
              'rdv_value': rdv_value,
              'public_value': public_value,
              'tarif_value': tarif_value,
              'is_archives_value': !is_archives_value,
              'saison_value': saison_value,
          },
          function(response){

            if( saison_value !== '0' ) {
              $('.load-more').hide();
            }

            $('.msg').remove();
            $('#agenda-maingrid').append(response);
            
            if( $('.no-posts').length == 1 ) {
              $('.load-more').hide();
            } 

            //bLazy.revalidate();

          }
      );
    });


// BROCHURES

    $('.js-pdfTrigger').on('click', function( event ) {
      event.preventDefault();
      $(this).find('ul').toggleClass('hidden');
    });




// SLICK SLIDERS

  if( $('.home-slides').length > 0 ) {
  	$('.home-slides').slick({
  		  centerMode: true,
  		  centerPadding: '2.5%',
  		  slidesToShow: 1,
  		  prevArrow: '<a href="#" type="button" class="slick-prev"></a>',
  		  nextArrow: '<a href="#" type="button" class="slick-next"> > </a>',
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

  if( $('.single-slides').length > 0 ) {
    $('.single-slides').slick({
        centerMode: false,
        adaptiveHeight: true,
        prevArrow: '<a href="#" type="button" class="slick-prev"></a>',
        nextArrow: '<a href="#" type="button" class="slick-next"> > </a>',
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

