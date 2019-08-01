<?php
/**
 * eCommerce Market Theme Customizer
 *
 * @package eCommerce_Market
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ecommerce_market_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Load Customize Sanitize.
	require get_template_directory() . '/inc/customizer/sanitize.php';

	// Load Customize Callback.
	require get_template_directory() . '/inc/customizer/callback.php';	

	// Load header Sections Option.
	require get_template_directory() . '/inc/customizer/theme-section.php';

	// Load Home Page Sections Option.
	require get_template_directory() . '/inc/customizer/home-section.php';	



	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ecommerce_market_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ecommerce_market_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'ecommerce_market_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ecommerce_market_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ecommerce_market_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ecommerce_market_customize_preview_js() {

	wp_enqueue_script( 'ecommerce-market-customizer', get_template_directory_uri() . '/assest/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ecommerce_market_customize_preview_js' );

/**
 *  Customizer Control 
 */
function ecommerce_market_customize_backend_scripts() {

	wp_enqueue_style( 'ecommerce-market-admin-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );
	
	wp_enqueue_script( 'ecommerce-market-admin-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-scipt.js', array( ), '20151215', true );
}
add_action( 'customize_controls_enqueue_scripts', 'ecommerce_market_customize_backend_scripts', 10 );
