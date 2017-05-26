



jQuery(function($) {
  $(document).ready(function() {
 





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
    });



    // PROG FILTER

    $('input[name="is_archives"]').on('change', function(){

      if( $(this).attr('checked') === undefined ) {
        $('.progFilterForm-lower').show();
      } else {
        $('.progFilterForm-lower').hide();
      }

    });






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

      console.log(month);

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
      var is_archives_value = $(this).find('input[name="is_archives"]').attr('checked');
      var saison_value = $(this).find('input[name="saison"]:checked').val();

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
          }
      );
    });







  });
});


