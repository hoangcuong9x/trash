<?php
/**
 * Theme Options 
 * 
 * @package eCommerce_Market
 */
$default = ecommerce_market_get_default_theme_options();

/****************  Add Pannel   ***********************/
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => esc_html__( 'Theme Options', 'ecommerce-market' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/****************  Header Setting Section starts ************/
$wp_customize->add_section('section_header', 
	array(    
	'title'       => esc_html__('Header Setting', 'ecommerce-market'),
	'panel'       => 'theme_option_panel'    
	)
);

/************************  Site Identity  ******************/
$wp_customize->add_setting('theme_options[site_identity]', 
	array(
	'default' 			=> $default['site_identity'],
	'sanitize_callback' => 'ecommerce_market_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[site_identity]', 
	array(		
	'label' 	=> esc_html__('Choose Option', 'ecommerce-market'),
	'section' 	=> 'title_tagline',
	'settings'  => 'theme_options[site_identity]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'logo-only' 	=> esc_html__('Logo Only', 'ecommerce-market'),
			'logo-text' 	=> esc_html__('Logo + Tagline', 'ecommerce-market'),
			'title-only' 	=> esc_html__('Title Only', 'ecommerce-market'),
			'title-text' 	=> esc_html__('Title + Tagline', 'ecommerce-market')
		)
	)
);

/********************* Header Search Form ****************************/
$wp_customize->add_setting( 'theme_options[search_in_header]',
	array(
		'default'           => $default['search_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[search_in_header]',
	array(
		'label'    => esc_html__( 'Enable Search Form', 'ecommerce-market' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

/********************* Header Search Form ****************************/
$wp_customize->add_setting( 'theme_options[search_in_header]',
	array(
		'default'           => $default['search_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[search_in_header]',
	array(
		'label'    => esc_html__( 'Enable Search Form', 'ecommerce-market' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

/********************* Login ****************************/
$wp_customize->add_setting( 'theme_options[login_header]',
	array(
		'default'           => $default['login_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[login_header]',
	array(
		'label'    => esc_html__( 'Enable Login Button', 'ecommerce-market' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

/********************* Cart in Header ****************************/
$wp_customize->add_setting( 'theme_options[cart_header]',
	array(
		'default'           => $default['cart_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[cart_header]',
	array(
		'label'    => esc_html__( 'Enable Cart in Header', 'ecommerce-market' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

/****************  General Setting Section starts ************/
$wp_customize->add_section('section_general', 
	array(    
	'title'       => esc_html__('General Setting', 'ecommerce-market'),
	'panel'       => 'theme_option_panel'    
	)
);

/**********************  Layout Options ***************************/
$wp_customize->add_setting('theme_options[layout_options]', 
	array(
	'default' 			=> $default['layout_options'],
	'sanitize_callback' => 'ecommerce_market_sanitize_select',
	)
);

$wp_customize->add_control(new Ecommerce_Market_Image_Radio_Control($wp_customize, 'theme_options[layout_options]', 
	array(		
	'label' 	=> esc_html__('Layout Options', 'ecommerce-market'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[layout_options]',
	'type' 		=> 'radio-image',
	'choices' 	=> array(		
		'left' 			=> get_template_directory_uri() . '/assest/img/left-sidebar.png',							
		'right' 		=> get_template_directory_uri() . '/assest/img/right-sidebar.png',
		'no-sidebar' 	=> get_template_directory_uri() . '/assest/img/no-sidebar.png',
		),	
	))
);

/******************************** Enable Shop Sidebar *****************************/
if ( ecommerce_market_is_woocommerce_active() ):

	$wp_customize->add_setting('theme_options[enable_shop_sidebar]', 
		array(
		'default' 			=> $default['enable_shop_sidebar'],
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox'
		)
	);

	$wp_customize->add_control('theme_options[enable_shop_sidebar]', 
		array(		
		'label' 	=> esc_html__('Enable Shop Sidebar:', 'ecommerce-market'),
		'section' 	=> 'section_general',
		'settings'  => 'theme_options[enable_shop_sidebar]',
		'type' 		=> 'checkbox',	
		)
	);
endif;

/*************** Archive Page Details Text. *****************************/
$wp_customize->add_setting( 'theme_options[archive_readmore]',
	array(
	'default'           => $default['archive_readmore'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_market_sanitize_textarea_content',
	)
);
$wp_customize->add_control( 'theme_options[archive_readmore]',
	array(
	'label'    => esc_html__( 'Archive Details Text', 'ecommerce-market' ),
	'section'  => 'section_general',
	'type'     => 'text',
	)
);

/********************************** Pagaination Option *********************************/
$wp_customize->add_setting('theme_options[pagination_option]', 
	array(
	'default' 			=> $default['pagination_option'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_market_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[pagination_option]', 
	array(		
	'label' 	=> esc_html__('Pagaination Options', 'ecommerce-market'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[pagination_option]',
	'type' 		=> 'radio',
	'choices' 	=> array(		
		'default' 		=> esc_html__('Default', 'ecommerce-market'),							
		'numeric' 		=> esc_html__('Numeric', 'ecommerce-market'),		
		),	
	)
);


/****************  Footer Setting Section starts ************/
$wp_customize->add_section('section_footer', 
	array(    
	'title'       => esc_html__('Footer Setting', 'ecommerce-market'),
	'panel'       => 'theme_option_panel'    
	)
);

/********************** Subscription Page *****************************/
$wp_customize->add_setting('theme_options[subscription_page]', 
	array(
	'default'           => $default['subscription_page'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'ecommerce_market_sanitize_dropdown_pages'
	)
);

$wp_customize->add_control('theme_options[subscription_page]', 
	array(
	'label'       => esc_html__('Select Subscription Page', 'ecommerce-market'),
    'description' => esc_html__( 'Select page from dropdown or leave blank if you want to hide this section.', 'ecommerce-market' ), 
	'section'     => 'section_footer',   
	'settings'    => 'theme_options[subscription_page]',		
	'type'        => 'dropdown-pages'
	)
);

/*********************************** Setting Address.***************************/
$wp_customize->add_setting( 'theme_options[footer_address]',
	array(
	'default'           => $default['footer_address'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_market_sanitize_textarea_content',	
	)
);
$wp_customize->add_control( 'theme_options[footer_address]',
	array(
	'label'    => esc_html__( 'Address', 'ecommerce-market' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	)
);

/************************ Setting Phone Number. ******************************/
$wp_customize->add_setting( 'theme_options[footer_number]',
	array(
	'default'           => $default['footer_number'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',	
	)
);
$wp_customize->add_control( 'theme_options[footer_number]',
	array(
	'label'    => esc_html__( 'Phone Number', 'ecommerce-market' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	)
);
/**************************** Setting Email *******************************/
$wp_customize->add_setting('theme_options[footer_email]',  
	array(
	'default'           => $default['footer_email'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_email',

	)
);

$wp_customize->add_control('theme_options[footer_email]', 
	array(
	'label'       => esc_html__('Contact Email', 'ecommerce-market'),
	'section'     => 'section_footer',   
	'settings'    => 'theme_options[footer_email]',		
	'type'        => 'text'
	)
);

/********************* Footer Logo ****************************/
$wp_customize->add_setting( 'theme_options[footer_logo]',
	array(
		'default'           => $default['footer_logo'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[footer_logo]',
	array(
		'label'    => esc_html__( 'Enable Footer Logo', 'ecommerce-market' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
	)
);

/********************* Social Menu ****************************/
$wp_customize->add_setting( 'theme_options[footer_social_icon]',
	array(
		'default'           => $default['footer_social_icon'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_market_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[footer_social_icon]',
	array(
		'label'    => esc_html__( 'Enable Social Icon', 'ecommerce-market' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
	)
);

/*************** Setting copyright text. *****************************/
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_market_sanitize_textarea_content',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => esc_html__( 'Copyright Text', 'ecommerce-market' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	)
);

/************************** Breadcrumb Section  **************************/
$wp_customize->add_section('section_breadcrumb', 
	array(    
	'title'       => esc_html__('Breadcrumb Setting', 'ecommerce-market'),
	'panel'       => 'theme_option_panel'    
	)
);
/****************************** Enable Breadcrumb *************************/
$wp_customize->add_setting('theme_options[enable_breadcrumb]', 
	array(
	'default' 			=> $default['enable_breadcrumb'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_market_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_breadcrumb]', 
	array(		
	'label' 	=> esc_html__('Enable Breadcrumb:', 'ecommerce-market'),
	'section' 	=> 'section_breadcrumb',
	'settings'  => 'theme_options[enable_breadcrumb]',
	'type' 		=> 'checkbox',	
	)
);
