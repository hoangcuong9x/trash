/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $, api ) {
	'use strict';

	// List of text elements that have postMessage transport.
	var texts = {
		blogname: '.site-title a',
		blogdescription: '.site-description',
		front_page_portfolio_title: '.portfolio.section h2',
		front_page_testimonial_title: '.testimonial.section h2',
		front_page_blog_title: '.blog.section h2',
		front_page_flourish_title: '.flourish.section h2'
	};

	// Live update the text elements.
	$.each( texts, function ( setting, selector ) {
		api( setting, function ( value ) {
			value.bind( function ( to ) {
				$( selector ).text( to );
			} );
		} );
	} );

	// Live update HTML content for Call to action elements.
	api( 'front_page_cta', function ( value ) {
		value.bind( function ( to ) {
			$( '.section.call-to-action' ).html( to );
		} );
	} );
} )( jQuery, wp.customize );
