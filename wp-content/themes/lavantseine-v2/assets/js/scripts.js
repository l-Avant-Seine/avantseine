



jQuery(function($) {
  $(document).ready(function() {
 
    var ham_trigger = $('.js-menuTrigger');
    var ham_menu = $('#ham-menu');
    ham_trigger.on('click', function(event) {
      event.preventDefault();
      ham_menu.toggleClass('active');
    });



    // STICKY MENU

		$(window).scroll(function(){

			if ( jQuery(this).scrollTop() !== 0 ) {
	      $('.site-header').addClass('sticky');
	    } else {
	    	$('.site-header').removeClass('sticky');
	    }

      
    });






/*
 * AJAX STUFFS
 */

    // LOAD MORE EVENTS
    var step = 6;
    var offset = step; 
    $('.load-more').on('click', function(event) {
      event.preventDefault();

      jQuery.post(
          ajaxurl,
          {
              'action': 'load_more',
              'offset': offset,
              'step': step
          },
          function(response){
            offset = offset + step;
            $('.events-grid').append(response);
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



  });
});


