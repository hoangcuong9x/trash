<?php
/**
 * The Loader Class
 *
 * @package Woo_Quick_View
 *
 * @since 1.0
 */
class SP_WQV_Loader {

	public function __construct() {
		require_once( SP_WQV_PATH . 'public/views/scripts.php' );
		require_once( SP_WQV_PATH . 'public/views/shortcode.php' );
	}
}

new SP_WQV_Loader();
