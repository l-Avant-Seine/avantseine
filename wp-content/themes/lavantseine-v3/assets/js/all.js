/*!
  hey, [be]Lazy.js - v1.8.2 - 2016.10.25
  A fast, small and dependency free lazy load script (https://github.com/dinbror/blazy)
  (c) Bjoern Klinggaard - @bklinggaard - http://dinbror.dk/blazy
*/
  (function(q,m){"function"===typeof define&&define.amd?define(m):"object"===typeof exports?module.exports=m():q.Blazy=m()})(this,function(){function q(b){var c=b._util;c.elements=E(b.options);c.count=c.elements.length;c.destroyed&&(c.destroyed=!1,b.options.container&&l(b.options.container,function(a){n(a,"scroll",c.validateT)}),n(window,"resize",c.saveViewportOffsetT),n(window,"resize",c.validateT),n(window,"scroll",c.validateT));m(b)}function m(b){for(var c=b._util,a=0;a<c.count;a++){var d=c.elements[a],e;a:{var g=d;e=b.options;var p=g.getBoundingClientRect();if(e.container&&y&&(g=g.closest(e.containerClass))){g=g.getBoundingClientRect();e=r(g,f)?r(p,{top:g.top-e.offset,right:g.right+e.offset,bottom:g.bottom+e.offset,left:g.left-e.offset}):!1;break a}e=r(p,f)}if(e||t(d,b.options.successClass))b.load(d),c.elements.splice(a,1),c.count--,a--}0===c.count&&b.destroy()}function r(b,c){return b.right>=c.left&&b.bottom>=c.top&&b.left<=c.right&&b.top<=c.bottom}function z(b,c,a){if(!t(b,a.successClass)&&(c||a.loadInvisible||0<b.offsetWidth&&0<b.offsetHeight))if(c=b.getAttribute(u)||b.getAttribute(a.src)){c=c.split(a.separator);var d=c[A&&1<c.length?1:0],e=b.getAttribute(a.srcset),g="img"===b.nodeName.toLowerCase(),p=(c=b.parentNode)&&"picture"===c.nodeName.toLowerCase();if(g||void 0===b.src){var h=new Image,w=function(){a.error&&a.error(b,"invalid");v(b,a.errorClass);k(h,"error",w);k(h,"load",f)},f=function(){g?p||B(b,d,e):b.style.backgroundImage='url("'+d+'")';x(b,a);k(h,"load",f);k(h,"error",w)};p&&(h=b,l(c.getElementsByTagName("source"),function(b){var c=a.srcset,e=b.getAttribute(c);e&&(b.setAttribute("srcset",e),b.removeAttribute(c))}));n(h,"error",w);n(h,"load",f);B(h,d,e)}else b.src=d,x(b,a)}else"video"===b.nodeName.toLowerCase()?(l(b.getElementsByTagName("source"),function(b){var c=a.src,e=b.getAttribute(c);e&&(b.setAttribute("src",e),b.removeAttribute(c))}),b.load(),x(b,a)):(a.error&&a.error(b,"missing"),v(b,a.errorClass))}function x(b,c){v(b,c.successClass);c.success&&c.success(b);b.removeAttribute(c.src);b.removeAttribute(c.srcset);l(c.breakpoints,function(a){b.removeAttribute(a.src)})}function B(b,c,a){a&&b.setAttribute("srcset",a);b.src=c}function t(b,c){return-1!==(" "+b.className+" ").indexOf(" "+c+" ")}function v(b,c){t(b,c)||(b.className+=" "+c)}function E(b){var c=[];b=b.root.querySelectorAll(b.selector);for(var a=b.length;a--;c.unshift(b[a]));return c}function C(b){f.bottom=(window.innerHeight||document.documentElement.clientHeight)+b;f.right=(window.innerWidth||document.documentElement.clientWidth)+b}function n(b,c,a){b.attachEvent?b.attachEvent&&b.attachEvent("on"+c,a):b.addEventListener(c,a,{capture:!1,passive:!0})}function k(b,c,a){b.detachEvent?b.detachEvent&&b.detachEvent("on"+c,a):b.removeEventListener(c,a,{capture:!1,passive:!0})}function l(b,c){if(b&&c)for(var a=b.length,d=0;d<a&&!1!==c(b[d],d);d++);}function D(b,c,a){var d=0;return function(){var e=+new Date;e-d<c||(d=e,b.apply(a,arguments))}}var u,f,A,y;return function(b){if(!document.querySelectorAll){var c=document.createStyleSheet();document.querySelectorAll=function(a,b,d,h,f){f=document.all;b=[];a=a.replace(/\[for\b/gi,"[htmlFor").split(",");for(d=a.length;d--;){c.addRule(a[d],"k:v");for(h=f.length;h--;)f[h].currentStyle.k&&b.push(f[h]);c.removeRule(0)}return b}}var a=this,d=a._util={};d.elements=[];d.destroyed=!0;a.options=b||{};a.options.error=a.options.error||!1;a.options.offset=a.options.offset||100;a.options.root=a.options.root||document;a.options.success=a.options.success||!1;a.options.selector=a.options.selector||".b-lazy";a.options.separator=a.options.separator||"|";a.options.containerClass=a.options.container;a.options.container=a.options.containerClass?document.querySelectorAll(a.options.containerClass):!1;a.options.errorClass=a.options.errorClass||"b-error";a.options.breakpoints=a.options.breakpoints||!1;a.options.loadInvisible=a.options.loadInvisible||!1;a.options.successClass=a.options.successClass||"b-loaded";a.options.validateDelay=a.options.validateDelay||25;a.options.saveViewportOffsetDelay=a.options.saveViewportOffsetDelay||50;a.options.srcset=a.options.srcset||"data-srcset";a.options.src=u=a.options.src||"data-src";y=Element.prototype.closest;A=1<window.devicePixelRatio;f={};f.top=0-a.options.offset;f.left=0-a.options.offset;a.revalidate=function(){q(a)};a.load=function(a,b){var c=this.options;void 0===a.length?z(a,b,c):l(a,function(a){z(a,b,c)})};a.destroy=function(){var a=this._util;this.options.container&&l(this.options.container,function(b){k(b,"scroll",a.validateT)});k(window,"scroll",a.validateT);k(window,"resize",a.validateT);k(window,"resize",a.saveViewportOffsetT);a.count=0;a.elements.length=0;a.destroyed=!0};d.validateT=D(function(){m(a)},a.options.validateDelay,a);d.saveViewportOffsetT=D(function(){C(a.options.offset)},a.options.saveViewportOffsetDelay,a);C(a.options.offset);l(a.options.breakpoints,function(a){if(a.width>=window.screen.width)return u=a.src,!1});setTimeout(function(){q(a)})}});
/* jshint laxcomma: true */
var salvattore = (function (global, document, undefined) {
"use strict";

var self = {},
    grids = [],
    mediaRules = [],
    mediaQueries = [],
    add_to_dataset = function(element, key, value) {
      // uses dataset function or a fallback for <ie10
      if (element.dataset) {
        element.dataset[key] = value;
      } else {
        element.setAttribute("data-" + key, value);
      }
      return;
    };

self.obtainGridSettings = function obtainGridSettings(element) {
  // returns the number of columns and the classes a column should have,
  // from computing the style of the ::before pseudo-element of the grid.

  var computedStyle = global.getComputedStyle(element, ":before")
    , content = computedStyle.getPropertyValue("content").slice(1, -1)
    , matchResult = content.match(/^\s*(\d+)(?:\s?\.(.+))?\s*$/)
    , numberOfColumns = 1
    , columnClasses = []
  ;

  if (matchResult) {
    numberOfColumns = matchResult[1];
    columnClasses = matchResult[2];
    columnClasses = columnClasses? columnClasses.split(".") : ["column"];
  } else {
    matchResult = content.match(/^\s*\.(.+)\s+(\d+)\s*$/);
    if (matchResult) {
      columnClasses = matchResult[1];
      numberOfColumns = matchResult[2];
      if (numberOfColumns) {
            numberOfColumns = numberOfColumns.split(".");
      }
    }
  }

  return {
    numberOfColumns: numberOfColumns,
    columnClasses: columnClasses
  };
};


self.addColumns = function addColumns(grid, items) {
  // from the settings obtained, it creates columns with
  // the configured classes and adds to them a list of items.

  var settings = self.obtainGridSettings(grid)
    , numberOfColumns = settings.numberOfColumns
    , columnClasses = settings.columnClasses
    , columnsItems = new Array(+numberOfColumns)
    , columnsFragment = document.createDocumentFragment()
    , i = numberOfColumns
    , selector
  ;

  while (i-- !== 0) {
    selector = "[data-columns] > *:nth-child(" + numberOfColumns + "n-" + i + ")";
    columnsItems.push(items.querySelectorAll(selector));
  }

  columnsItems.forEach(function append_to_grid_fragment(rows) {
    var column = document.createElement("div")
      , rowsFragment = document.createDocumentFragment()
    ;

    column.className = columnClasses.join(" ");

    Array.prototype.forEach.call(rows, function append_to_column(row) {
      rowsFragment.appendChild(row);
    });
    column.appendChild(rowsFragment);
    columnsFragment.appendChild(column);
  });

  grid.appendChild(columnsFragment);
  add_to_dataset(grid, 'columns', numberOfColumns);
};


self.removeColumns = function removeColumns(grid) {
  // removes all the columns from a grid, and returns a list
  // of items sorted by the ordering of columns.

  var range = document.createRange();
  range.selectNodeContents(grid);

  var columns = Array.prototype.filter.call(range.extractContents().childNodes, function filter_elements(node) {
    return node instanceof global.HTMLElement;
  });

  var numberOfColumns = columns.length
    , numberOfRowsInFirstColumn = columns[0].childNodes.length
    , sortedRows = new Array(numberOfRowsInFirstColumn * numberOfColumns)
  ;

  Array.prototype.forEach.call(columns, function iterate_columns(column, columnIndex) {
    Array.prototype.forEach.call(column.children, function iterate_rows(row, rowIndex) {
      sortedRows[rowIndex * numberOfColumns + columnIndex] = row;
    });
  });

  var container = document.createElement("div");
  add_to_dataset(container, 'columns', 0);

  sortedRows.filter(function filter_non_null(child) {
    return !!child;
  }).forEach(function append_row(child) {
    container.appendChild(child);
  });

  return container;
};


self.recreateColumns = function recreateColumns(grid) {
  // removes all the columns from the grid, and adds them again,
  // it is used when the number of columns change.

  global.requestAnimationFrame(function render_after_css_mediaQueryChange() {
    self.addColumns(grid, self.removeColumns(grid));
    var columnsChange = new CustomEvent("columnsChange");
    grid.dispatchEvent(columnsChange);
  });
};


self.mediaQueryChange = function mediaQueryChange(mql) {
  // recreates the columns when a media query matches the current state
  // of the browser.

  if (mql.matches) {
    Array.prototype.forEach.call(grids, self.recreateColumns);
  }
};


self.getCSSRules = function getCSSRules(stylesheet) {
  // returns a list of css rules from a stylesheet

  var cssRules;
  try {
    cssRules = stylesheet.sheet.cssRules || stylesheet.sheet.rules;
  } catch (e) {
    return [];
  }

  return cssRules || [];
};


self.getStylesheets = function getStylesheets() {
  // returns a list of all the styles in the document (that are accessible).

  var inlineStyleBlocks = Array.prototype.slice.call(document.querySelectorAll("style"));
  inlineStyleBlocks.forEach(function(stylesheet, idx) {
    if (stylesheet.type !== 'text/css' && stylesheet.type !== '') {
      inlineStyleBlocks.splice(idx, 1);
    }
  });

  return Array.prototype.concat.call(
    inlineStyleBlocks,
    Array.prototype.slice.call(document.querySelectorAll("link[rel='stylesheet']"))
  );
};


self.mediaRuleHasColumnsSelector = function mediaRuleHasColumnsSelector(rules) {
  // checks if a media query css rule has in its contents a selector that
  // styles the grid.

  var i, rule;

  try {
    i = rules.length;
  }
  catch (e) {
    i = 0;
  }

  while (i--) {
    rule = rules[i];
    if (rule.selectorText && rule.selectorText.match(/\[data-columns\](.*)::?before$/)) {
      return true;
    }
  }

  return false;
};


self.scanMediaQueries = function scanMediaQueries() {
  // scans all the stylesheets for selectors that style grids,
  // if the matchMedia API is supported.

  var newMediaRules = [];

  if (!global.matchMedia) {
    return;
  }

  self.getStylesheets().forEach(function extract_rules(stylesheet) {
    Array.prototype.forEach.call(self.getCSSRules(stylesheet), function filter_by_column_selector(rule) {
      // rule.media throws an 'not implemented error' in ie9 for import rules occasionally
      try {
        if (rule.media && rule.cssRules && self.mediaRuleHasColumnsSelector(rule.cssRules)) {
          newMediaRules.push(rule);
        }
      } catch (e) {}
    });
  });

  // remove matchMedia listeners from the old rules
  var oldRules = mediaRules.filter(function (el) {
      return newMediaRules.indexOf(el) === -1;
  });
  mediaQueries.filter(function (el) {
    return oldRules.indexOf(el.rule) !== -1;
  }).forEach(function (el) {
      el.mql.removeListener(self.mediaQueryChange);
  });
  mediaQueries = mediaQueries.filter(function (el) {
    return oldRules.indexOf(el.rule) === -1;
  });

  // add matchMedia listeners to the new rules
  newMediaRules.filter(function (el) {
    return mediaRules.indexOf(el) == -1;
  }).forEach(function (rule) {
      var mql = global.matchMedia(rule.media.mediaText);
      mql.addListener(self.mediaQueryChange);
      mediaQueries.push({rule: rule, mql:mql});
  });

  // swap mediaRules with the new set
  mediaRules.length = 0;
  mediaRules = newMediaRules;
};


self.rescanMediaQueries = function rescanMediaQueries() {
    self.scanMediaQueries();
    Array.prototype.forEach.call(grids, self.recreateColumns);
};


self.nextElementColumnIndex = function nextElementColumnIndex(grid, fragments) {
  // returns the index of the column where the given element must be added.

  var children = grid.children
    , m = children.length
    , lowestRowCount = 0
    , child
    , currentRowCount
    , i
    , index = 0
  ;
  for (i = 0; i < m; i++) {
    child = children[i];
    currentRowCount = child.children.length + (fragments[i].children || fragments[i].childNodes).length;
  if(lowestRowCount === 0) {
    lowestRowCount = currentRowCount;
  }
    if(currentRowCount < lowestRowCount) {
      index = i;
      lowestRowCount = currentRowCount;
    }
  }

  return index;
};


self.createFragmentsList = function createFragmentsList(quantity) {
  // returns a list of fragments

  var fragments = new Array(quantity)
    , i = 0
  ;

  while (i !== quantity) {
    fragments[i] = document.createDocumentFragment();
    i++;
  }

  return fragments;
};


self.appendElements = function appendElements(grid, elements) {
  // adds a list of elements to the end of a grid

  var columns = grid.children
    , numberOfColumns = columns.length
    , fragments = self.createFragmentsList(numberOfColumns)
  ;

  Array.prototype.forEach.call(elements, function append_to_next_fragment(element) {
    var columnIndex = self.nextElementColumnIndex(grid, fragments);
    fragments[columnIndex].appendChild(element);
  });

  Array.prototype.forEach.call(columns, function insert_column(column, index) {
    column.appendChild(fragments[index]);
  });
};


self.prependElements = function prependElements(grid, elements) {
  // adds a list of elements to the start of a grid

  var columns = grid.children
    , numberOfColumns = columns.length
    , fragments = self.createFragmentsList(numberOfColumns)
    , columnIndex = numberOfColumns - 1
  ;

  elements.forEach(function append_to_next_fragment(element) {
    var fragment = fragments[columnIndex];
    fragment.insertBefore(element, fragment.firstChild);
    if (columnIndex === 0) {
      columnIndex = numberOfColumns - 1;
    } else {
      columnIndex--;
    }
  });

  Array.prototype.forEach.call(columns, function insert_column(column, index) {
    column.insertBefore(fragments[index], column.firstChild);
  });

  // populates a fragment with n columns till the right
  var fragment = document.createDocumentFragment()
    , numberOfColumnsToExtract = elements.length % numberOfColumns
  ;

  while (numberOfColumnsToExtract-- !== 0) {
    fragment.appendChild(grid.lastChild);
  }

  // adds the fragment to the left
  grid.insertBefore(fragment, grid.firstChild);
};


self.registerGrid = function registerGrid (grid) {
  if (global.getComputedStyle(grid).display === "none") {
    return;
  }

  // retrieve the list of items from the grid itself
  var range = document.createRange();
  range.selectNodeContents(grid);

  var items = document.createElement("div");
  items.appendChild(range.extractContents());


  add_to_dataset(items, 'columns', 0);
  self.addColumns(grid, items);
  grids.push(grid);
};


self.init = function init() {
  // adds required CSS rule to hide 'content' based
  // configuration.

  var css = document.createElement("style");
  css.innerHTML = "[data-columns]::before{display:block;visibility:hidden;position:absolute;font-size:1px;}";
  document.head.appendChild(css);

  // scans all the grids in the document and generates
  // columns from their configuration.

  var gridElements = document.querySelectorAll("[data-columns]");
  Array.prototype.forEach.call(gridElements, self.registerGrid);
  self.scanMediaQueries();
};

self.init();

return {
  appendElements: self.appendElements,
  prependElements: self.prependElements,
  registerGrid: self.registerGrid,
  recreateColumns: self.recreateColumns,
  rescanMediaQueries: self.rescanMediaQueries,
  init: self.init,

  // maintains backwards compatibility with underscore style method names
  append_elements: self.appendElements,
  prepend_elements: self.prependElements,
  register_grid: self.registerGrid,
  recreate_columns: self.recreateColumns,
  rescan_media_queries: self.rescanMediaQueries
};

})(window, window.document);



  var bLazy = new Blazy({
      // options
  });

  var isMobile = {
      Android: function() {
          return navigator.userAgent.match(/Android/i);
      },
      BlackBerry: function() {
          return navigator.userAgent.match(/BlackBerry/i);
      },
      iOS: function() {
          return navigator.userAgent.match(/iPhone|iPad|iPod/i);
      },
      Opera: function() {
          return navigator.userAgent.match(/Opera Mini/i);
      },
      Windows: function() {
          return navigator.userAgent.match(/IEMobile/i);
      },
      any: function() {
          return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
      }
  };


;(function($){



  function resetForms() {
      document.forms['progFilter-form'].reset();
  }


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

        if( !isMobile.any() ) {
          $('.site-branding img').attr('src', '/wp-content/themes/lavantseine-v2/assets/img/logo_avtseine_horizontal.png');
        }
	    } else {
	    	$('.site-header').removeClass('sticky');

        if( !isMobile.any() ) {
          $('.site-branding img').attr('src', '/wp-content/themes/lavantseine-v2/assets/img/logo_avtseine_vertical.png');
        }
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
      $('.site-logo').attr('src', '/wp-content/themes/lavantseine-v2/assets/img/logo_avtseine_horizontal.png');
    });

    ham_menu.find('.menu-item-has-children > a').on('click', function(event) {

      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
      } 
      else {
        event.preventDefault();
      }
    });


    // MENU MOBILE

    $('.menu-item-has-children > a').on('click', function(event) {
      if( $(this).parent().hasClass('ham-prog') || $(this).parent().hasClass('ham-mag') ) {
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

      if( $(this).is(':checked') ) {
        $('.progFilterForm-lower').hide();
        $('.prog-pagetitle h1').html('La programmation <br>à venir');
      } else {
        $('.progFilterForm-lower').show();
        $('.prog-pagetitle h1').html('Les <br>archives');
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
            bLazy.revalidate();
            
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
      var pastEvents;
      var posts_found = $(this).attr('posts_found');
      var month = $('.box-month').last().attr('month');
      var archives_value = $('input[name="is_archives"]').attr('checked');

      if( archives_value === undefined ) {
         pastEvents = true;
      } else {
         pastEvents = false;
      }
      console.log(archives_value);

      console.log(pastEvents);

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
            
            $(window).alignProgGrid();
            bLazy.revalidate();

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
      var is_archives_value = $(this).find('input[name="is_archives"]').is(':checked');
      var saison_value = $(this).find('input[name="radio-saison"]:checked').val();

      $('#prog-grid').html('Nous recherchons dans la programmation...');

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

            console.log(saison_value);
            console.log(is_archives_value);

            if( saison_value !== '0' ) {
              $('.load-more').hide();
            }

            $('#prog-grid').html(response);
            var prog_aside_height = $('.prog-aside').outerHeight();
            
            $('#prog-grid').fadeIn().css('min-height', prog_aside_height);

            if( $('.no-posts').length == 1 ) {
              $('.no-posts').height( $('.prog-aside').height() );
              $('.load-more').hide();
            } else {
              $(window).alignProgGrid();
            }

            bLazy.revalidate();

          }
      );
    });




    /*
     * ACCORDEON
     */

    var accordeon = $('.entry-accordeon .accordeon-title');

    accordeon.on('click', function(event){
      event.preventDefault();

      $(this).parent().toggleClass('open close');
      $(this).find('span').toggleClass('icon-fleche_accordeon icon-fleche_accordeon-bottom');
    });



    /*
     * Salvattore the search results
     */

    var searchgrid = document.getElementById('search-grid');
    salvattore.registerGrid(searchgrid);



    resetForms();



    /*
     * All scripts triggered on resize
     */

    $( window ).resize(function() {
      $(window).adaptFocusHeight();
    });



  }); // end ready
});


