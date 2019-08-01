<?php
/**
 * Mudita functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mudita
 */

if ( ! function_exists( 'mudita_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mudita_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mudita, use a find and replace
	 * to change 'mudita' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mudita', get_template_directory() . '/languages' );
    
    // Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
    
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mudita' ),
        'secondary' => esc_html__( 'Secondary', 'mudita' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
        'gallery',
        'status',
        'audio',
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mudita_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    // Custom Image Sizes
    add_image_size( 'mudita-banner', 1920, 1023, true );
    add_image_size( 'mudita-featured', 280, 190, true );
    add_image_size( 'mudita-two-column', 960, 500, true );
    add_image_size( 'mudita-team', 356, 582, true );    
    add_image_size( 'mudita-blog', 380, 250, true );
    add_image_size( 'mudita-testimonial-big', 280, 441, true );
    add_image_size( 'mudita-testimonail-small', 268, 221, true );
    add_image_size( 'mudita-with-sidebar', 780, 400, true );
    add_image_size( 'mudita-without-sidebar', 1200, 400, true );
    add_image_size( 'mudita-featured-post', 330, 218, true );
    add_image_size( 'mudita-recent-post', 70, 70, true );
    
    /* Custom Logo */
    add_theme_support( 'custom-logo', array(
    	'width'       => 180,
		'height'      => 42,
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
    /* WooCommerce compatible */
    add_theme_support( 'woocommerce' );
    
    if( class_exists( 'woocommerce' ) ) {
        global $woocommerce;
        
        if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );
        }    
    }
}
endif;
add_action( 'after_setup_theme', 'mudita_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mudita_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mudita_content_width', 780 );
}
add_action( 'after_setup_theme', 'mudita_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function mudita_template_redirect_content_width() {

	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = mudita_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1200;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1200;
	}

}
add_action( 'template_redirect', 'mudita_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mudita_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'mudita' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'mudita' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'mudita' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'mudita' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'mudita' ),
		'id'            => 'footer-four',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mudita_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mudita_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    $mudita_query_args = array(
		'family' => 'Source+Sans+Pro:400,400italic,600,700,300',
	);
    wp_enqueue_style( 'mudita-google-fonts', add_query_arg( $mudita_query_args, "//fonts.googleapis.com/css" ) );

    wp_enqueue_style( 'mudita-sidr-style', get_template_directory_uri() . '/css' . $build . '/jquery.sidr.light' . $suffix . '.css' );
    //wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
    wp_enqueue_style( 'mudita-owl-carousel-style', get_template_directory_uri() . '/css' . $build . '/owl.carousel' . $suffix . '.css' );
    wp_enqueue_style( 'mudita-scrollbar-style', get_template_directory_uri() . '/css' . $build . '/jquery.mCustomScrollbar' . $suffix . '.css' );
    wp_enqueue_style( 'mudita-meanmenu-style', get_template_directory_uri() . '/css' . $build . '/meanmenu' . $suffix . '.css' );
    wp_enqueue_style( 'mudita-style', get_stylesheet_uri() );
    
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.2.0', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.2.0', true );
    wp_enqueue_script( 'mudita-meanmenu', get_template_directory_uri() . '/js' . $build . '/jquery.meanmenu' . $suffix . '.js', array('jquery'), '2.0.8', true );
    wp_enqueue_script( 'mudita-ie', get_template_directory_uri() . '/js' . $build . '/ie' . $suffix . '.js', array('jquery'), '3.7.2', true );
	wp_enqueue_script( 'mudita-sidr', get_template_directory_uri() . '/js' . $build . '/jquery.sidr' . $suffix . '.js', array('jquery'), '20160119', true );
    wp_enqueue_script( 'mudita-owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array('jquery'), '2.0.0', true );
    wp_enqueue_script( 'mudita-scrollbar', get_template_directory_uri() . '/js' . $build . '/jquery.mCustomScrollbar' . $suffix . '.js', array('jquery'), '3.1.5', true );
    wp_register_script( 'mudita-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), '20160119', true );

     $array = array(
        'rtl' => is_rtl(),
    );
    
    wp_localize_script( 'mudita-custom', 'mudita_data', $array );
    wp_enqueue_script( 'mudita-custom' );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'mudita_scripts' );

/**
 * Enqueue Admin Scripts
*/
function mudita_admin_scripts(){
    wp_enqueue_style( 'mudita-admin-style', get_template_directory_uri() . '/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'mudita_admin_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Meta Box
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Widget Featured Post
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Widget Recent Post
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Widget Popular Post
 */
require get_template_directory() . '/inc/widget-popular-post.php';
/**
 * Recent Post Widget
 */
require get_template_directory() . '/inc/info.php';
/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';