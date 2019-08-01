<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package eCommerce_Market
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ecommerce_market_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    if ( is_archive() ) {  
        $classes[] = 'thumbnail-view';
    }
  
    // Add class for global layout.
    $sidebar_layout = ecommerce_market_get_option( 'layout_options' ); 
    $sidebar_layout = apply_filters( 'ecommerce_market_filter_theme_global_layout', $sidebar_layout );
    $classes[] = 'global-layout-' . esc_attr( $sidebar_layout );    

	return $classes;
}
add_filter( 'body_class', 'ecommerce_market_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ecommerce_market_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ecommerce_market_pingback_header' );

if ( ! function_exists( 'ecommerce_market_the_excerpt' ) ) :

    /**
     * Generate excerpt.
     *
     * @since 1.0.0
     *
     * @param int     $length Excerpt length in words.
     * @param WP_Post $post_obj WP_Post instance (Optional).
     * @return string Excerpt.
     */
    function ecommerce_market_the_excerpt( $length = 0, $post_obj = null ) {

        global $post;

        if ( is_null( $post_obj ) ) {
            $post_obj = $post;
        }

        $length = absint( $length );

        if ( 0 === $length ) {
            return;
        }

        $source_content = $post_obj->post_content;

        if ( ! empty( $post_obj->post_excerpt ) ) {
            $source_content = $post_obj->post_excerpt;
        }

        $source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
        return $trimmed_content;

    }

endif;

function ecommerce_market_hex_color($color, $opacity = false) {
    $default = 'rgb(0,0,0)';    
    
    if (empty($color))
        return $default;    
 
    if ($color[0] == '#')
        $color = substr($color, 1);
    
    if (strlen($color) == 6)
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    
    elseif (strlen($color) == 3)
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    
    else
        return $default;
       
    $rgb = array_map('hexdec', $hex);    
 
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
 
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }    
    return $output;
}

/**
 *  Ecommerce Market Breadcrumb
 *
 *
 */
if ( ! function_exists( 'ecommerce_market_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     *
     * @link: https://gist.github.com/melissacabral/4032941
     *
     * @param  array $args Arguments
     */
    function ecommerce_market_breadcrumb( $args = array() ) {
        // Bail if Home Page.
        if ( is_front_page() || is_home() ) {
            return;
        }

        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            require_once trailingslashit(get_template_directory()) . '/inc/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );
       
    }

endif;

/**
 * Register the required plugins for this theme.
 * 
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function ecommerce_market_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'      => esc_html__( 'Woocommerce', 'ecommerce-market' ), //The plugin name
            'slug'      => 'woocommerce',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        
        array(
            'name'      => esc_html__( 'YITH WooCommerce Wishlist', 'ecommerce-market' ), //The plugin name
            'slug'      => 'yith-woocommerce-wishlist',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        array(
            'name'      => esc_html__( 'Contact Form 7', 'ecommerce-market' ), //The plugin name
            'slug'      => 'contact-form-7',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),        
        array(
            'name'      => esc_html__( 'One Click Demo Import', 'ecommerce-market' ), //The plugin name
            'slug'      => 'one-click-demo-import',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),         

    );

    $config = array(
        'id'           => 'ecommerce-market',        // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.     
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'ecommerce_market_register_required_plugins' );
