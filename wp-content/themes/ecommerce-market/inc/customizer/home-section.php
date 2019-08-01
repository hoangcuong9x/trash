<?php
/**
 * Home Page Theme Options 
 * 
 * @package eCommerce_Market
 */
$default = ecommerce_market_get_default_theme_options();

/****************  Add Pannel   ***********************/
$wp_customize->add_panel( 'home_option_panel',
	array(
	'title'      => esc_html__( 'Home Page Options', 'ecommerce-market' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);
/**************** Home Page Setting Section ************/
$wp_customize->add_section('section_home_setting', 
	array(    
	'title'       => esc_html__('Home Page Setting', 'ecommerce-market'),
	'panel'       => 'home_option_panel'    
	)
);

/********************* Enable Home Content ****************************/
$wp_customize->add_setting( 'theme_options[home_page_content]',
	array(
		'default'           => $default['home_page_content'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[home_page_content]',
	array(
		'label'    => esc_html__( 'Enable Home Content', 'ecommerce-market' ),
		'section'  => 'section_home_setting',
		'type'     => 'checkbox',
	)
);


/****************  Featured Slider Setting Section ************/
$wp_customize->add_section('section_featured_slider', 
	array(    
	'title'       => esc_html__('Featured Slider', 'ecommerce-market'),
	'panel'       => 'home_option_panel'    
	)
);

/********************* Enable Slider ****************************/
$wp_customize->add_setting( 'theme_options[featured_slider]',
	array(
		'default'           => $default['featured_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider]',
	array(
		'label'    => esc_html__( 'Enable Featured Slider', 'ecommerce-market' ),
		'section'  => 'section_featured_slider',
		'type'     => 'checkbox',
	)
);

/************************ Slider number *********************************/
$wp_customize->add_setting( 'theme_options[featured_slider_number]',
	array(
	'default'           => $default['featured_slider_number'],
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'ecommerce_market_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_number]',
	array(
	'label'       => __( 'No of Slides', 'ecommerce-market' ),
	'section'     => 'section_featured_slider',
	'type'        => 'number', 	
	'input_attrs' => array( 'min' => 1, 'max' => 5, 'step' => 1, 'style' => 'width: 100px;' ),
	)
);

/***************************** Featured Slider Type  ******************************/
$wp_customize->add_setting( 'theme_options[featured_slider_type]',
	array(
	'default'           => $default['featured_slider_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_market_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_type]',
	array(
	'label'    => esc_html__( 'Select Slider Category Type', 'ecommerce-market' ),
	'section'  => 'section_featured_slider',
	'type'     => 'select',	
    'choices'   => array(
        'featured-category'  		=> __('Featured Category', 'ecommerce-market'),
        'featured-product-category' => __('Featured Product Category', 'ecommerce-market'),              
    	),
	)
);

/************************** Slider Catgory ****************************/
$wp_customize->add_setting( 'theme_options[featured_category]',
	array(
	'default'           => $default['featured_category'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Ecommerce_Market_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[featured_category]',
		array(
		'label'    => __( 'Select Category', 'ecommerce-market' ),
		'section'  => 'section_featured_slider',
		'settings' => 'theme_options[featured_category]',	
		'active_callback'	=> 'ecommerce_market_featured_category_slider_active',	
		)
	)
);

if ( ecommerce_market_is_woocommerce_active() ) :
	/************************** Slider Product Catgory ****************************/
	$wp_customize->add_setting( 'theme_options[featured_product_category]',
		array(
		'default'           => $default['featured_product_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new Ecommerce_Market_Dropdown_Product_Taxonomies_Control( $wp_customize, 'theme_options[featured_product_category]',
			array(
			'label'    			=> __( 'Select Product Category', 'ecommerce-market' ),
			'section'  			=> 'section_featured_slider',
			'settings' 			=> 'theme_options[featured_product_category]',	
			'active_callback'	=> 'ecommerce_market_featured_product_category_slider_active',	
			)
		)
	);

endif;

/************************** Slider Read More Text ****************************/
$wp_customize->add_setting( 'theme_options[featured_slider_read_more_text]',
	array(
	'default'           => $default['featured_slider_read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_read_more_text]',
	array(
	'label'    => __( 'Read More Text', 'ecommerce-market' ),
	'section'  => 'section_featured_slider',
	'type'     => 'text',
	)
);
/*************** Slider Overlay Text *****************************/
$wp_customize->add_setting( 'theme_options[overlay_text]',
	array(
	'default'           => $default['overlay_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',	
	)
);
$wp_customize->add_control( 'theme_options[overlay_text]',
	array(
	'label'    => esc_html__( 'Slider Overlay Text', 'ecommerce-market' ),
	'section'  => 'section_featured_slider',
	'type'     => 'text',
	)
);