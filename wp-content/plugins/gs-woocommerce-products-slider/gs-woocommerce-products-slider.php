<?php
// error_reporting(E_ALL);
/**
 *
 * @package   GS_WooCommerce_Products_Slider
 * @author    Golam Samdani <samdani1997@gmail.com>
 * @license   GPL-2.0+
 * @link      https://www.gsamdani.com
 * @copyright 2015 Golam Samdani
 *
 * @wordpress-plugin
 * Plugin Name:			GS WooCommerce Products Slider Lite
 * Plugin URI:			https://www.gsamdani.com/wordpress-plugins
 * Description:       	Best Responsive WooCommerce Products Slider plugin for your Wordpress store. Display anywhere at your site using shortcode like [gs_wps] Check more shortcode examples and documention at <a href="http://wooprod.gsamdani.com">GS WooCommerce Products Slider</a> 
 * Version:           	1.5
 * Author:       		Golam Samdani
 * Author URI:       	https://www.gsamdani.com
 * Text Domain:       	gswps
 * License:           	GPL-2.0+
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! defined( 'GSWPS_HACK_MSG' ) ) define( 'GSWPS_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gswps' ) );

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSWPS_HACK_MSG );

/**
 * Defining constants
 */
if( ! defined( 'GSWPS_VERSION' ) ) define( 'GSWPS_VERSION', '1.5' );
if( ! defined( 'GSWPS_MENU_POSITION' ) ) define( 'GSWPS_MENU_POSITION', 31 );
if( ! defined( 'GSWPS_PLUGIN_DIR' ) ) define( 'GSWPS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'GSWPS_PLUGIN_URI' ) ) define( 'GSWPS_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'GSWPS_FILES_DIR' ) ) define( 'GSWPS_FILES_DIR', GSWPS_PLUGIN_DIR . 'gswps-files' );
if( ! defined( 'GSWPS_FILES_URI' ) ) define( 'GSWPS_FILES_URI', GSWPS_PLUGIN_URI . '/gswps-files' );

require_once GSWPS_FILES_DIR . '/gs-plugins/gs-plugins.php';
require_once GSWPS_FILES_DIR . '/gs-plugins/gs-plugins-free.php';
require_once GSWPS_FILES_DIR . '/gs-plugins/gs-wps-help.php';
require_once GSWPS_FILES_DIR . '/gswps-admin/class.settings-api.php';
require_once GSWPS_FILES_DIR . '/gswps-admin/gs_wps_options_config.php';
require_once GSWPS_FILES_DIR . '/gs-wps-shortcode.php';
require_once GSWPS_FILES_DIR . '/gs-wps-script.php';
require_once GSWPS_FILES_DIR . '/gs-wps-style-swither.php';
require_once GSWPS_FILES_DIR . '/gs-wps-media-button.php';
require_once GSWPS_FILES_DIR . '/gs-wps-media-modal.php';

if ( ! function_exists('gs_wps_pro_link') ) {
	function gs_wps_pro_link( $gsWps_links ) {
		$gsWps_links[] = '<a class="gs-pro-link" href="https://www.gsamdani.com/product/gs-woocommerce-product-slider" target="_blank">Go Pro!</a>';
		$gsWps_links[] = '<a href="https://www.gsamdani.com/wordpress-plugins" target="_blank">GS Plugins</a>';
		return $gsWps_links;
	}
	add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_wps_pro_link' );
}

function gs_is_wc_active() {
	return class_exists( 'WooCommerce' );
}

function gs_wc_requirement_notice() {
				
	if ( ! gs_is_wc_active() ) {
		
		$class = 'notice notice-error';
		
		$text    = esc_html__( 'WooCommerce', 'gswps' );
		$link    = esc_url( add_query_arg( array(
			                                   'tab'       => 'plugin-information',
			                                   'plugin'    => 'woocommerce',
			                                   'TB_iframe' => 'true',
			                                   'width'     => '640',
			                                   'height'    => '500',
		                                   ), admin_url( 'plugin-install.php' ) ) );
		$message = wp_kses( __( "<strong>GS WooCommerce Products Slider</strong> is an add-on of ", 'gswps' ), array( 'strong' => array() ) );
		
		printf( '<div class="%1$s"><p>%2$s <a class="thickbox open-plugin-details-modal" href="%3$s"><strong>%4$s</strong></a></p></div>', $class, $message, $link, $text );
	}
}

