;(function($){
  
  /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
  $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
    
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
  };
  


  jQuery.fn.extend({
      alignProgGrid: function () {

        // Prog layout
        var progGrid_items = $('#prog-grid .m-2coll');
        var progAside = $('.prog-aside ');
        var progAside_left = $('.prog-aside ').offset().left;
        var progAside_top = $('.prog-aside ').offset().top;
        var progAside_bottom = progAside_top + progAside.outerHeight();

        // console.log( 'aside left : ' + progAside_left );
        // console.log( 'aside height : ' + progAside.outerHeight() );
        // console.log( 'aside bottom : ' + progAside_bottom );

        if( progGrid_items.length == 0 ) {
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
            }

          }
        });

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
    });



    // Socials
    $('#js-shareTrigger').on('click', function(event) {
      event.preventDefault();

      $(this).parent().toggleClass('open');
      $('.box-share-list').css('height', 'auto');
    });


    $(document).mouseup(function(event) {
        var container = $(".eventActions-share");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(event.target) && container.has(event.target).length === 0) 
        {
            container.find('.box-share-list').css('height', '0');
            container.removeClass('open');
        }
    });



    // PROG FILTER

    $('input[name="is_archives"]').on('change', function(){

      if( $(this).attr('checked') === undefined ) {
        $('.progFilterForm-lower').show();
      } else {
        $('.progFilterForm-lower').hide();
      }

    });



    $('.js-pdfTrigger').on('click', function(event) {
      event.preventDefault();
      $(this).toggleClass('open');
    });





/*
 * GRIDS
 */

  $(window).alignProgGrid();


/*
 * AJAX STUFFS
 */

    // LOAD MORE EVENTS
    var step = 12;
    var offset = step; 
    $('.load-more').on('click', function(event) {
      event.preventDefault();

      var posts_found = $(this).attr('posts_found');
      var month = $('.box-month').last().attr('month');

      jQuery.post(
          ajaxurl,
          {
              'action': 'load_more',
              'offset': offset,
              'step': step,
              'previous_month': month,
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
            $('.emptyModal-inner').html(response);
          }
      );
    });


    // GET POSTS FROM CAT TERM
    $('.js-postmeta-term').on('click', function(event) {
      event.preventDefault();

      var term = $(this).attr('cat-slug');
      
      $('.js-postmeta-term').removeClass('active');
      $(this).addClass('active');

      jQuery.post(
          ajaxurl,
          {
              'action': 'get_posts_from_term',
              'term': term
          },
          function(response){
            $('#webmag-mainGrid').html(response);
            

            var grid = document.getElementById('webmag-innergrid');
            salvattore.rescanMediaQueries(grid);
          }
      );
    });


    // GET EVENTS FROM FILTERS
    $('#progFilter-form').on('change', function(event) {
      event.preventDefault();

      var discipline_value = $(this).find('select[name="discipline"]').val();
      var rdv_value = $(this).find('select[name="rdv"]').val();
      var public_value = $(this).find('select[name="public"]').val();
      var tarif_value = $(this).find('select[name="tarif"]').val();
      var is_archives_value = $(this).find('input[name="is_archives"]').attr('checked');
      var saison_value = $(this).find('input[name="radio-saison"]:checked').val();

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

            if( $('.no-posts').length == 1 ) {
              $('.no-posts').height( $('.prog-aside').height() );
              $('.load-more').hide();
            } else {
              $(window).alignProgGrid();
            }

          }
      );
    });






  });
});


