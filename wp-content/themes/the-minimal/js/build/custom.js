jQuery(document).ready(function ($) {
    
    /** Variables from Customizer for Slider settings */
    var slider_auto, slider_loop, slider_control, slider_thumb;
    
    if( the_minimal_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( the_minimal_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( the_minimal_data.control == '1' ){
        slider_control = true;
    }else{
        slider_control = false;
    }
    
    if( the_minimal_data.thumbnail == '1' ){
        slider_thumb = "thumbnails";
    }else{
        slider_thumb = false;
    }
    
    if( the_minimal_data.mode == 'slide' ){
        var animation = '';
    }else{
        var animation = 'fadeOut';
    }
    console.log( animation );
    /** Home Page Slider */
    $('.flexslider .slides').owlCarousel({
        items           : 1,
        autoplay        : slider_auto,
        loop            : slider_loop,
        nav             : slider_control,
        animateOut      : animation,
        dots            : false,
        thumbs          : true,
        thumbImage      : true,
        thumbContainerClass     : 'owl-thumbs',
        thumbItemClass  : 'owl-thumb-item',
        smartSpeed      : the_minimal_data.speed,
    });

    //mobile-menu
    $('.btn-menu-opener').click(function(){
        $('body').addClass('menu-open');

        $('.btn-close-menu').click(function(){
            $('body').removeClass('menu-open');
        });

    });

    $('.overlay').click(function(){
        $('body').removeClass('menu-open');
    });

    $('.mobile-menu').prepend('<div class="btn-close-menu"></div>');

    $('.mobile-main-navigation ul .menu-item-has-children').append('<div class="angle-down"></div>');

    $('.mobile-secondary-menu ul .menu-item-has-children').append('<div class="angle-down"></div>');

    $('.mobile-main-navigation ul li .angle-down').click(function(){
        $(this).prev().slideToggle();
        $(this).toggleClass('active');
    });

    $('.mobile-secondary-menu ul li .angle-down').click(function(){
        $(this).prev().slideToggle();
        $(this).toggleClass('active');
    });
        
});
