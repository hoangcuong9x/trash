<?php
/**
 * Plugin Name:		   TC  WooCommerce  Product Slider
 * Plugin URI:		   https://www.themescode.com/items/tc-woocommerce-product-slider-pro
 * Description:		   Woocommerce Product Slider Carousel is an easy product slider plugin to add Woocommerce Product slider and carousel in wordpress sites.This plugin is responsive and  works using shortcode .This plugin works based on Woocommerce plugin. It is easy to works with TC Product Slider plugin . just use the shortcode in any page/post where you want to display slider carousel of your products.
 * Version: 		    1.5
 * Author: 			  themesCode
 * Author URI: 		   https://www.themescode.com/items/tc-woocommerce-product-slider-pro
 * Text Domain:      tc-wps
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPL2
 */

// include files
include(plugin_dir_path( __FILE__ ).'/public/view.php');
include(plugin_dir_path( __FILE__ ).'/public/featured-view.php');
include(plugin_dir_path( __FILE__ ).'/lib/star.php');

function tc_woo_product_enqueue_scripts() {
   // Vendors style & scripts
     wp_enqueue_style('owl.carousel', plugins_url('vendors/owl-carousel/assets/owl.carousel.css', __FILE__ ));
     wp_enqueue_style( 'tcwps-style', plugins_url('assets/css/tc-wooslider.css', __FILE__ ) );
     wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
   //Plugin Main CSS File
     wp_enqueue_script('owl-carousel', plugins_url('vendors/owl-carousel/owl.carousel.min.js', __FILE__ ), array('jquery'), 1.0, true);
    // wp_enqueue_script('tcwps-js', plugins_url('assets/js/tcwps.js', __FILE__ ));

 }

add_action( 'wp_enqueue_scripts', 'tc_woo_product_enqueue_scripts' );

 function tc_woo_product_admin_style() {

  wp_enqueue_style( 'tc-wooslider-admin', plugins_url('assets/css/tc-wooslider-admin.css',__FILE__ ));

 }
 add_action( 'admin_enqueue_scripts', 'tc_woo_product_admin_style' );

 // adding setting options

 require_once dirname( __FILE__ ) . '/lib/class.settings-api.php';
 require_once dirname( __FILE__ ) . '/lib/tc-wooslider-settings.php';

 new TC_wooslider_Settings();


 // After Plugin Activation redirect


if( !function_exists( 'tc_after_activation_redirect' ) ){
  function tc_after_activation_redirect( $plugin ) {
      if( $plugin == plugin_basename( __FILE__ ) ) {
          exit( wp_redirect( admin_url( 'admin.php?page=tc_wps_carousel_menu_help' ) ) );
      }
  }
}
add_action( 'activated_plugin', 'tc_after_activation_redirect' );

//settings link

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'tc_plugin_action_links' );

function tc_plugin_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=tc-whooslider') ) .'">Settings</a>';
   $links[] = '<a href="https://www.themescode.com/items/category/wordpress-plugins" target="_blank">TC Plugins</a>';
   return $links;
}

function themescode_limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }


// Addind Submenu page

 function tc_wps_carousel_menu_help(){
   include('lib/tc-help-upgrade.php');
 }

 function tc_wps_carousel_menu_init()
   {

     add_submenu_page('tc-whooslider', __('Help & Upgrade','tc-wps'), __('Help & Upgrade','owl-carousel-wp'), 'manage_options', 'tc_wps_carousel_menu_help', 'tc_wps_carousel_menu_help');

   }

 add_action('admin_menu', 'tc_wps_carousel_menu_init');
