<?php
/**
 * Register theme options in the Customizer
 *
 * @package TheFour
 */

/**
 * Register theme options in the Customizer
 *
 * @package TheFour
 */
class TheFour_Customizer {
	/**
	 * Sanitizer object which holds all sanitization callbacks.
	 *
	 * @var object
	 */
	protected $sanitizer;

	/**
	 * Constructor.
	 *
	 * @param object $sanitizer Sanitizer object which holds all sanitization callbacks.
	 */
	public function __construct( $sanitizer ) {
		$this->sanitizer = $sanitizer;
	}

	/**
	 * Initialize customizer settings.
	 */
	public function init() {
		add_action( 'customize_register', array( $this, 'register' ) );
	}

	/**
	 * Register customizer settings
	 *
	 * @param WP_Customize_Manager $wp_customize WordPress customizer manager instance.
	 */
	public function register( WP_Customize_Manager $wp_customize ) {
		// Remove the core header textcolor control, as it shares the main text color.
		$wp_customize->remove_control( 'header_textcolor' );

		// Call to action section.
		$wp_customize->add_setting( 'front_page_cta', array(
			'sanitize_callback' => array( $this->sanitizer, 'html' ),
		) );
		$wp_customize->add_control( 'front_page_cta', array(
			'label'       => esc_html__( 'Call to action section content', 'thefour-lite' ),
			'section'     => 'static_front_page',
			'type'        => 'textarea',
			'description' => wp_kses_post( __( 'Use this section to display special offers for your products or services. To display buttons, use a link with class <code>button</code> or <code>button-minimal</code>.', 'thefour-lite' ) ),
		) );

		// Image section.
		$wp_customize->add_setting( 'front_page_image', array(
			'sanitize_callback' => array( $this->sanitizer, 'image' ),
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'front_page_image',
			array(
				'label'       => esc_html__( 'Image', 'thefour-lite' ),
				'section'     => 'static_front_page',
				'settings'    => 'front_page_image',
				'description' => esc_html__( 'The image will be displayed in the bottom of the front page. This can be an image of client logos, a promotional banner, a map showing where your business is located or anything else that you can think to put in this space.', 'thefour-lite' ),
			)
		) );
		$wp_customize->add_setting( 'front_page_image_title', array(
			'sanitize_callback' => array( $this->sanitizer, 'text' ),
		) );
		$wp_customize->add_control( 'front_page_image_title', array(
			'label'   => esc_html__( 'Image section title', 'thefour-lite' ),
			'section' => 'static_front_page',
			'type'    => 'text',
		) );
	}
}
