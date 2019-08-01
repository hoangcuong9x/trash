<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package TheFour
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses thefour_header_style()
 */
function thefour_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'thefour_custom_header_args', array(
		'default-text-color' => 'fff',
		'width'              => 1920,
		'height'             => 540,
		'flex-width'         => true,
		'flex-height'        => true,
		'default-image'      => get_template_directory_uri() . '/img/header.jpg',
		'wp-head-callback'   => 'thefour_header_style',
	) ) );
	register_default_headers( array(
		'work-space' => array(
			'url'           => '%s/img/header.jpg',
			'thumbnail_url' => '%s/img/header.jpg',
			'description'   => esc_html__( 'Work Space', 'thefour-lite' ),
		),
	) );
}

add_action( 'after_setup_theme', 'thefour_custom_header_setup' );

if ( ! function_exists( 'thefour_header_style' ) ) :
	/**
	 * Show the header image and optionally hide the site title, site description.
	 */
	function thefour_header_style() {
		$style = '';
		if ( has_header_image() ) {
			$style .= '.site-header { background-image: url(' . esc_url( get_header_image() ) . '); }';
		}
		if ( ! display_header_text() ) {
			$style .= '.site-title, .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }';
		}
		if ( $style ) :
			?>
			<style id="thefour-header-css">
				<?php echo $style; // WPCS: XSS OK. ?>
			</style>
			<?php
		endif;
	}
endif;

/**
 * Use featured image for the header image on single post/page.
 *
 * @param string $image Header image URL.
 *
 * @return string
 */
function thefour_header_image_singular( $image ) {
	/**
	 * Allow developers to bypass the featured image with filter.
	 * @param bool
	 */
	if ( false === apply_filters( 'thefour_header_image_singular', true ) ) {
		return $image;
	}

	/**
	 * List of supported post types that use featured image for the header image.
	 *
	 * @param array $post_types Post types.
	 */
	$post_types = apply_filters( 'thefour_header_image_post_types', array( 'post', 'page' ) );
	if ( ! is_singular( $post_types ) || ! has_post_thumbnail() ) {
		return $image;
	}

	if ( $thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' ) ) {
		$image = $thumbnail;
	}

	return $image;
}

add_filter( 'theme_mod_header_image', 'thefour_header_image_singular' );
