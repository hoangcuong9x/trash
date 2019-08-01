<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package TheFour
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function thefour_body_classes( $classes ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'thefour_body_classes' );


/**
 * Adds custom classes to the .site-branding if logo width is larger than 96px.
 *
 * @return string
 */
function thefour_logo_class() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( ! $custom_logo_id ) {
		return '';
	}

	$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	if ( is_array( $logo ) && isset( $logo[1] ) && 96 < $logo[1] ) {
		return ' site-branding--vertical';
	}

	return '';
}
