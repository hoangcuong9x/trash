<?php
/**
 * Get Pro Version section.
 *
 * @package Wpazure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'Wpazure_Get_Pro_Section' ) ) {
	/**
	 * Create our get pro version section.
	 */
	class Wpazure_Get_Pro_Section extends WP_Customize_Section {
		/**
		 * wpazure pro section name
		 *
		 * @var $type wpazure-pro-section
		 */
		public $type = 'wpazure-pro-section';

		/**
		 * wpazure get pro version url
		 *
		 * @var $pro_url
		 */
		public $pro_url = '';

		/**
		 * wpazure get pro vertion text
		 *
		 * @var $pro_text
		 */
		public $pro_text = '';

		/**
		 * wpazure get pro vertion id
		 *
		 * @var $id
		 */
		public $id = '';

		/**
		 * Json
		 *
		 * @return array()  json data
		 */
		public function json() {
			$json             = parent::json();
			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );
			$json['id']       = $this->id;

			return $json;
		}

		/**
		 * Render template
		 */
		protected function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}" class="wpazure-get-pro-version-accordion-section control-section-{{ data.type }} cannot-expand accordion-section">
				<h3 class="wp-ui-highlight"><a class="wp-ui-text-highlight" href="{{{ data.pro_url }}}" target="_blank">{{ data.pro_text }}</a></h3>
			</li>
			<?php
		}
	}
}

if ( ! function_exists( 'wpazure_customizer_section_pro_static' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'wpazure_customizer_section_pro_static' );
	/**
	 * Add JS/CSS for our controls
	 */
	function wpazure_customizer_section_pro_static() {
		wp_enqueue_style(
			'wpazure-pro-section-css',
			WPAZURE_THEME_URI . 'inc/customizer/settings/wpazure-pro/css/get-pro-section.css',
			array(),
			WPAZURE_THEME_VERSION
		);

		wp_enqueue_script(
			'wpazure-pro-section-js',
			WPAZURE_THEME_URI . 'inc/customizer/settings/wpazure-pro/js/get-pro-section.js',
			array( 'customize-controls' ),
			WPAZURE_THEME_VERSION,
			true
		);
	}
}
