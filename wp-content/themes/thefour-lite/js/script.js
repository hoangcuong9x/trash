/**
 * The main script file of the theme.
 *
 * @package TheFour
 */

jQuery( function ( $ ) {
	'use strict';

	/**
	 * Toggle mobile menu
	 */
	function toggleMobileMenu() {
		var $body = $( 'body' ),
			mobileClass = 'mobile-menu-open',
			clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click';

		// Click to show mobile menu.
		$( '.menu-toggle' ).on( clickEvent, function ( e ) {
			if ( $body.hasClass( mobileClass ) ) {
				return;
			}
			e.stopPropagation(); // Do not trigger click event on '.wrapper' below.
			$body.addClass( mobileClass );
		} );

		// When mobile menu is open, click on page content will close it.
		$( '.site' ).on( clickEvent, function ( e ) {
			if ( ! $body.hasClass( mobileClass ) ) {
				return;
			}
			e.preventDefault();
			$body.removeClass( mobileClass );
		} )
	}

	/**
	 * Resize videos to fit the container
	 */
	function resizeVideo() {
		$( '.hentry iframe, .hentry object, .hentry video, .widget-content iframe, .widget-content object, .widget-content iframe' ).each( function () {
			var $video = $( this ),
				$container = $video.parent(),
				containerWidth = $container.width(),
				$post = $video.closest( 'article' );

			if ( ! $video.data( 'origwidth' ) ) {
				$video.data( 'origwidth', $video.attr( 'width' ) );
				$video.data( 'origheight', $video.attr( 'height' ) );
			}
			var ratio = containerWidth / $video.data( 'origwidth' );
			$video.css( 'width', containerWidth + 'px' );

			// Only resize height for non-audio post format.
			if ( ! $post.hasClass( 'format-audio' ) ) {
				$video.css( 'height', $video.data( 'origheight' ) * ratio + 'px' );
			}
		} );
	}

	/**
	 * Skip link to content
	 *
	 * @link : https://github.com/Automattic/_s/blob/master/js/skip-link-focus-fix.js
	 */
	function skipLinkFocusFix() {
		var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > - 1,
			is_opera = navigator.userAgent.toLowerCase().indexOf( 'opera' ) > - 1,
			is_ie = navigator.userAgent.toLowerCase().indexOf( 'msie' ) > - 1;

		if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
			window.addEventListener( 'hashchange', function () {
				var id = location.hash.substring( 1 ),
					element;

				if ( ! (/^[A-z0-9_-]+$/.test( id )) ) {
					return;
				}

				element = document.getElementById( id );

				if ( element ) {
					if ( ! (/^(?:a|select|input|button|textarea)$/i.test( element.tagName )) ) {
						element.tabIndex = - 1;
					}

					element.focus();
				}
			}, false );
		}
	}

	toggleMobileMenu();
	resizeVideo();
	skipLinkFocusFix();
	$( window ).on( 'resize', resizeVideo );
} );
