<?php
/**
 * Bread and Cake functions and definitions
 *
 * @package Bread and Cake
 */

if ( ! function_exists( 'bread_and_cake_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function bread_and_cake_setup() {
	
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'bread-and-cake', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('bread-and-cake-homepage-thumb',true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bread-and-cake' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );
	add_editor_style( array( 'editor-style.css', bread_and_cake_font_url() ) );
}
endif; // bread_and_cake_setup
add_action( 'after_setup_theme', 'bread_and_cake_setup' );


function bread_and_cake_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'bread-and-cake' ),
		'description'   => __( 'Appears on blog page sidebar', 'bread-and-cake' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'bread_and_cake_widgets_init' );

function bread_and_cake_font_url(){
		$font_url = '';
		
		/* Translators: If there are any character that are
		* not supported by Lobster, translate this to off, do not
		* translate into your own language.
		*/
		$lobster = _x('on', 'Lobster font:on or off','bread-and-cake');
		
		/* Translators: If there are any character that are
		* not supported by Great Vibes, translate this to off, do not
		* translate into your own language.
		*/
		$gv = _x('on', 'Great Vibes font:on or off','bread-and-cake');
		
		/* Translators: If there are any character that are
		* not supported by Roboto, translate this to off, do not
		* translate into your own language.
		*/
		$robo = _x('on', 'Roboto font:on or off','bread-and-cake');
		
		
		
		if('off' !== $lobster || 'off' !== $gv || 'off' !== $robo){
			$font_family = array();

			if('off' !== $lobster){
				$font_family[] = 'Lobster:400,600,700';
			}
			
			if('off' !== $gv){
				$font_family[] = 'Great Vibes:400';
			}
			
			if('off' !== $robo){
				$font_family[] = 'Roboto:400';
			}
			
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'https://fonts.googleapis.com/css');
		}
		
	return $font_url;
	}

function bread_and_cake_scripts() {
	wp_enqueue_style( 'bread-and-cake-font', bread_and_cake_font_url(), array() );
	wp_enqueue_style( 'bread-and-cake-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bread-and-cake-responsive-style', get_template_directory_uri().'/css/theme-responsive.css' );
	wp_enqueue_style( 'nivo-style', get_template_directory_uri().'/css/nivo-slider.css');
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/css/font-awesome.css' );	
	wp_enqueue_script( 'jquery-nivo-slider-js', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'bread-and-cake-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bread_and_cake_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function bread_and_cake_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'bread_and_cake_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/*
 * Load customize pro
 */
require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );
