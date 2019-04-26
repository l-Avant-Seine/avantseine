

jQuery(function($) {



	console.log('hello');


		$(window).scroll(function(){
			if ( jQuery(this).scrollTop() !== 0 ) {
	      $('body').addClass('scrolling');
	    } else {
	    	$('body').removeClass('scrolling');
	    }
    });
    

});

