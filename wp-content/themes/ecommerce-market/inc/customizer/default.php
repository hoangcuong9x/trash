<?php
/**
 * Default theme options.
 *
 * @package eCommerce_Market
 */

if ( ! function_exists( 'ecommerce_market_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function ecommerce_market_get_default_theme_options() {

	$defaults = array();

	$defaults['site_identity']						= 'title-text';
	$defaults['search_in_header']					= true;
	$defaults['login_header']						= true;
	$defaults['cart_header']						= true; 
	$defaults['home_page_content']					= true;


	/******************** Featured Slider *************************/
	$defaults['featured_slider']					= true;
	$defaults['featured_slider_type']				= 'featured-category';
	$defaults['featured_slider_number']				= 2;
	$defaults['featured_category']					= 0;
	$defaults['featured_product_category']			= 0;
	$defaults['featured_slider_read_more_text']		= esc_html__( 'Read More', 'ecommerce-market' );
	$defaults['overlay_text']						= '';

	/******************** General Settings *************************/	
	$defaults['layout_options']						= 'right';
	$defaults['enable_shop_sidebar']				= true; 
	$defaults['archive_readmore']					= esc_html__( 'Details', 'ecommerce-market' );
	$defaults['pagination_option']					= 'default';
	$defaults['enable_breadcrumb']					= true;
	

	/*********************** Footer Setting *****************************************/
	$defaults['subscription_page']					= 0;
	$defaults['footer_address']						= '';
	$defaults['footer_number']						= '';
	$defaults['footer_email']						= '';
	$defaults['footer_social_icon']					= true; 
	$defaults['footer_logo']						= true; 
	$defaults['copyright_text']						= '';	
	
	// Pass through filter.
	$defaults = apply_filters( 'ecommerce_market_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'ecommerce_market_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function ecommerce_market_get_option( $key ) {

		$default_options = ecommerce_market_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;