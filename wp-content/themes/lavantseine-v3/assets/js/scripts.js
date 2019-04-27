

;(function($){




  jQuery.fn.extend({


  		resetForms: function () {
      	document.forms['progFilter-form'].reset();
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
              bLazy.revalidate();

              var posts_found = $('.load-more-posts').attr('posts_found');

             // POSTS CAT >> LOAD MORE
              var posts_step = 12;
              var posts_offset = posts_step; 
              var message = $('.load-more-posts').html();

              if(posts_found < posts_offset) {
                $('.load-more-posts').hide();
              }

              $('.load-more-posts').on('click', function(event) {
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

                      var grid = document.querySelector('#webmag-innergrid');
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
}(jQuery));





jQuery(function($) {



	console.log('hello');



    // HAM MENU

    var ham_trigger = $('#js-menuTrigger');
    var ham_menu = $('#ham-menu');
    
    $(ham_trigger).on('click', function(event) {
      event.preventDefault();
      ham_menu.toggleClass('active');
      $(this).find('span').toggleClass('icon-close');
      $(this).find('span').toggleClass('icon-menu');
      $('body').toggleClass('no-scroll menu-is-open');
    });

    ham_menu.find('.menu-item-has-children > a').on('click', function(event) {

      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
      } 
      else {
        event.preventDefault();
      }
    });



	$(window).scroll(function(){
		if ( jQuery(this).scrollTop() !== 0 ) {
	    $('body').addClass('scrolling');
	  } else {
	  	$('body').removeClass('scrolling');
	  }
  });


	var bLazy = new Blazy({
		selector: '.b-lazy'
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