add_action( 'admin_notices',  'gs_wc_requirement_notice'  );


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_gs_woocommerce_products_slider() {

    if ( ! class_exists( 'AppSero\Insights' ) ) {
        require_once GSWPS_FILES_DIR . '/client-wpsp/src/insights.php';
    }

    $insights = new AppSero\Insights( '2156b216-b37e-4d27-9d22-a51ff9d88fc8', 'GS WooCommerce Products Slider', __FILE__ );
    $insights->init_plugin();
}

add_action( 'init', 'appsero_init_tracker_gs_woocommerce_products_slider' );

/**
 * Activation redirects
 *
 * @since v1.0.0
 */
function GSWPS_activate() {
    add_option('GSWPS_activation_redirect', true);
}
register_activation_hook(__FILE__, 'GSWPS_activate');

/**
 * Redirect to options page
 *
 * @since v1.0.0
 */
function GSWPS_redirect() {
    if (get_option('GSWPS_activation_redirect', false)) {
        delete_option('GSWPS_activation_redirect');
        if(!isset($_GET['activate-multi'])) {
            wp_redirect("admin.php?page=gs-wps-help");
        }
    }
}
add_action('admin_init', 'GSWPS_redirect');


/**
 * @review_dismiss()
 * @review_pending()
 * @GSWPS_review_notice_message()
 * Make all the above functions working.
 */
function GSWPS_review_notice(){

    GSWPS_review_dismiss();
    GSWPS_review_pending();

    $activation_time    = get_site_option( 'GSWPS_active_time' );
    $review_dismissal   = get_site_option( 'GSWPS_review_dismiss' );
    $maybe_later        = get_site_option( 'GSWPS_maybe_later' );

    if ( 'yes' == $review_dismissal ) {
        return;
    }

    if ( ! $activation_time ) {
        add_site_option( 'GSWPS_active_time', time() );
    }
    
    $daysinseconds = 259200; // 3 Days in seconds.
   
    if( 'yes' == $maybe_later ) {
        $daysinseconds = 604800 ; // 7 Days in seconds.
    }

    if ( time() - $activation_time > $daysinseconds ) {
        add_action( 'admin_notices' , 'GSWPS_review_notice_message' );
    }
}
add_action( 'admin_init', 'GSWPS_review_notice' );

/**
 * For the notice preview.
 */
