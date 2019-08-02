<?php
/**
 * This is to register the shortcode generator post type.
 * @package woo-product-slider
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class SP_WPS_ShortCodes {

	/**
	 * @var
	 */
	private static $_instance;

	/**
	 * @return SP_WPS_ShortCodes
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new SP_WPS_ShortCodes();
		}

		return self::$_instance;
	}

	/**
	 * SP_WPS_ShortCodes constructor.
	 */
	public function __construct() {
		add_filter( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * ShortCode generator post type.
	 */
	function register_post_type() {

		$labels = array(
			'name'               => __( 'Product Sliders', 'woo-product-slider' ),
			'singular_name'      => __( 'Product Slider', 'woo-product-slider' ),
			'menu_name'          => __( 'Product Slider', 'woo-product-slider' ),
			'all_items'          => __( 'Product Sliders', 'woo-product-slider' ),
			'add_new'            => __( 'Add New', 'woo-product-slider' ),
			'add_new_item'       => __( 'Add New Slider', 'woo-product-slider' ),
			'edit'               => __( 'Edit', 'woo-product-slider' ),
			'edit_item'          => __( 'Edit Slider', 'woo-product-slider' ),
			'new_item'           => __( 'Product Slider', 'woo-product-slider' ),
			'search_items'       => __( 'Search Product Sliders', 'woo-product-slider' ),
			'not_found'          => __( 'No Product Sliders found', 'woo-product-slider' ),
			'not_found_in_trash' => __( 'No Product Sliders in Trash', 'woo-product-slider' ),
			'parent'             => __( 'Parent Product Slider', 'woo-product-slider' ),
		);

		$args = array(
			'labels'          => $labels,
			'hierarchical'    => false,
			'description'     => __( 'Product Slider for WooCommerce', 'woo-product-slider' ),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => SP_WPS_URL . '/admin/assets/images/icon.png',
			'query_var'       => false,
			'capability_type' => 'post',
			'supports'        => array(
				'title'
			),
		);

		register_post_type( 'sp_wps_shortcodes', $args );
	}

}

new SP_WPS_ShortCodes();