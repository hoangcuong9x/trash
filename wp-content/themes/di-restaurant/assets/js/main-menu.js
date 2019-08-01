( function( $ ) {
	$(document).ready(function() {
		
		// Nav Main DD Toggle
		$( ".navbarprimary .dropdowntoggle" ).click(function() {
			if( $(this).parent('li').hasClass('navbarprimary-open') ) {
				$(this).parent('li').removeClass('navbarprimary-open');
			} else {
				$(this).parent('li').addClass('navbarprimary-open');
			}

			if( $(this).children('span').hasClass('fa-chevron-circle-down') ) {
				$(this).children('span').removeClass('fa-chevron-circle-down');
				$(this).children('span').addClass('fa-chevron-circle-right');
			} else {
				$(this).children('span').removeClass('fa-chevron-circle-right');
				$(this).children('span').addClass('fa-chevron-circle-down');
			}
			
			return false;
		});

		// Sticky nav bar
		var h = $('.navbarprimary').offset().top;
		$(window).scroll(function () {
			if( $(this).scrollTop() > h ) {
				$('.navbarprimary').addClass('sticky_menu_top');
			} else {
				$('.navbarprimary').removeClass('sticky_menu_top');
			}
			
		});

	});
} )( jQuery );
