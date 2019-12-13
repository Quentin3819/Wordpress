( function( $ ) {

  'use strict';

  function removeNoJsClass() {
    $( 'html:first' ).removeClass( 'no-js' );
  }

  /* Flexslider ---------------------*/
  function flexSliderSetup() {
    if( ($).flexslider) {
      var slider = $('.flexslider');
      slider.fitVids().flexslider({
        slideshowSpeed    : 12000,
        animationDuration  : 600,
        animation      : 'fade',
        video        : false,
        useCSS        : false,
        prevText      : '<i class="fa fa-angle-left"></i>',
        nextText      : '<i class="fa fa-angle-right"></i>',
        touch        : false,
        animationLoop    : true,
        smoothHeight    : true,
        controlsContainer  : ".slideshow",
        controlNav      : true,
        manualControls    : ".flex-control-nav li",

        start: function(slider) {
          slider.removeClass('loading');
          $( ".preloader" ).hide();
        }
      });
    }
  }

  function mobileMenuSetup() {
    $('.menu-toggle').click(function() {
      $('.navigation-main ul.menu').toggle();
    });
  }

  function subMenuSetup() {
    if ($("ul.sub-menu").css("display") == "none" ){
      // Toggle submenus
      var subMenuToggle = $('li.menu-item-has-children > a').unbind();
      subMenuToggle.on('click', function(e) {
        e.preventDefault();
        var submenu = $(this).parent().children('ul.sub-menu');
        if ($(submenu).is(':hidden')) {
          $(submenu).slideDown(200);
        } else {
          $(submenu).slideUp(200);
        }
      });
    }
  }

  function modifyPosts() {

    /* Insert Line Break Before More Links ---------------------*/
    $('<br />').insertBefore('.post-area .more-link');

    /* Hide Comments When No Comments Activated ---------------------*/
    $('.nocomments').parent().css('display', 'none');

    /* Animate Page Scroll ---------------------*/
    $(".scroll").click(function(event){
      event.preventDefault();
      $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    });

    /* Fit Vids ---------------------*/
    $('.feature-vid, .post-area').fitVids();

  }

  $(document)
  .ready(removeNoJsClass)
  .ready(modifyPosts)
  .on('post-load', modifyPosts);

  $(window)
  .load(flexSliderSetup)
  .load(mobileMenuSetup)
  .load(subMenuSetup)
  .resize(subMenuSetup);

})( jQuery );
