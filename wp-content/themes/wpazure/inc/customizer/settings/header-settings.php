<?php
/**
 * Header Customizer panel
 *
 */
 
Wpazure_Kirki::add_panel( 'azure_header', array(
    'priority'    => 21,
    'title'       => __( 'Header', 'wpazure' ),
) );

//Menu
Wpazure_Kirki::add_section( 'azure_section_menu', array(
    'title'       	 => __( 'Menu', 'wpazure' ),
    'panel'          => 'azure_header',
    'priority'       => 12,
) );
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio',
	'settings'    => 'menu_type',
	'label'       => __( 'Menu type', 'wpazure' ),
	'section'     => 'azure_section_menu',
	'default'     => 'inside_header',
	'choices'     => array(
		'inside_header' 	=> esc_attr__( 'Inside header', 'wpazure' ),
		'outside_header' 	=> esc_attr__( 'Outside header', 'wpazure' ),
	),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio',
	'settings'    => 'sticky_menu',
	'label'       => esc_attr__( 'Sticky menu', 'wpazure' ),
	'section'     => 'azure_section_menu',
	'default'     => 'sticky_header',
	'choices'     => array(
		'sticky_header' 	=> esc_attr__( 'Sticky menu', 'wpazure' ),
		'static_header' 	=> esc_attr__( 'Static menu', 'wpazure' ),
	),	
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio-image',
	'settings'    => 'menu_container',
	'label'       => __( 'Menu width', 'wpazure' ),
	'section'     => 'azure_section_menu',
	'default'     => 'contained',
	'choices'     => array(
		'contained'   => WPAZURE_THEME_URI . '/images/customizer/header-container.png',
		'fullwidth' => WPAZURE_THEME_URI . '/images/customizer/header-fullwidth.png',
	),
	
) );