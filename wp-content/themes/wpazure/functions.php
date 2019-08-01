<?php
/**
 * wpazure functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpazure
*/
 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
*/
 
/**
 * Define Constants
*/
define( 'WPAZURE_THEME_VERSION', '1.1.3.2' );
define( 'WPAZURE_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'WPAZURE_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );


if(!function_exists('wpazure_setup')):
	function wpazure_setup()
	{
		 /**
		 * Make theme available for translation.
		 * Translations can be placed in the /languages/ directory.
		 */
		load_theme_textdomain( 'wpazure', WPAZURE_THEME_DIR . '/languages' );
		
		/**
		 * Load theme hooks
		 */
		require_once WPAZURE_THEME_DIR . 'inc/menu/class-wpazure-bootstrap-navwalker.php';
		
		// woocommerce support
		add_theme_support( 'woocommerce' );
		
		/**
		 * Add default posts and comments RSS feed links to <head>.
		 */
		add_theme_support( 'automatic-feed-links' );
		
		 /**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'wpazure-720', 720 );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		/**
		 * Add support for two custom navigation menus.
		 */
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'wpazure' ),
			'footer'  => esc_html__( 'Footer Menu', 'wpazure' ),
		   
		) );
		
		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wpazure_custom_background_args', array(
			'default-color' => 'ffffff',
			'wp-head-callback'       => 'wpazure_custom_background_cb',
			'default-image' => '',
		) ) );



		//Custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 40,
			'width'       => 175,
			'flex-height' => true,
			'flex-height' => true,
		) );
	}
endif;
add_action('after_setup_theme','wpazure_setup');
 
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
*/
 
function wpazure_content_width()
{
	$GLOBALS['content_width'] = apply_filters( 'wpazure_content_width', 1170 );
}
add_action( 'after_setup_theme', 'wpazure_content_width', 0 );



function wpazure_scripts()
{
	wp_enqueue_style( 'boostrap-css', WPAZURE_THEME_URI . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'animated', WPAZURE_THEME_URI . '/css/animate.css' );
	wp_enqueue_style( 'font-awesome', WPAZURE_THEME_URI . '/css/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'wpazure-style', get_stylesheet_uri() );
	wp_enqueue_script( 'boostrap-js', WPAZURE_THEME_URI . '/js/bootstrap.min.js', array( 'jquery' ), WPAZURE_THEME_VERSION, true );	
	wp_enqueue_script( 'popper', WPAZURE_THEME_URI . '/js/popper.min.js', array( 'jquery' ), WPAZURE_THEME_VERSION, true );
	wp_enqueue_script( 'wpazure-custom-scripts', WPAZURE_THEME_URI . '/js/custom.js', array( 'jquery' ), WPAZURE_THEME_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpazure_scripts' );


/**
* Add welcome page
**/
if ( is_admin() ) {
require WPAZURE_THEME_DIR . '/inc/admin/wpazure-welcome.php';
}

/**
* Add kirki 
**/

require WPAZURE_THEME_DIR . '/inc/kirki/kirki.php';
add_filter( 'kirki_telemetry', '__return_false' );

require WPAZURE_THEME_DIR .'/inc/font/font.php';

/**
 * Sidebar additions.
*/
require WPAZURE_THEME_DIR . '/inc/core/functions/sidebar-function.php';

/**
 * Customizer additions.
*/
require WPAZURE_THEME_DIR . '/inc/customizer/customizer.php';

/**
 * Custom template tags for this theme.
*/
require WPAZURE_THEME_DIR . '/inc/template-tags.php';

/**
 * section functions files.
*/

require WPAZURE_THEME_DIR . '/inc/core/themes-hooks.php';
require WPAZURE_THEME_DIR . 'inc/core/functions/header-function.php';
require WPAZURE_THEME_DIR . 'inc/core/functions/content-function.php';
require WPAZURE_THEME_DIR . 'inc/core/functions/single-function.php';
require WPAZURE_THEME_DIR . 'inc/core/functions/archive-function.php';
require WPAZURE_THEME_DIR . 'inc/core/functions/footer-function.php';


/**
 * TGMPA
*/
require_once WPAZURE_THEME_DIR . '/inc/tgmpa/class-tgm-plugin-activation.php';
function wpazure_register_required_plugins_function()
{
	$plugins = array(
		
		array(
			'name'      => 'Wpazure Site Library',
			'slug'      => 'wpazure-site-library',
			'required'  => false,
		),
		
		array(
			'name'      => 'Demo content import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),
		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		
		array(
			'name'      => 'Essential Addons for Elementor',
			'slug'      => 'essential-addons-for-elementor-lite',
			'required'  => false,
		),
				
	);	

	$config = array(
		'id'           => 'wpazure',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'wpazure_register_required_plugins_function' );

/**
 * Excerpt length
 */
function wpazure_excerpt_length( $length )
{
	if ( is_admin() ) 
	{
		return $length;
	}
	$excerpt = get_theme_mod('excerpt_length', '20');
	return $excerpt;
}
add_filter( 'excerpt_length', 'wpazure_excerpt_length', 999 );

function wpazure_the_excerpt()
{
	$excerpt_type = get_theme_mod( 'post_content_type','full_content');
	if ( 'full_content' == $excerpt_type )
	{
		the_content();
	} 
	else
	{
		the_excerpt();
		$ReadMore 		= get_theme_mod( 'blog_post_readmore_button_text', __( 'Read more', 'wpazure' ) );
		$excerpt_type = get_theme_mod( 'post_content_type' );
		if ( 'excerpt' == $excerpt_type )
		{
		if ( $ReadMore != '' ) : ?>
		<footer class="entry-footer">
			<a class="read-more-link" href="<?php the_permalink(); ?>"><?php echo esc_html( $ReadMore ); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
		</footer><!-- .entry-footer -->
		<?php endif; 
		
					
		}
	}
}

/**
 * Add Body Classes
 */
 
function wpazure_add_body_class( $BodyClasses ) {

	$BodyClasses[] = get_theme_mod('menu_type','inside_header');

	$BodyClasses[] = 'az-sticky-header';

	return $BodyClasses;
}

add_action( 'body_class', 'wpazure_add_body_class'  );

/**
* Disable Elementor getting started page after activate.
*/

add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
}, 1 );


function wpazure_custom_background_cb() {
    // $background is the saved custom image, or the default image.
    $background = set_url_scheme( get_background_image() );

    // $color is the saved custom color.
    // A default has to be specified in style.css. It will not be printed here.
    $color = get_background_color();

    if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
        $color = false;
    }

    if ( ! $background && ! $color )
        return;

    $style = $color ? "background-color: #$color;" : '';

    if ( $background ) {
        $image = " background-image: url('$background');";

        $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
        if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
            $repeat = 'repeat';
        $repeat = " background-repeat: $repeat;";

        $position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
        if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
            $position = 'left';
        $position = " background-position: top $position;";

        $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
        if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
            $attachment = 'scroll';
        $attachment = " background-attachment: $attachment;";

        $style .= $image . $repeat . $position . $attachment;
    }
?>
<style type="text/css" id="custom-background-css">
.az-wrapper.custom-background { <?php echo trim( $style ); ?> }
</style>
<?php
}