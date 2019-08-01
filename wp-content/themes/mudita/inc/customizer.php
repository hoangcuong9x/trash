<?php
/**
 * Mudita Theme Customizer.
 *
 * @package Mudita
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mudita_customize_register( $wp_customize ) {

	if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
          $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'mudita' );
    }

    /* Option list of all post */	
    $options_posts = array();
    $options_posts_obj = get_posts( 'posts_per_page=-1' );
    $options_posts[''] = __( 'Choose Post', 'mudita' );
    foreach ( $options_posts_obj as $posts ) {
    	$options_posts[$posts->ID] = $posts->post_title;
    }
    
    /* Option list of all categories */
    $args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $option_categories = array();
    $category_lists = get_categories( $args );
    $option_categories[''] = __( 'Choose Category', 'mudita' );
    foreach( $category_lists as $category ){
        $option_categories[$category->term_id] = $category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'mudita' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'mudita' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    /** Default Settings Ends */
    
    /** Header Setting */
    $wp_customize->add_section(
        'mudita_header_settings',
        array(
            'title' => __( 'Header Settings', 'mudita' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Header Info */
    $wp_customize->add_setting(
        'mudita_ed_header_info',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_header_info',
        array(
            'label' => __( 'Enable Header Info', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Header Phone */
    $wp_customize->add_setting(
        'mudita_header_phone',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_header_phone',
        array(
            'label' => __( 'Header Phone', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );
    /** Header Setting Ends */
    
    /** Home Page Settings */
    $wp_customize->add_panel( 
        'mudita_home_page_settings',
         array(
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'mudita' ),
            'description' => __( 'Customize Home Page Settings', 'mudita' ),
        ) 
    );
    
    /** Banner Section */
    $wp_customize->add_section(
        'mudita_banner_settings',
        array(
            'title' => __( 'Banner Section', 'mudita' ),
            'priority' => 20,
            'panel' => 'mudita_home_page_settings',
        )
    );
        
    /** Enable/Disable Banner Section */
    $wp_customize->add_setting(
        'mudita_ed_banner_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_banner_section',
        array(
            'label' => __( 'Enable Banner Section', 'mudita' ),
            'section' => 'mudita_banner_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Banner Post */
    $wp_customize->add_setting(
        'mudita_banner_post',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_banner_post',
        array(
            'label' => __( 'Select Banner Post', 'mudita' ),
            'section' => 'mudita_banner_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'mudita_banner_read_more',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_banner_read_more',
        array(
            'label' => __( 'Read More Text', 'mudita' ),
            'section' => 'mudita_banner_settings',
            'type' => 'text',
        )
    );
    /** Banner Section Ends */
    
    /** Featured Section */
    $wp_customize->add_section(
        'mudita_featured_settings',
        array(
            'title' => __( 'Featured Section', 'mudita' ),
            'priority' => 30,
            'panel' => 'mudita_home_page_settings',
        )
    );
    
    /** Enable/Disable Featured Section */
    $wp_customize->add_setting(
        'mudita_ed_featured_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_featured_section',
        array(
            'label' => __( 'Enable Featured Section', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Featured Section Title */
    $wp_customize->add_setting(
        'mudita_featured_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_section_title',
        array(
            'label' => __( 'Featured Section Title', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'text',
        )
    );
    
    /** Featured Section Content */
    $wp_customize->add_setting(
        'mudita_featured_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_section_content',
        array(
            'label' => __( 'Featured Section Content', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'textarea',
        )
    );
    
    /** Featured Post One */
    $wp_customize->add_setting(
        'mudita_featured_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_post_one',
        array(
            'label' => __( 'Select Featured Post One', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Featured Post Two */
    $wp_customize->add_setting(
        'mudita_featured_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_post_two',
        array(
            'label' => __( 'Select Featured Post Two', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Featured Post Three */
    $wp_customize->add_setting(
        'mudita_featured_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_post_three',
        array(
            'label' => __( 'Select Featured Post Three', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Featured Post Four */
    $wp_customize->add_setting(
        'mudita_featured_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_post_four',
        array(
            'label' => __( 'Select Featured Post Four', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'mudita_featured_read_more',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_featured_read_more',
        array(
            'label' => __( 'Read More Text', 'mudita' ),
            'section' => 'mudita_featured_settings',
            'type' => 'text',
        )
    );
    /** Featured Section Ends */
    
    /** Service Section */
    $wp_customize->add_section(
        'mudita_service_settings',
        array(
            'title' => __( 'Service Section', 'mudita' ),
            'priority' => 40,
            'panel' => 'mudita_home_page_settings',
        )
    );
    
    /** Enable/Disable Service Section */
    $wp_customize->add_setting(
        'mudita_ed_service_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_service_section',
        array(
            'label' => __( 'Enable Service Section', 'mudita' ),
            'section' => 'mudita_service_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Service Post One */
    $wp_customize->add_setting(
        'mudita_service_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_service_post_one',
        array(
            'label' => __( 'Select Service Post One', 'mudita' ),
            'section' => 'mudita_service_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Service Post Two */
    $wp_customize->add_setting(
        'mudita_service_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_service_post_two',
        array(
            'label' => __( 'Select Service Post Two', 'mudita' ),
            'section' => 'mudita_service_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'mudita_service_read_more',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_service_read_more',
        array(
            'label' => __( 'Read More Text', 'mudita' ),
            'section' => 'mudita_service_settings',
            'type' => 'text',
        )
    );
    /** Service Section Ends */
    
    /** Team Section */
    $wp_customize->add_section(
        'mudita_team_settings',
        array(
            'title' => __( 'Team Section', 'mudita' ),
            'priority' => 50,
            'panel' => 'mudita_home_page_settings',
        )
    );
    
    /** Enable/Disable Team Section */
    $wp_customize->add_setting(
        'mudita_ed_team_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_team_section',
        array(
            'label' => __( 'Enable Team Section', 'mudita' ),
            'section' => 'mudita_team_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Team Section Title */
    $wp_customize->add_setting(
        'mudita_team_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_team_section_title',
        array(
            'label' => __( 'Team Section Title', 'mudita' ),
            'section' => 'mudita_team_settings',
            'type' => 'text',
        )
    );
    
    /** Team Section Content */
    $wp_customize->add_setting(
        'mudita_team_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_team_section_content',
        array(
            'label' => __( 'Team Section Content', 'mudita' ),
            'section' => 'mudita_team_settings',
            'type' => 'textarea',
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'mudita_team_section_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_team_section_cat',
        array(
            'label' => __( 'Select Category', 'mudita' ),
            'section' => 'mudita_team_settings',
            'type' => 'select',
            'choices' => $option_categories,
        )
    );
    /** Team Section Ends */
    
    /** Blog Section */
    $wp_customize->add_section(
        'mudita_blog_settings',
        array(
            'title' => __( 'Blog Section', 'mudita' ),
            'priority' => 50,
            'panel' => 'mudita_home_page_settings',
        )
    );
    
    /** Enable/Disable Blog Section */
    $wp_customize->add_setting(
        'mudita_ed_blog_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_blog_section',
        array(
            'label' => __( 'Enable Blog Section', 'mudita' ),
            'section' => 'mudita_blog_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Blog Section Title */
    $wp_customize->add_setting(
        'mudita_blog_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_blog_section_title',
        array(
            'label' => __( 'Blog Section Title', 'mudita' ),
            'section' => 'mudita_blog_settings',
            'type' => 'text',
        )
    );
    
    /** Show/Hide Blog Date */
    $wp_customize->add_setting(
        'mudita_ed_blog_date',
        array(
            'default' => '1',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_blog_date',
        array(
            'label' => __( 'Show Blog Date', 'mudita' ),
            'section' => 'mudita_blog_settings',
            'type' => 'checkbox',
        )
    );
    /** Blog Section Ends */
    
    /** Testimonial Section */
    $wp_customize->add_section(
        'mudita_testimonial_settings',
        array(
            'title' => __( 'Testimonial Section', 'mudita' ),
            'priority' => 50,
            'panel' => 'mudita_home_page_settings',
        )
    );
    
    /** Enable/Disable Testimonial Section */
    $wp_customize->add_setting(
        'mudita_ed_testimonial_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_testimonial_section',
        array(
            'label' => __( 'Enable Testimonial Section', 'mudita' ),
            'section' => 'mudita_testimonial_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Testimonial Section Title */
    $wp_customize->add_setting(
        'mudita_testimonial_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_testimonial_section_title',
        array(
            'label' => __( 'Testimonial Section Title', 'mudita' ),
            'section' => 'mudita_testimonial_settings',
            'type' => 'text',
        )
    );
    
    /** Testimonial Section Content */
    $wp_customize->add_setting(
        'mudita_testimonial_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_testimonial_section_content',
        array(
            'label' => __( 'Testimonial Section Content', 'mudita' ),
            'section' => 'mudita_testimonial_settings',
            'type' => 'text',
        )
    );
    
    /** Testimonial Post One */
    $wp_customize->add_setting(
        'mudita_testimonial_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_testimonial_post_one',
        array(
            'label' => __( 'Select Testimonial Post One', 'mudita' ),
            'section' => 'mudita_testimonial_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Testimonial Post Two */
    $wp_customize->add_setting(
        'mudita_testimonial_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_testimonial_post_two',
        array(
            'label' => __( 'Select Testimonial Post Two', 'mudita' ),
            'section' => 'mudita_testimonial_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Testimonial Post Three */
    $wp_customize->add_setting(
        'mudita_testimonial_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'mudita_testimonial_post_three',
        array(
            'label' => __( 'Select Testimonial Post Three', 'mudita' ),
            'section' => 'mudita_testimonial_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    /** Testimonial Section Ends */

    /** Home Page Settings Ends */
    
    /** BreadCrumb Settings */
    $wp_customize->add_section(
        'mudita_breadcrumb_settings',
        array(
            'title' => __( 'Breadcrumb Settings', 'mudita' ),
            'priority' => 40,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable BreadCrumb */
    $wp_customize->add_setting(
        'mudita_ed_breadcrumb',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_breadcrumb',
        array(
            'label' => __( 'Enable Breadcrumb', 'mudita' ),
            'section' => 'mudita_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Current */
    $wp_customize->add_setting(
        'mudita_ed_current',
        array(
            'default' => '1',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_current',
        array(
            'label' => __( 'Show current', 'mudita' ),
            'section' => 'mudita_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Home Text */
    $wp_customize->add_setting(
        'mudita_breadcrumb_home_text',
        array(
            'default' => __( 'Home', 'mudita' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_breadcrumb_home_text',
        array(
            'label' => __( 'Breadcrumb Home Text', 'mudita' ),
            'section' => 'mudita_breadcrumb_settings',
            'type' => 'text',
        )
    );
    
    /** Breadcrumb Separator */
    $wp_customize->add_setting(
        'mudita_breadcrumb_separator',
        array(
            'default' => __( '>', 'mudita' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_breadcrumb_separator',
        array(
            'label' => __( 'Breadcrumb Separator', 'mudita' ),
            'section' => 'mudita_breadcrumb_settings',
            'type' => 'text',
        )
    );
    /** BreadCrumb Settings Ends */
    
    /** Social Settings */
    $wp_customize->add_section(
        'mudita_social_settings',
        array(
            'title' => __( 'Social Settings', 'mudita' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'mudita' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Social Icon in Header */
    $wp_customize->add_setting(
        'mudita_ed_social_header',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_social_header',
        array(
            'label' => __( 'Enable Social Icons in Header', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Social Section */
    $wp_customize->add_setting(
        'mudita_ed_social_section',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'mudita_ed_social_section',
        array(
            'label' => __( 'Enable Social Section', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Social Section Title */
    $wp_customize->add_setting(
        'mudita_social_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mudita_social_section_title',
        array(
            'label' => __( 'Social Section Title', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'mudita_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_facebook',
        array(
            'label' => __( 'Facebook', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );

    /** Twitter */
    $wp_customize->add_setting(
        'mudita_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_twitter',
        array(
            'label' => __( 'Twitter', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Pintrest */
    $wp_customize->add_setting(
        'mudita_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_pinterest',
        array(
            'label' => __( 'Pintest', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** LinkedIn */
    $wp_customize->add_setting(
        'mudita_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_linkedin',
        array(
            'label' => __( 'LinkedIn', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Gooble Plus */
    $wp_customize->add_setting(
        'mudita_gplus',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_gplus',
        array(
            'label' => __( 'Google Plus', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Instagram */
    $wp_customize->add_setting(
        'mudita_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_instagram',
        array(
            'label' => __( 'Instagram', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** YouTube */
    $wp_customize->add_setting(
        'mudita_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mudita_youtube',
        array(
            'label' => __( 'YouTube', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        /** Custom CSS*/
        $wp_customize->add_section(
            'mudita_custom_settings',
            array(
                'title' => __( 'Custom CSS Settings', 'mudita' ),
                'priority' => 50,
                'capability' => 'edit_theme_options',
            )
        );
        
        $wp_customize->add_setting(
            'mudita_custom_css',
            array(
                'default' => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'mudita_sanitize_css'
                )
        );
        
        $wp_customize->add_control(
            'mudita_custom_css',
            array(
                'label' => __( 'Custom Css', 'mudita' ),
                'section' => 'mudita_custom_settings',
                'description' => __( 'Put your custom CSS', 'mudita' ),
                'type' => 'textarea',
            )
        );
        /** Custom CSS Ends */
    }

     /** Footer Section */
    $wp_customize->add_section(
        'mudita_footer_section',
        array(
            'title' => __( 'Footer Settings', 'mudita' ),
            'priority' => 70,
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'mudita_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'mudita_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'mudita' ),
            'section' => 'mudita_footer_section',
            'type' => 'textarea',
        )
    );
 

    
    /**
     * Sanitization Functions
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
     */
     function mudita_sanitize_checkbox( $checked ){
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
     }
     
     function mudita_sanitize_select( $input, $setting ){
        // Ensure input is a slug.
    	$input = sanitize_key( $input );
    	
    	// Get list of choices from the control associated with the setting.
    	$choices = $setting->manager->get_control( $setting->id )->choices;
    	
    	// If the input is a valid key, return it; otherwise, return the default.
    	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
     }
     
     function mudita_sanitize_url( $url ){
        return esc_url_raw( $url );
     }
     
     function mudita_sanitize_css( $css ){
    	return wp_strip_all_tags( $css );
     }
 
}
add_action( 'customize_register', 'mudita_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mudita_customize_preview_js() {
	wp_enqueue_script( 'mudita_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'mudita_customize_preview_js' );
