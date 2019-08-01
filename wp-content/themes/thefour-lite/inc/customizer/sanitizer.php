<?php
/**
 * Customizer: Sanitization Callbacks
 *
 * This file demonstrates how to define sanitization callback public functions for various data types.
 *
 * @package   TheFour
 * @link      https://raw.githubusercontent.com/WPTRT/code-examples/master/customizer/sanitization-callbacks.php
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */

/**
 * Sanitization class for Customizer
 *
 * @package   TheFour
 * @link      https://raw.githubusercontent.com/WPTRT/code-examples/master/customizer/sanitization-callbacks.php
 */
class TheFour_Customize_Sanitizer {
	/**
	 * Checkbox sanitization callback.
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 *
	 * @return bool Whether the checkbox is checked.
	 */
	public function checkbox( $checked ) {
		return isset( $checked ) && true === $checked;
	}

	/**
	 * HTML sanitization callback.
	 *
	 * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
	 * for HTML allowable in posts.
	 *
	 * @see wp_kses_post() https://developer.wordpress.org/reference/functions/wp_kses_post/
	 *
	 * @param string $html HTML to sanitize.
	 *
	 * @return string Sanitized HTML.
	 */
	public function html( $html ) {
		return wp_kses_post( $html );
	}

	/**
	 * Image sanitization callback.
	 *
	 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
	 * send back the filename, otherwise, return the setting default.
	 *
	 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
	 *
	 * @param string               $image Image filename.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string The image filename if the extension is allowed; otherwise, the setting default.
	 */
	public function image( $image, $setting ) {
		/*
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types()
		 */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);

		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it; otherwise, return the default.
		return $file['ext'] ? $image : $setting->default;
	}

	/**
	 * Select sanitization callback.
	 *
	 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
	 * as a slug, and then validates `$input` against the choices defined for the control.
	 *
	 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
	 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
	 *
	 * @param string               $input Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 */
	public function select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return isset( $choices[ $input ] ) ? $input : $setting->default;
	}

	/**
	 * Text sanitization callback.
	 *
	 * Sanitization callback for 'text' type text inputs. This callback sanitizes `$text` as a simple text with
	 * no tags and special characters.
	 *
	 * @see sanitize_text_field() https://developer.wordpress.org/reference/functions/sanitize_text_field/
	 *
	 * @param string $text Text to sanitize.
	 *
	 * @return string Sanitized text.
	 */
	public function text( $text ) {
		return sanitize_text_field( $text );
	}
}
