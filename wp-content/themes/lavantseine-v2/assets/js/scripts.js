



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

			if (jQuery(this).scrollTop() > 20) {
	      $('.site-header').addClass('sticky');
	    } else {
	    	$('.site-header').removeClass('sticky');
	    }

      
    })

  });
});


