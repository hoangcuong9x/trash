<?php
/**
 * wpazure Theme Customizer
 */
 
 
 function wpazure_customize_register( $wp_customize ) {
	$wp_customize->get_section( 'colors' )->title 				= esc_attr__( 'General', 'wpazure' );
	$wp_customize->get_section( 'colors' )->panel 				= 'azure_panel_colors';
	$wp_customize->get_section( 'colors' )->priority 			= '10';
}
add_action( 'customize_register', 'wpazure_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wpazure_customize_script() {
	wp_enqueue_style('wpazure-customizer-css', WPAZURE_THEME_URI . '/css/admin/admin.css', WPAZURE_THEME_VERSION, true );
}
add_action( 'customize_register', 'wpazure_customize_script' );

include_once(ABSPATH.'wp-admin/includes/plugin.php');
if ( !is_plugin_active( 'wpazure-pro/wpazure-pro.php' ) ) {
	/**
	 * Kirki
	 */
	require WPAZURE_THEME_DIR . '/inc/customizer/kirki/class-wpazure-themes-kirki.php';

	/**
	 * Add Kirki config
	 */
	Wpazure_Kirki::add_config( 'wpazure', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	require WPAZURE_THEME_DIR . '/inc/customizer/settings/header-settings.php';
	require WPAZURE_THEME_DIR . '/inc/customizer/settings/colors-settings.php';
	require WPAZURE_THEME_DIR . '/inc/customizer/settings/footer-settings.php';
	require WPAZURE_THEME_DIR . '/inc/customizer/settings/blog-settings.php';
	
	require WPAZURE_THEME_DIR . '/inc/customizer/settings/wpazure-pro/class-wpazure-get-pro-section.php';
	

	// Register panels, sections, settings, controls, and partials.
	add_action( 'customize_register', 'sections'  );
	function sections( $manager ) {

		// Register custom section types.
		$manager->register_section_type( 'Wpazure_Get_Pro_Section' );

		// Register sections.
		$manager->add_section(
			new Wpazure_Get_Pro_Section(
				$manager,
				'wpazure_upsell',
				array(
					'pro_text' => esc_html__( 'More Options are Available in Wpazure pro ',  'wpazure' ),
					'pro_url'  => '//www.wpazure.com/pro/',
					'priority' => 0,
				)
			)
		);
	}

}