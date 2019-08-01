<?php
/**
 * Callback functions for active_callback.
 *
 * @package eCommerce_Market
 */

if ( ! function_exists( 'ecommerce_market_featured_slider_active' ) ) :

	/**
	 * Check if featured product category slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function ecommerce_market_featured_slider_active( $control ) {

		if ( true == $control->manager->get_setting( 'theme_options[featured_slider]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'ecommerce_market_featured_category_slider_active' ) ) :

	/**
	 * Check if featured product category slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function ecommerce_market_featured_category_slider_active( $control ) {

		if ( 'featured-category' == $control->manager->get_setting( 'theme_options[featured_slider_type]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'ecommerce_market_featured_product_category_slider_active' ) ) :

	/**
	 * Check if featured product category slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function ecommerce_market_featured_product_category_slider_active( $control ) {

		if ( 'featured-product-category' == $control->manager->get_setting( 'theme_options[featured_slider_type]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;