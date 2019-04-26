

jQuery(function($) {



	console.log('hello');


	$(window).scroll(function(){
		if ( jQuery(this).scrollTop() !== 0 ) {
	    $('body').addClass('scrolling');
	  } else {
	  	$('body').removeClass('scrolling');
	  }
  });


	var bLazy = new Blazy({
  });


	$('.home-slides').slick({
		  centerMode: true,
		  centerPadding: '5vw',
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

});

