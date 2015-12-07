/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // Add submenu class if present
        if ( $('.banner #sub-nav').length ) {
          $('body').addClass('has-sub');
        }
        // Minimize Header when scrolling
        var headerHeight = $('.banner').outerHeight();
        // Window load neccessary for accurate doc height
        $(window).load(function() {
          if ( $(window).height() + headerHeight < $(document).height() ) {
            $(window).scroll(function() {
              if( $(window).scrollTop() > 0) {
                $('body').addClass('mini');
              } else {
                $('body').removeClass('mini');
              }
            });
          }
        });
        // Searchfield
        $('.search-form__top-nav .toggle-search').click(function(e) {
          e.preventDefault();
          $(this).toggleClass('search-on');
          $('.search-form__top-nav .search-field').animate({width: 'toggle'}, 'fast', function() {
            $('.search-form__top-nav .search-field').focus();
            $('.search-form__top-nav .search-field').keypress(function(e) {
              if (e.which === 13) {
                e.preventDefault();
                $('.search-form__top-nav').submit();
              }
            });
            $('.search-form__top-nav .toggle-search').click(function(e) {
              e.preventDefault();
            });
          });
        });
        // Read More Link
        var $more_link = $('.split_more_link a.read-more');
        var more_text  = $more_link.html();
        $more_link.click(function(e){
          var less_text  = $(this).data('text-less');
          $(this).parents().find('.content_more').slideToggle('fast');
          $(this).html( $(this).html() === more_text ? less_text : more_text);
          $(this).toggleClass('less');
        });
        // Hover touch effects
        if (Modernizr.touch) {
          $('.touch_effect').click(function(e){
            if (!$(this).hasClass('hover')) {
              $(this).addClass('hover');
            }
          });
        } else {
          $('.touch_effect').mouseenter(function(){
            $(this).addClass('hover');
          })
          .mouseleave(function(){
            $(this).removeClass('hover');
          });
        }
        $.StickyFooter();
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
        $('.owl-carousel').owlCarousel({
          animateOut:         "fadeOut",
          animateIn:          "fadeIn",
          items:              1,
          loop:               true,
          margin:             0,
          nav:                true,
          navText:            ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
          dots:               true,
          dotsContainer:      '.dots-nav .dots',
          autoplay:           true
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };
  
  // Sticky Footer
  $.StickyFooter = function() {
    StickyFooter.init();
  };
  var StickyFooter = {
    init: function() {
      $footer = $('.content-info');
      var fh = $footer.outerHeight();
      var ft = ($(window).scrollTop() + $(window).height() - fh)+"px";
      StickyFooter.sticky($footer, fh, ft);
      $(window).resize(function() {
        StickyFooter.sticky($footer, fh, ft);
      });
      $(window).scroll(function() {
        StickyFooter.sticky($footer, fh, ft);
      });
    },
    sticky : function($footer, fh, ft) {
      if ( ($(document.body).height() + fh) < $(window).height()) {
        $footer.css({
          position: "absolute",
          top:      ft,
          left:     0,
          right:    0
        });
      } else {
        $footer.css({
          position: "static"
        });
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
