<?php
/**
 * Just Read functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Justread
 */

if ( ! function_exists( 'justread_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function justread_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Just Read, use a find and replace
		 * to change 'justread' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'justread', get_template_directory() . '/languages' );

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
		add_image_size( 'justread-adjacent', 444, 230, true );
		set_post_thumbnail_size( 363, 188, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Header', 'justread' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'justread_custom_background_args',
				array(
					'default-color' => 'f5f7f8',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for editor style.
		add_editor_style();

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Add support for post formats.
		add_theme_support( 'post-formats', array( 'quote' ) );

		// Support Gutenberg.
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'justread_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function justread_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'justread_content_width', 960 );
}
add_action( 'after_setup_theme', 'justread_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function justread_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'justread' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears in the footer of the site.', 'justread' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'justread_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function justread_scripts() {
	wp_enqueue_style( 'justread-style', get_stylesheet_uri(), array(), '1.0.0' );

	wp_enqueue_script( 'justread-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );

	wp_enqueue_script( 'justread-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Scripts for sticky sharing icons. Applied only for single posts and icon style.
	if ( justread_is_sharing_icons_enabled() ) {
		wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/js/sticky-sidebar.js', array(), '3.2.0', true );
	}

	wp_enqueue_script( 'justread', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'justread_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG icons functions and filters.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( is_admin() ) {
	/**
	 * Load TGM Activation Class.
	 */
	require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/inc/admin/plugins.php';

	/**
	 * Load theme dashboard.
	 */
	require get_template_directory() . '/inc/dashboard/class-justread-dashboard.php';
	new Justread_Dashboard();
}

/**
 * Customizer Pro.
 */
require get_template_directory() . '/inc/customizer-pro/class-justread-customizer-pro.php';
$customizer_pro = new Justread_Customizer_Pro();
$customizer_pro->init();

