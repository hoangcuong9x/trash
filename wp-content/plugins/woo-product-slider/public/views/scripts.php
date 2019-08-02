<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }  // if direct access

/**
 * Scripts and styles
 */
class SP_WPS_Front_Scripts {

	/**
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * @return SP_WPS_Scripts
	 * @since 2.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
	}

	/**
	 * Plugin Scripts and Styles
	 *
	 */
	function front_scripts() {
		// CSS Files.
		wp_enqueue_style( 'sp-wps-slick', SP_WPS_URL . 'public/assets/css/slick.css', array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-font', SP_WPS_URL . 'public/assets/css/spfont.css', array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-style', SP_WPS_URL . 'public/assets/css/style.css', array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-style-dep', SP_WPS_URL . 'public/assets/css/style-deprecated.css', array(), SP_WPS_VERSION );

		// JS Files.
		wp_enqueue_script( 'sp-wps-slick-min-js', SP_WPS_URL . 'public/assets/js/slick.min.js', array( 'jquery' ), SP_WPS_VERSION, false );
		wp_enqueue_script( 'sp-wps-slick-config-js', SP_WPS_URL . 'public/assets/js/slick-config.js', array( 'sp-wps-slick-min-js' ), SP_WPS_VERSION, false );

	}

}
new SP_WPS_Front_Scripts();
