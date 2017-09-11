;(function($){
  


  jQuery.fn.extend({

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
        var progGrid_items = $('#prog-grid .m-2coll');
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
  
        jQuery.each( progGrid_items, function( i, val ) {

          var item_left = $(this).offset().left;
          var item_right = item_left + $(this).outerWidth();
          var item_top = $(this).offset().top;

          // console.log( val );
          // console.log( 'item top : ' +  item_top);
          // console.log( 'item right : ' +  item_right);
 
          if( item_right > progAside_left) {
            if( item_top < progAside_bottom) {
              $(this).css('clear', 'both');
              $(this).css('margin-left', '0');
              $(this).next().css('clear', 'none');
               $(this).next().css('margin-left', '2%');
            }
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

        jQuery.post(
            ajaxurl,
            {
                'action': 'get_posts_from_term',
                'term': term_slug
            },
            function(response){
              $('#webmag-mainGrid').html(response);
              
              var grid = document.getElementById('webmag-innergrid');
              salvattore.registerGrid(grid);
            }
        );
      }

  });
}(jQuery));



jQuery(function($) {
  $(document).ready(function() {
 

    $('.customer.share').on("click", function(e) {
      $(this).customerPopup(e);
    });



    // STICKY MENU

		$(window).scroll(function(){

			if ( jQuery(this).scrollTop() !== 0 ) {
	      $('.site-header').addClass('sticky');
	    } else {
	    	$('.site-header').removeClass('sticky');
	    }

    });


    // HAM MENU

    var ham_trigger = $('.js-menuTrigger');
    var ham_menu = $('#ham-menu');
    ham_trigger.on('click', function(event) {
      event.preventDefault();
      ham_menu.toggleClass('active');
      $(this).find('span').toggleClass('icon-close');
      $(this).find('span').toggleClass('icon-menu');
      $('body').toggleClass('no-scroll');
    });

    ham_menu.find('.menu-item-has-children > a').on('click', function(event) {

      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
        console.log('mag or prog !');
      } 
      else {
        event.preventDefault();
      }
    });


    // MENU MOBILE

    $('.menu-item-has-children > a').on('click', function(event) {
      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
        console.log('mag or prog !');
      } 
      else {
        event.preventDefault();

        if( $(this).hasClass('open') ) {
          $('.menu-item a').removeClass('open');
        }
        else {
          $('.menu-item a').removeClass('open');

          $(this).addClass('open');

        }


        // if( $(this).parent().find('.sub-menu').is(':visible') ) {

        //   $(this).find('.icon-arrow-left').remove();
        //   $('.sub-menu').hide();
        // }
        // else {

        //   $('.sub-menu').hide();
        //   $('.icon-arrow-left').remove();

        //   $(this).parent().find('.sub-menu').show();
        //   $(this).prepend('<span class="icon-arrow-left"></span>');
        // }
      }

    });




    // Socials
    $('#js-shareTrigger').on('click', function(event) {
      event.preventDefault();

      $(this).parent().toggleClass('open');
      $('.box-share-list').css('height', 'auto').css('visibility', 'visible');
    });


    $(document).mouseup(function(event) {
        var container = $(".eventActions-share");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(event.target) && container.has(event.target).length === 0) 
        {
            container.find('.box-share-list').css('height', '0').css('visibility', 'hidden');
            container.removeClass('open');
        }
    });



    // PROG FILTER

    $('input[name="is_archives"]').on('change', function(){

      if( $(this).attr('checked') === undefined ) {
        $('.progFilterForm-lower').show();
        $('.prog-pagetitle h1').html('Les <br>archives');

      } else {
        $('.progFilterForm-lower').hide();
        $('.prog-pagetitle h1').html('La programmation <br>à venir');
      }

    });



    $('.js-pdfTrigger').on('click', function(event) {
      event.preventDefault();
      $(this).toggleClass('open');
    });


    if( $('.bxslider-with-controls').length > 0 ) {
      $('.bxslider-with-controls').bxSlider({
        'prevText': '',
        'nextText': '',
      });
    }


    /*
     * Search Bar
     */

    $('#js-searchTrigger').on('click', function(event) {
      event.preventDefault();

      $(this).find('span').toggleClass('icon-search icon-close');
      $('.siteMenus-searchform').toggle();

      if( $('.emptyModal').is(':visible') ) {
        $('.emptyModal').hide();
      }
    });




    /*
     * Home
     */

    if( $('.module-focus').length == 1 ) {
      $(window).adaptFocusHeight();
    }

    $('#js-soundToggle').on('click', function(event) {
      event.preventDefault();
      toggleSound();
    });




    /*
     * Smooth scrolling
     * Add smooth when clicking an anchor
     */

    var hashTagActive = "";
    $(".scroll").click(function (event) {
        if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
            event.preventDefault();
            //calculate destination place
            var dest = 0;
            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                dest = $(document).height() - $(window).height() - 200;
            } else {
                dest = $(this.hash).offset().top - 150;
            }

            //go to destination
            $('html,body').animate({
                scrollTop: dest
            }, 1000, 'swing');
            hashTagActive = this.hash;
        }
    });




    /*
     * GRIDS
     */

    if( $('#prog-grid').length == 1 ) {
      $(window).alignProgGrid();
    }
      


    /*
     * AJAX STUFFS
     */  

    // LOAD SEARCH RESULTS
    $('#searchform').on('submit', function(event) {
      event.preventDefault();
      var keyword = $(this).find('input[type="text"]').val();

      jQuery.post(
          ajaxurl,
          {
              'action': 'search',
              'keyword': keyword
          },
          function(response){
            if( response ) {
              $('.emptyModal-inner').html(response);      
            }
            else {
              $('.emptyModal-inner').html('<p>Désolé, il n\'y a aucun résulat pour votre recherche...</p>');
            }
            $('.emptyModal').show();
            var grid = document.getElementById('webmag-innergrid');
            salvattore.registerGrid(grid);

          }
      );
    });



    // GET POSTS FROM CAT TERM
    $('.js-postmeta-term').on('click', function(event) {
      event.preventDefault();
      var term_slug = $(this).attr('cat-slug');
      $(window).getPostsFromTerm( term_slug );
    });

    if( $('.page-category').length == 1 ) {
      var term_slug = $('.page-category').attr('cat-slug');
      $(window).getPostsFromTerm( term_slug );
    }



    // EVENTS >> LOAD MORE
    var step = 18;
    var offset = step; 
    $('.load-more').on('click', function(event) {
      event.preventDefault();

      var posts_found = $(this).attr('posts_found');
      var month = $('.box-month').last().attr('month');
      var archives_value = $('input[name="is_archives"]').attr('checked');

      if( archives_value === undefined ) {
        var pastEvents = true;
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
            $('#prog-grid').append(response);

            if(posts_found < offset) {
              $('.load-more').hide();
            }
          }
      );
    });



    // EVENTS >> GET EVENTS FROM FILTERS
    $('#progFilter-form').on('change', function(event) {
      event.preventDefault();

      var discipline_value = $(this).find('select[name="discipline"]').val();
      var rdv_value = $(this).find('select[name="rdv"]').val();
      var public_value = $(this).find('select[name="public"]').val();
      var tarif_value = $(this).find('select[name="tarif"]').val();
      var is_archives_value = $(this).find('input[name="is_archives"]').attr('checked');
      var saison_value = $(this).find('input[name="radio-saison"]:checked').val();

      $('#prog-grid').html('Nous traitons votre demande...');
      $('#prog-grid').fadeOut();

      jQuery.post(
          ajaxurl,
          {
              'action': 'get_events_filtered',
              'discipline_value': discipline_value,
              'rdv_value': rdv_value,
              'public_value': public_value,
              'tarif_value': tarif_value,
              'is_archives_value': is_archives_value,
              'saison_value': saison_value,
          },
          function(response){

            $('#prog-grid').html(response);
            var prog_aside_height = $('.prog-aside').outerHeight();
            
            $('#prog-grid').fadeIn().css('min-height', prog_aside_height);

            if( $('.no-posts').length == 1 ) {
              $('.no-posts').height( $('.prog-aside').height() );
              $('.load-more').hide();
            } else {
              $(window).alignProgGrid();
            }

          }
      );
    });




    /*
     * ACCORDEON
     */

    var accordeon = $('.entry-accordeon');

    accordeon.on('click', function(event){
      event.preventDefault();

      $(this).toggleClass('open close');
      $(this).find('span').toggleClass('icon-fleche_accordeon icon-fleche_accordeon-bottom');
    });



    /*
     * Salvattore the search results
     */

    var searchgrid = document.getElementById('search-grid');
    salvattore.registerGrid(searchgrid);



    /*
     * All scripts triggered on resize
     */

    $( window ).resize(function() {
      $(window).adaptFocusHeight();
    });



  }); // end ready
});


