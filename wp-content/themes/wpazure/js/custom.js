(function($){

	// 01 - FIX HEADER ON SCROLL FUNCTION
	$(window).on('scroll', function(){
	    //if($(window).width() >= 991){
	    	if ($(window).scrollTop() >= 200) {
		       	$('.az-sticky').addClass('fixed-header animated fadeInDown');
		    }
		    else {
		       	$('.az-sticky').removeClass('fixed-header animated fadeInDown');
		    }
	    //}
	});
	
	
    $('.navbar-nav .dropdown a.dropdown-toggle').click(function( event ) {
        event.stopImmediatePropagation();
    });
    
    $('.navbar-nav .dropdown a.dropdown-toggle .fa-angle-down').on('click', function(e) {
        if (!$(this).parent().next().hasClass('show')) {
            $(this).parents('.dropdown-menu').next().first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).parent().next(".dropdown-menu");
        $subMenu.slideToggle("fast");

        $(this).parent().parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e){
            $('.dropdown-submenu .show').removeClass("show");
        });
        return false;
    });
	
})(jQuery)