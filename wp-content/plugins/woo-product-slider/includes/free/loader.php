<?php

/**
 * The Free Loader Class
 * @package woo-product-slider
 * @since 2.0
 */
class SP_WPS_Free_Loader {

	function __construct() {
		require_once( SP_WPS_PATH . "public/views/shortcoderender.php" );
		require_once( SP_WPS_PATH . "public/views/shortcode-deprecated.php" );
		require_once( SP_WPS_PATH . "public/views/scripts.php" );
		require_once( SP_WPS_PATH . "admin/views/scripts.php" );
		require_once( SP_WPS_PATH . "admin/views/mce-button.php" );
	}

}

new SP_WPS_Free_Loader();