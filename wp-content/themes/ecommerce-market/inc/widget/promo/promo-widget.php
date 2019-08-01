<?php
/**
 * Plugin widgets.
 *
 * @package eCommerce_Market
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load widget.
require trailingslashit(get_template_directory()) . '/inc/widget/promo/inc/widget.php';

/**
 * Register widget.
 *
 * @since 1.0.0
 */
function ecommerce_market_promo_init() {

	register_widget( 'Ecommerce_Market_Promo' );

}
add_action( 'widgets_init', 'ecommerce_market_promo_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 *
 * @param string $hook Hook.
 */
function ecommerce_market_promo_scripts( $hook ) {

	if ( 'widgets.php' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'ecommerce_market-admin-css', get_template_directory_uri() . '/inc/widget/promo/css/admin.css', array(), '1.0.0' );

	wp_enqueue_media();

	wp_enqueue_script( 'ecommerce_market-admin-js', get_template_directory_uri() . '/inc/widget/promo/js/admin.js', array( 'jquery' ), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'ecommerce_market_promo_scripts' );
