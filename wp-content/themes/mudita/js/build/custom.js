jQuery(document).ready(function($) {
    
    $('#menu-button').sidr({
        name: 'button-main',
        source: '#site-navigation',
        side: 'right'
    });
    
    $('.top-menu').meanmenu({
        meanScreenWidth: "767",
        meanRevealPosition: "center"
    });
                
    // Owl Carousal for Team Section 
    var owl;    

    owl = $('#team-slider');
    
    owl.owlCarousel({ 
        center: true,
        loop: true,
        autoWidth: true,
        nav: true,
        dots: false,
        URLhashListener: true,
        mouseDrag: false,
        autoplay: false,
        autoplayTimeout: 10000,
        onTranslated: doTranslated,
        onInitialized: doInitialized,
        onResized: doResized,
    });

    function doInitialized(e){
        setTimeout(function(){ carousel = owl.data('owlCarousel');
        carousel.invalidate('all');
        carousel.refresh(); 
        jQuery(".owl-stage").addClass("nomargin");}, 0);        
    }
    function doResized(e){
    
    }
    function doTranslated(e){
        carousel = owl.data('owlCarousel');
        if (carousel._current==3){
            jQuery(".owl-stage").addClass("nomargin");
        } else {
            jQuery(".owl-stage").removeClass("nomargin");
        }
    }
    
    /** Arrow Down */
    $(".arrow-down").click(function() {
        $('html, body').animate({
            scrollTop: $("#next_section").offset().top
        }, 2000);
    });
    
    /* Custom Scroll Bar */
    $(".testimonial .testimonial-holder .col-right .text-holder").mCustomScrollbar({
     theme:"minimal"
    });

    $(".testimonial .testimonial-holder .col-left .text-holder").mCustomScrollbar({
     theme:"minimal"
    });
});