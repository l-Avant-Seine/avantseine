



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
            $('#prog-grid').append(response);
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
    $('.get-term').on('click', function(event) {
      event.preventDefault();

      var term = $(this).attr('cat-slug');

      jQuery.post(
          ajaxurl,
          {
              'action': 'get_posts_from_term',
              'term': term
          },
          function(response){
            $('#webmag-grid').html(response);
          }
      );
    });


    // GET EVENTS FROM FILTERS
    $('#progFilter-form').on('submit', function(event) {
      event.preventDefault();

      var discipline_value = $(this).find('select[name="discipline"]').val();
      var rdv_value = $(this).find('select[name="rdv"]').val();
      var public_value = $(this).find('select[name="public"]').val();
      var tarif_value = $(this).find('select[name="tarif"]').val();
      var is_archives_value = $(this).find('input[name="is_archives"]').val();


      jQuery.post(
          ajaxurl,
          {
              'action': 'get_events_filtered',
              'discipline_value': discipline_value,
              'rdv_value': rdv_value,
              'public_value': public_value,
              'tarif_value': tarif_value,
              'is_archives_value': is_archives_value,
          },
          function(response){
            $('#prog-grid').html(response);
          }
      );
    });







  });
});


