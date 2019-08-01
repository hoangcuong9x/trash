<?php
/**
 * TheFour functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TheFour
 */

if ( ! function_exists( 'thefour_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thefour_setup() {
		// Theme features.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'thefour-grid-thumbnail', 353, 203, true );

		set_post_thumbnail_size( 741, 293, true );

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
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'video',
			'quote',
			'audio',
		) );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Header', 'thefour-lite' ),
		) );

		// Make the theme translation ready.
		load_theme_textdomain( 'thefour-lite', get_template_directory() . '/languages' );
	}
endif;
add_action( 'after_setup_theme', 'thefour_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thefour_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thefour_content_width', 760 );
}
add_action( 'after_setup_theme', 'thefour_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thefour_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'thefour-lite' ),
		'description'   => esc_html__( 'Main sidebar that appears on the right.', 'thefour-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'thefour-lite' ),
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'thefour-lite' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="column one-fourth widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'thefour_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thefour_scripts() {
	wp_enqueue_style( 'thefour-fonts', thefour_google_fonts_url() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', '', '4.6.3' );
	wp_enqueue_style( 'thefour-lite', get_stylesheet_uri(), '', '1.0.1' );

	wp_enqueue_script( 'thefour-lite', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), wp_get_theme( 'thefour-lite' )->version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thefour_scripts' );

/**
 * Get Google Fonts URL.
 *
 * @return string
 */
function thefour_google_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'thefour-lite' ) ) {
		$fonts[] = 'Open+Sans:400,400italic,700,700italic';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Montserrat, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'thefour-lite' ) ) {
		$fonts[] = 'Montserrat:500';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'thefour-lite' );

	if ( 'cyrillic' === $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' === $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' === $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' === $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Add editor style.
 */
function thefour_add_editor_styles() {
	add_editor_style( array(
		'css/editor-style.css',
		thefour_google_fonts_url(),
		get_template_directory_uri() . '/css/font-awesome.css',
	) );
}
add_action( 'init', 'thefour_add_editor_styles' );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 *
 * @return array A new modified arguments.
 */
function thefour_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'thefour_widget_tag_cloud_args' );

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
require get_template_directory() . '/inc/customizer/sanitizer.php';
require get_template_directory() . '/inc/customizer/customizer.php';
$sanitizer  = new TheFour_Customize_Sanitizer;
$customizer = new TheFour_Customizer( $sanitizer );
$customizer->init();

/**
 * Load dashboard
 */
require get_template_directory() . '/inc/dashboard/class-thefour-lite-dashboard.php';
$dashboard = new TheFour_Lite_Dashboard();

require get_template_directory() . '/inc/customizer-pro/class-thefour-lite-customizer-pro.php';
$customizer_pro = new TheFour_Lite_Customizer_Pro();
$customizer_pro->init();