function GSWPS_review_notice_message(){
    $scheme      = (parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY )) ? '&' : '?';
    $url         = $_SERVER['REQUEST_URI'] . $scheme . 'GSWPS_review_dismiss=yes';
    $dismiss_url = wp_nonce_url( $url, 'GSWPS-review-nonce' );

    $_later_link = $_SERVER['REQUEST_URI'] . $scheme . 'GSWPS_review_later=yes';
    $later_url   = wp_nonce_url( $_later_link, 'GSWPS-review-nonce' );
    ?>
    
    <div class="gslogo-review-notice">
        <div class="gslogo-review-thumbnail">
            <img src="<?php echo plugins_url('gs-woocommerce-products-slider/gswps-files/gswps-admin/img/icon-128x128.png') ?>" alt="">
        </div>
        <div class="gslogo-review-text">
            <h3><?php _e( 'Leave A Review?', 'gswps' ) ?></h3>
            <p><?php _e( 'We hope you\'ve enjoyed using <b>GS WooCommerce Product Slider</b>! Would you consider leaving us a review on WordPress.org?', 'gswps' ) ?></p>
            <ul class="gslogo-review-ul">
                <li>
                    <a href="https://wordpress.org/support/plugin/gs-woocommerce-products-slider/reviews" target="_blank">
                        <span class="dashicons dashicons-external"></span>
                        <?php _e( 'Sure! I\'d love to!', 'gswps' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $dismiss_url ?>">
                        <span class="dashicons dashicons-smiley"></span>
                        <?php _e( 'I\'ve already left a review', 'gswps' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $later_url ?>">
                        <span class="dashicons dashicons-calendar-alt"></span>
                        <?php _e( 'Maybe Later', 'gswps' ) ?>
                    </a>
                </li>
                <li>
                    <a href="https://www.gsamdani.com/support/" target="_blank">
                        <span class="dashicons dashicons-sos"></span>
                        <?php _e( 'I need help!', 'gswps' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $dismiss_url ?>">
                        <span class="dashicons dashicons-dismiss"></span>
                        <?php _e( 'Never show again', 'gswps' ) ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <?php
}

/**
 * For Dismiss! 
 */
function GSWPS_review_dismiss(){

    if ( ! is_admin() ||
        ! current_user_can( 'manage_options' ) ||
        ! isset( $_GET['_wpnonce'] ) ||
        ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'GSWPS-review-nonce' ) ||
        ! isset( $_GET['GSWPS_review_dismiss'] ) ) {

        return;
    }

    add_site_option( 'GSWPS_review_dismiss', 'yes' );   
}

/**
 * For Maybe Later Update.
 */
function GSWPS_review_pending() {

    if ( ! is_admin() ||
        ! current_user_can( 'manage_options' ) ||
        ! isset( $_GET['_wpnonce'] ) ||
        ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'GSWPS-review-nonce' ) ||
        ! isset( $_GET['GSWPS_review_later'] ) ) {

        return;
    }
    // Reset Time to current time.
    update_site_option( 'GSWPS_active_time', time() );
    update_site_option( 'GSWPS_maybe_later', 'yes' );
}

/**
 * Remove Reviews Metadata on plugin Deactivation.
 */
function GSWPS_deactivate() {
    delete_option('GSWPS_active_time');
    delete_option('GSWPS_maybe_later');
}
register_deactivation_hook(__FILE__, 'GSWPS_deactivate');


/**
 * Admin Notice
 */
function gswps_admin_notice() {
  if ( current_user_can( 'install_plugins' ) ) {
    global $current_user ;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if ( ! get_user_meta($user_id, 'gswps_ignore_notice279') ) {
      echo '<div class="gstesti-admin-notice updated" style="display: flex; align-items: center; padding-left: 0; border-left-color: #EF4B53"><p style="width: 32px;">';
      echo '<img style="width: 100%; display: block;"  src="' . plugins_url('gs-woocommerce-products-slider/gswps-files/gswps-admin/img/icon-128x128.png'). '" ></p><p> ';
      printf(__('<strong>GS WooCommerce Products Slider</strong> now powering huge websites. Use the coupon code <strong>ENJOY25P</strong> to redeem a <strong>25&#37; </strong> discount on Pro. <a href="https://www.gsamdani.com/product/gs-woocommerce-product-slider/" target="_blank" style="text-decoration: none;"><span class="dashicons dashicons-smiley" style="margin-left: 10px;"></span> Apply Coupon</a>
        <a href="%1$s" style="text-decoration: none; margin-left: 10px;"><span class="dashicons dashicons-dismiss"></span> I\'m good with free version</a>'),  admin_url( 'admin.php?page=gs-wps-help&gswps_nag_ignore=0' ));
      echo "</p></div>";
    }
  }
}
add_action('admin_notices', 'gswps_admin_notice');

/**
 * Nag Ignore
 */
function gswps_nag_ignore() {
  global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['gswps_nag_ignore']) && '0' == $_GET['gswps_nag_ignore'] ) {
             add_user_meta($user_id, 'gswps_ignore_notice279', 'true', true);
  }
}
add_action('admin_init', 'gswps_nag_ignore');