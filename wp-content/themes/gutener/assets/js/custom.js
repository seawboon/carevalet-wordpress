;(function( $ ){

// Slick Nav

function slickNavHeight (){
  var headerHeight = $( '.site-header-primary .main-header' ).outerHeight();
  var headerHeight = $( '.site-header-two' ).outerHeight();
  $('.slicknav_nav').css( 'top', headerHeight );
}

jQuery( document ).ready( function(){
 /**
  * Offcanvs Menu
  * @since Gutener 1.0.0
  */
  $( document ).on( 'click', '.offcanvas-menu-toggler, .close-offcanvas-menu button, .offcanvas-overlay', function( e ){
    e.preventDefault();
    $( 'body' ).toggleClass( 'offcanvas-slide-open' );
    $( '.offcanvas-menu-toggler' ).focus();
  });
  $( '.close-offcanvas-menu button' ).click( function(){
    $( '.offcanvas-menu-toggler' ).focus();
  });

  jQuery( 'body' ).append( '<div class="offcanvas-overlay"></div>' );
    var width = $( window ).width();
    if( GUTENER.is_admin_bar_showing && width >= 782 ){
      $( '.site-header, #offcanvas-menu' ).css({
        top : 32
      });
    }else if( GUTENER.is_admin_bar_showing && width <= 781 ){
      $( '.site-header, #offcanvas-menu' ).css({
        top : 46
      });
    };
 
    // Desktop Hamburger Nav on focus out event
    body = jQuery( document.body );
    jQuery( window )
      .on( 'resize.GUTENER load.GUTENER', function() {
        jQuery('.offcanvas-menu-wrap').on('focusout', function () {
          var $elem = jQuery(this);
          // let the browser set focus on the newly clicked elem before check
          setTimeout(function () {
            if ( ! $elem.find(':focus').length ) {
              jQuery( '.offcanvas-menu-toggler' ).trigger('click');
              $( '.offcanvas-menu-toggler' ).focus();
            }
          }, 0);
        });
       jQuery('.close-offcanvas-menu button').on('focusout', function (event) {
          event.stopPropagation();
       });
    } );

  /**
 * Header Search from
 * @since Gutener 1.0.0
 */

  $(document).on( "click",'.search-icon, .close-button', function(){
    $( ".header-search" ).toggleClass("search-in");
    $( ".header-search input" ).focus();
  });

  // search toggle on focus out event
  jQuery( document ).ready( function() {
    body = jQuery( document.body );
    jQuery( window )
      .on( 'load.GUTENER resize.GUTENER', function() {
        jQuery('.header-search form').on('focusout', function () {
          var $elem = jQuery(this);
            // let the browser set focus on the newly clicked elem before check
            setTimeout(function () {
                if ( ! $elem.find(':focus').length ) {
                  jQuery( '.search-icon' ).trigger('click');
                  $( ".search-icon" ).focus();
                }
            }, 0);
        });
    } );
  });

  /**
   * Back to top
   * @since Gutener 1.0.0
   */

  $(window).on( 'scroll' , function(){
      if( GUTENER.disable_scroll_top == false && $(window).scrollTop() > 200 ){
          $("#back-to-top").fadeIn(200);
      } else{
          $("#back-to-top").fadeOut(200);
      }
  });

  $(document).on("click",'#back-to-top a', function() {
      $('html, body').animate({ scrollTop: 0 }, 800);
      return false;
  }); 

  /**
   * Header Top Position
   * @since Gutener 1.0.0
   */

  $notificationHight = $( '.notification-bar' ).outerHeight();
  if( GUTENER.fixed_notification && GUTENER.is_admin_bar_showing && width >= 782 ){
     $( '.notification-bar' ).css({
       top : 32
     });
     if ( $('.home .site-header').hasClass( 'header-three' )) {
       $( '.overlay-header' ).css( 'top' , $notificationHight + 32 );
     }
  }else if( !GUTENER.fixed_notification ){
    if ( $('.home .site-header').hasClass( 'header-three' )) {
      $( '.overlay-header' ).css( 'top' , $notificationHight + 32 );
    }
  }else if( GUTENER.fixed_notification ){
    if ( $('.home .site-header').hasClass( 'header-three' )) {
      $( '.overlay-header' ).css( 'top' , $notificationHight );
    }
  }
  if( !GUTENER.fixed_notification ){
    if ( $('.home .site-header').hasClass( 'header-three' )) {
      $( '.overlay-header' ).css( 'top' , $notificationHight );
    }
  }
  if( !GUTENER.fixed_notification && GUTENER.is_admin_bar_showing ){
    if ( $('.home .site-header').hasClass( 'header-three' )) {
      $( '.overlay-header' ).css( 'top' , $notificationHight + 46 );
    }
  }

  /**
   * Sticky header
   * @since Gutener 1.0.0
   */

  $mastheadHeight = $( '#masthead.site-header' ).outerHeight();
  $stickymastheadHeight = $( '#masthead .overlay-header' ).outerHeight();

  $( window ).scroll( function() {
    if ( $mastheadHeight > $(window).scrollTop() || $(window).scrollTop() == 0 ) {
        if ( GUTENER.fixed_nav && $('#masthead.site-header').hasClass('sticky-header')) {
            $('#masthead.site-header').removeClass('sticky-header');
            if( GUTENER.fixed_notification ){
              $( '.fixed-header' ).css( 'marginTop' , 0 );
            }
        }
    } 
    else if ( GUTENER.fixed_nav && !$( '#masthead.site-header' ).hasClass( 'sticky-header' )  ){
       $width = $( window ).width();
        $( '#masthead.site-header').addClass('sticky-header').fadeIn();
        if( GUTENER.fixed_notification ){
          $( '.fixed-header' ).css( 'marginTop' , $notificationHight );
        }
        if( GUTENER.fixed_notification && $width <= 767 ){
          $( '.fixed-header' ).css( 'marginTop' , 0 );
        }
        if( GUTENER.fixed_notification && GUTENER.is_admin_bar_showing && width >= 782 ){
           $( '.fixed-header' ).css( 'marginTop' , $notificationHight );
        }
    }
    if( GUTENER.fixed_nav && GUTENER.is_admin_bar_showing && width >= 782 ){
      if( $( '#masthead.site-header' ).hasClass( 'sticky-header' ) ){
        $( '.fixed-header' ).css( 'top' , 32 );
      }else {
        $( '.fixed-header' ).css( 'top' , 0 );
      }
    }
  });

  if ( $('.site-header').hasClass('header-three')) {
    $( '.section-banner .banner-content' ).css( 'marginTop' , $stickymastheadHeight );
  }

  /**
  * theiaStickySidebar
  * @since Gutener 1.0.0
  */
  if( GUTENER.sticky_sidebar ){
    $('.content-area, #secondary.left-sidebar, #secondary.right-sidebar').theiaStickySidebar({
      // Settings
      additionalMarginTop: 30,
    });
  }

  /**
  * Header Image Slider
   * @since Gutener 1.0.0
   */

  $('.header-image-slider').slick({
      dots: true,
      adaptiveHeight: false,
      fade: GUTENER.header_image_slider.fade,
      speed: parseInt( GUTENER.header_image_slider.fadeControl ),
      cssEase: 'linear',
      autoplay: GUTENER.header_image_slider.autoplay,
      autoplaySpeed: GUTENER.header_image_slider.autoplaySpeed,
      infinite: true,
      prevArrow: $('.header-slider-prev'),
      nextArrow: $('.header-slider-next'),
      rows: 0,
    });
  $('.header-image-slider').attr('dir', 'ltr');

  /**
  * Main Slider
   * @since Gutener 1.0.0
   */

  $('.main-slider').slick({
    dots: true,
    adaptiveHeight: false,
    fade: GUTENER.main_slider.fade,
    speed: parseInt( GUTENER.main_slider.fadeControl ),
    cssEase: 'linear',
    autoplay: GUTENER.main_slider.autoplay,
    autoplaySpeed: GUTENER.main_slider.autoplaySpeed,
    infinite: true,
    prevArrow: $('.prev'),
    nextArrow: $('.next'),
    rows: 0,
  });
  $('.main-slider').attr('dir', 'ltr');

  /**
   * Slicknav - a Mobile Menu
   * @since Gutener 1.0.0
   */
  $('#primary-menu').slicknav({
      duration: 500,
      closedSymbol: '<i class="fa fa-plus"></i>',
      openedSymbol: '<i class="fa fa-minus"></i>',
      prependTo: '#slicknav-mobile',
      allowParentLinks: true,
      nestedParentLinks : false,
      label:"", 
      closeOnClick: true, // Close menu when a link is clicked.
  });

// Mobile Nav on focus out event
  jQuery( document ).ready( function() {
    body = jQuery( document.body );
    jQuery( window )
      .on( 'load.GUTENER resize.GUTENER', function() {
      jQuery('.slicknav_menu .slicknav_nav').on('focusout', function () {
          var $elem = jQuery(this);

          // let the browser set focus on the newly clicked elem before check
          setTimeout(function () {
            if ( ! $elem.find(':focus').length ) {
              jQuery( '.slicknav_btn' ).trigger('click');
            }
          }, 0);
        });
    } );
  });

  slickNavHeight();

  /**
   * Feature Posts Slider
   * @since Gutener 1.0.0
   */

  $('.feature-post-slider').slick({
      dots: true,
      slidesToShow: GUTENER.home_feature_posts.slidesToShow,
      slidesToScroll: 1,
      adaptiveHeight: false,
      autoplay: GUTENER.home_feature_posts.autoplay,
      autoplaySpeed: GUTENER.home_feature_posts.autoplaySpeed,
      infinite: false,
      rows: 0,
      prevArrow: $('.feature-posts-prev'),
      nextArrow: $('.feature-posts-next'),
      responsive: [
        {
          breakpoint: 1023,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  $('.feature-post-slider').attr('dir', 'ltr');

});

jQuery( window ).resize(function(){
  slickNavHeight();
});

jQuery( window ).load( function(){

 /**
 * Back to top
 * @since Gutener 1.0.0
 */
  if( GUTENER.enable_scroll_top == true && $(window).scrollTop() > 200 ){
    $("#back-to-top").fadeIn(200);
  } else{
    $("#back-to-top").fadeOut(200);
  }

  /**
   * Slider Controls
   * @since Gutener 1.0.0
   */

  if( GUTENER.disable_header_slider_dots == true ){
   $( '.header-image-slider .slick-dots').css({
     display: 'none'
   });
  }

  if( GUTENER.disable_slider_dots == true ){
    $( '.section-banner .slick-dots').css({
      display: 'none'
    });
  }

  if( GUTENER.disable_feature_posts_dots == true ){
    $( '.section-feature-post .slick-dots').css({
      display: 'none'
    });
  }

  /**
   * Site Preloader
   * @since Gutener 1.0.0
   */
  $( '#site-preloader' ).fadeOut( 500 );

  /**
  * Make sure if the masonry wrapper exists
  */
  if( jQuery( '.masonry-wrapper' ).length > 0 ){
    $grid = jQuery( '.masonry-wrapper' ).masonry({
      itemSelector: '.grid-post',
      // percentPosition: true,
      isAnimated: true,
    }); 
  }

  /**
  * Make support for Jetpack's infinite scroll on masonry layout
  */
  infinite_count = 0;
    $( document.body ).on( 'post-load', function () {

    infinite_count = infinite_count + 1;
    var container = '#infinite-view-' + infinite_count;
    $( container ).hide();

    $( $( container + ' .grid-post' ) ).each( function(){
      $items = $( this );
        $grid.append( $items ).masonry( 'appended', $items );
    });

    setTimeout( function(){
      $grid.masonry('layout');
    },500);
    });
});

})( jQuery );