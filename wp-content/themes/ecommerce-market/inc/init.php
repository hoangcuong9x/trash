<?php
/**
 * Load files.
 *
 * @package eCommerce_Market

 */

/**
 * Include default theme options.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/customizer/default.php';


/**
 * Load hooks.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/hook/structure.php';
require_once trailingslashit( get_template_directory() ) . 'inc/hook/basic.php';
require_once trailingslashit( get_template_directory() ) . 'inc/hook/custom.php';


/**
 * Implement the Custom Header feature.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/customizer.php';

/**
 * Ecommerce Market Functions related to WooCommerce.
 */
if ( ecommerce_market_is_woocommerce_active() ) {

	/**
	 * WooCommerce Function
	 */	
	require get_template_directory() . '/inc/woocommerce.php';

	/**
	 * Widget Function
	 */
	require_once trailingslashit( get_template_directory() ) . '/inc/widget/widget-init.php';
}


/**
 *  Rescent Post
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/latest-blog.php';

/**
 *  Testimonial Section
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/testimonial.php';

/**
 *  Promo Section
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/promo/promo-widget.php';

/**
 *  Recent Posts Section
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/recent-post-widget.php';

/**
 * Plugin Activation Section.
 */
require trailingslashit( get_template_directory() ) . '/inc/ecommerce-market-activation.php';

/**
 *  Demo Import Post
 */
require_once trailingslashit( get_template_directory() ) . '/demo-content/demo-import-setup.php';

