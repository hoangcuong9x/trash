<?php
/**
 * Footer Customizer panel
 *
 */
 // Footer panel
 Wpazure_Kirki::add_panel( 'wpazure_footer', array(
    'priority'    => 40,
    'title'       => __( 'Footer', 'wpazure' ),
) );

// Footer widget section
Wpazure_Kirki::add_section( 'azure_footer_widgt_section', array(
    'title'       	 => __( 'Footer widget', 'wpazure' ),
    'panel'          => 'wpazure_footer',
    'priority'       => 12,
) );

// Start footer widget section settings
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio-image',
	'settings'    => 'azure_footer_widgt_layout',
	'label'		  => 'Footer layout',
	'section'     => 'azure_footer_widgt_section',
	'default'     => 'layout-3',
	'choices'     => array(
		'footer_off' 	=> WPAZURE_THEME_URI . '/images/customizer/footer-off.png',
		'layout-3' 	=> WPAZURE_THEME_URI . '/images/customizer/footer-3-col.png',
	),
) );

/*Seprater between control*/
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => 'separator_after_footer_widget_layout',
	'section'     => 'azure_footer_widgt_section',
	'default'     => '<hr>',
) );


// End footer widget section settings


// Footer bar
Wpazure_Kirki::add_section( 'azure_footer_bar_section', array(
    'title'       	 => __( 'Footer bar', 'wpazure' ),
    'panel'          => 'wpazure_footer',
    'priority'       => 13,
) );

// Footer bar settings start 
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio-image',
	'settings'    => 'azure_footer_copyright_layout_layout',
	'label'		  => 'Footer bar layout',
	'section'     => 'azure_footer_bar_section',
	'default'     => 'footer_bar_full',
	'choices'     => array(
		'footer_bar_off' 	=> WPAZURE_THEME_URI . '/images/customizer/footer-off.png',
		'footer_bar_center' 	=> WPAZURE_THEME_URI . '/images/customizer/footer-bar-center.png',
		'footer_bar_full' 	=> WPAZURE_THEME_URI . '/images/customizer/footer-bar-full.png',
	),
) );

/*Seprater between control*/
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => 'separator_after_footer_bar_layout',
	'section'     => 'azure_footer_bar_section',
	'default'     => '<hr>',
) );

/* Footer bar section one settings */
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'select',
	'settings'    => 'azure_footer_bar_section_one',
	'label'       => esc_html__( 'Section 1', 'wpazure' ),
	'section'     => 'azure_footer_bar_section',
	'default'     => 'custom_text',
	'multiple'    => 1,
	'choices'     => array(
		'none' => esc_html__( 'None', 'wpazure' ),
		'custom_text' => esc_html__( 'Custom text', 'wpazure' ),
		'footer_menu' => esc_html__( 'Footer menu', 'wpazure' ),
		'widget' => esc_html__( 'Widget', 'wpazure' ),
	),
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'     => 'textarea',
	'settings' => 'azure_footer_section_one',
	'label'    => esc_html__( 'Section 1 custom text', 'wpazure' ),
	'section'  => 'azure_footer_bar_section',
	'default'  => '<p><a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://wpazure.com" rel="designer">Wpazure</a> by Wpazure</p>',
	'required'    => array(
        array(
            'setting'  => 'azure_footer_bar_section_one',
            'value'    => 'custom_text',
            'operator' => '==',
        ),
    ),
) );

/* Footer bar section two settings*/
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'select',
	'settings'    => 'azure_footer_bar_section_two',
	'label'       => esc_html__( 'Section 2', 'wpazure' ),
	'section'     => 'azure_footer_bar_section',
	'default'     => 'footer_menu',
	'multiple'    => 1,
	'choices'     => array(
		'none' => esc_html__( 'None', 'wpazure' ),
		'custom_text' => esc_html__( 'Custom text', 'wpazure' ),
		'footer_menu' => esc_html__( 'Footer menu', 'wpazure' ),
		'widget' => esc_html__( 'Widget', 'wpazure' ),
	),
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'     => 'textarea',
	'settings' => 'azure_footer_section_two',
	'label'    => esc_html__( 'Section 2 custom text', 'wpazure' ),
	'section'  => 'azure_footer_bar_section',
	'default'  => '<p><a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://wpazure.com" rel="designer">Wpazure</a> by Wpazure</p>',
	'required'    => array(
        array(
            'setting'  => 'azure_footer_bar_section_two',
            'value'    => 'custom_text',
            'operator' => '==',
        ),
    ),
) );