$=jQuery

jQuery(document).ready(function () {

    $('.featured-product-section h2').waypoint(
        function() {
          $('.featured-product-item').addClass('animated bounceInUp');
          $('.featured-slider').removeAttr('style');
          console.log('got it');
        }, 
        { 
          offset: '50%' 
        }
    );

   var gridItem = $('.main-product-wrap .product-item:first-child').width();
    //    option js
    $('.main-product-wrap').isotope({
      itemSelector: '.product-item',
      masonry: {
        columnWidth: 3
      }
    });

    $('.new-product-content-wrap').isotope({
      itemSelector: '.product-item',
      masonry: {
        columnWidth: 3
      }
    });
        /* search toggle */
    $('body').click(function(evt){
        if(!( $(evt.target).closest('.search-box').length || $(evt.target).hasClass('search-toggle') ) ){
            if ($(".search-toggle").hasClass("search-active")){
                $(".search-toggle").removeClass("search-active");
                $(".search-box").slideUp("slow");
            }
        }
      });
        $(".search-toggle").click(function(){
          $(".search-box").toggle("slow");
          if ( !$(".search-toggle").hasClass("search-active")){
           $(".search-toggle").addClass("search-active");

         }
         else{
          $(".search-toggle").removeClass("search-active");
        }
        
      });
        $(".toggle").click(function(){
          $(".top-header-menu-wrapper").slideToggle(767);
        });
        $(".toggle").click(function(){
          $(".toggle").toggleClass('close');         
        });



    jQuery('.menu-top-menu-container').meanmenu({
      meanMenuContainer: '.main-navigation',
      meanScreenWidth:"767",
      meanRevealPosition: "left",
    });         

    /* back-to-top button*/
    $('.back-to-top').hide();
    $('.back-to-top').on("click",function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });

        
    $(window).scroll(function(){
        var scrollheight =400;
        if( $(window).scrollTop() > scrollheight ) {
            $('.back-to-top').fadeIn();
        }
        else {
            $('.back-to-top').fadeOut();
        }
    });

    // for widget
    var owl1 = $("#secondary .featured-product-slider");
    owl1.owlCarousel({
        items:1,
        loop:$('#secondary .featured-product-slider .item').size() > 1 ? true:false,
        nav:true,
        dots:false,
        smartSpeed:1800,
        autoplay:true,
        autoplayTimeout:2900,
        fallbackEasing: 'easing',
        transitionStyle : "fade",
        autoplayHoverPause:true,
        responsive:{
            0:{
            items:1
            },
            580:{
            items:1
            },
            1000:{
            items:1
            }
        }
                      
    });


    // slider

    var owllogo = $("#owl-slider-demo");
        owllogo.owlCarousel({
        items:1,
        loop:$('#owl-slider-demo .item').size() > 1 ? true:false,
        nav:false,
        dots:true,
        smartSpeed:900,
        autoplay:true,
        autoplayTimeout:5000,
        fallbackEasing: 'easing',
        transitionStyle : "fade",
        autoplayHoverPause:true,
        animateOut: 'fadeOut'
    });


    var owl = $(".featured-product-slider");
    owl.owlCarousel({
        items:2,
        loop: $('.featured-product-slider .item').size() > 1 ? true:false,
        nav:true,
        dots:false,
        smartSpeed:1800,
        // autoplay:true,
        autoplayTimeout:2900,
        fallbackEasing: 'easing',
        transitionStyle : "fade",
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            580:{
                items:2
            },
            1000:{
                items:3
            },
            1200:{
                items:4
            }
        }

    });


    var owl = $(".main-product-slider");
    owl.owlCarousel({
        items:1,
        loop:$('.main-product-slider .item').size() > 1 ? true:false,
        nav:false,
        dots:true,
        smartSpeed:1400,
        autoplay:true,
        autoplayTimeout:1900,
        fallbackEasing: 'easing',
        transitionStyle : "fade",
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            580:{
                items:1
            },
            1000:{
                items:1
            }
        }

    });


    $('.play').on('click', function() {
        owl.trigger('play.owl.autoplay', [1000])
    })
    $('.stop').on('click', function() {
        owl.trigger('stop.owl.autoplay')
    })

           
    //      parallax
    $(function(){
        $.stellar({
            horizontalScrolling: false,
            verticalOffset: 40
        });
    });
    $("select").select2(
    {
        minimumResultsForSearch: -1
    }
    );

    $('.toogle-popup').on('click', function(evt){
        evt.preventDefault();
        $(this).siblings('.popup-wrapper').toggleClass('active');
    });

    $('span.close').on('click', function(evt){
        evt.preventDefault();
        $(this).closest('.popup-wrapper').toggleClass('active');
    })

    $(document).on('click', '.plus', function(e) {
        $input = $(this).prev('input.qty');
        var val = parseInt($input.val());
        var step = $input.attr('step');
        step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
        $input.val( val + step ).change();
    });

    $(document).on('click', '.minus', function(e) {
            $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            var step = $input.attr('step');
            step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
            if (val > 0) {
            $input.val( val - step ).change();
        } 
    });


    jQuery('.content-area, .widget-area').theiaStickySidebar({
        // Settings
        additionalMarginTop: 30
    });


              
});
