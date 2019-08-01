<?php
/**
 * The Minimal Theme Customizer.
 *
 * @package The_Minimal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function the_minimal_customize_register( $wp_customize ) {
    
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
    $option_categories[''] = __( 'Choose Category', 'the-minimal' );
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
            'title' => __( 'Default Settings', 'the-minimal' ),
            'description' => __( 'Default section provided by wordpress customizer.', 'the-minimal' ),
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
    
    /** Slider Settings */
    $wp_customize->add_section(
        'the_minimal_slider_settings',
        array(
            'title' => __( 'Slider Settings', 'the-minimal' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'the_minimal_ed_slider',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_ed_slider',
        array(
            'label' => __( 'Enable Home Page Slider', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'the_minimal_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'the_minimal_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Control */
    $wp_customize->add_setting(
        'the_minimal_slider_control',
        array(
            'default' => '1',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_control',
        array(
            'label' => __( 'Enable Slider Control', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'the_minimal_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Thumbnail */
    $wp_customize->add_setting(
        'the_minimal_slider_thumbnail',
        array(
            'default' => '1',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_thumbnail',
        array(
            'label' => __( 'Enable Slider Thumbnail', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Slider Animation */
    $wp_customize->add_setting(
        'the_minimal_slider_animation',
        array(
            'default' => 'slide',
            'sanitize_callback' => 'the_minimal_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_animation',
        array(
            'label' => __( 'Choose Slider Animation', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'the-minimal' ),
                'slide' => __( 'Slide', 'the-minimal' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'the_minimal_slider_speed',
        array(
            'default' => '500',
            'sanitize_callback' => 'the_minimal_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_speed',
        array(
            'label' => __( 'Slider Speed', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Readmore */
    $wp_customize->add_setting(
        'the_minimal_slider_readmore',
        array(
            'default' => __( 'Continue Reading', 'the-minimal' ),
            'sanitize_callback' => 'the_minimal_sanitize_nohtml',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'the_minimal_slider_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_slider_cat',
        array(
            'label' => __( 'Choose Slider Category', 'the-minimal' ),
            'section' => 'the_minimal_slider_settings',
            'type' => 'select',
            'choices' => $option_categories,
        )
    );
    /** Slider Settings Ends */
    
    /** Social Settings */
    $wp_customize->add_section(
        'the_minimal_social_settings',
        array(
            'title' => __( 'Social Settings', 'the-minimal' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'the-minimal' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Social in Header */
    $wp_customize->add_setting(
        'the_minimal_ed_social',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_ed_social',
        array(
            'label' => __( 'Enable Social Links', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'the_minimal_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_facebook',
        array(
            'label' => __( 'Facebook', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Twitter */
    $wp_customize->add_setting(
        'the_minimal_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_twitter',
        array(
            'label' => __( 'Twitter', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Instagram */
    $wp_customize->add_setting(
        'the_minimal_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_instagram',
        array(
            'label' => __( 'Instagram', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Google Plus */
    $wp_customize->add_setting(
        'the_minimal_google_plus',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_google_plus',
        array(
            'label' => __( 'Google Plus', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Pinterest */
    $wp_customize->add_setting(
        'the_minimal_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_pinterest',
        array(
            'label' => __( 'Pinterest', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** LinkedIn */
    $wp_customize->add_setting(
        'the_minimal_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_linkedin',
        array(
            'label' => __( 'LinkedIn', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Youtube */
    $wp_customize->add_setting(
        'the_minimal_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_youtube',
        array(
            'label' => __( 'YouTube', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Vimeo */
    $wp_customize->add_setting(
        'the_minimal_vimeo',
        array(
            'default' => '',
            'sanitize_callback' => 'the_minimal_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_vimeo',
        array(
            'label' => __( 'Vimeo', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** OK */
    $wp_customize->add_setting(
        'the_minimal_odnoklassniki',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_odnoklassniki',
        array(
            'label' => __( 'OK', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** VK */
    $wp_customize->add_setting(
        'the_minimal_vk',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_vk',
        array(
            'label' => __( 'VK', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    
    /** Xing */
    $wp_customize->add_setting(
        'the_minimal_xing',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'the_minimal_xing',
        array(
            'label' => __( 'Xing', 'the-minimal' ),
            'section' => 'the_minimal_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        
        /** Custom CSS*/
        $wp_customize->add_section(
            'the_minimal_custom_settings',
            array(
                'title' => __( 'Custom CSS Settings', 'the-minimal' ),
                'priority' => 40,
                'capability' => 'edit_theme_options',
            )
        );
        
        $wp_customize->add_setting(
            'the_minimal_custom_css',
            array(
                'default' => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'the_minimal_sanitize_css'
                )
        );
        
        $wp_customize->add_control(
            'the_minimal_custom_css',
            array(
                'label' => __( 'Custom Css', 'the-minimal' ),
                'section' => 'the_minimal_custom_settings',
                'description' => __( 'Put your custom CSS', 'the-minimal' ),
                'type' => 'textarea',
            )
        );
        /** Custom CSS Ends */
        
    }
    
    /**
     * Sanitization Functions
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
     */ 
    function the_minimal_sanitize_url( $url ){
        return esc_url_raw( $url );
    }
    
    function the_minimal_sanitize_checkbox( $checked ){
        // Boolean check.
	   return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
    
    function the_minimal_sanitize_select( $input, $setting ) {
    	// Ensure input is a slug.
    	$input = sanitize_key( $input );
    	// Get list of choices from the control associated with the setting.
    	$choices = $setting->manager->get_control( $setting->id )->choices;
    	// If the input is a valid key, return it; otherwise, return the default.
    	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
    
    function the_minimal_sanitize_number_absint( $number, $setting ) {
    	// Ensure $number is an absolute integer (whole number, zero or greater).
    	$number = absint( $number );
    	// If the input is an absolute integer, return it; otherwise, return the default
    	return ( $number ? $number : $setting->default );
    }
    
    function the_minimal_sanitize_nohtml( $nohtml ) {
    	return wp_filter_nohtml_kses( $nohtml );
    }
    
    function the_minimal_sanitize_css( $css ) {
    	return wp_strip_all_tags( $css );
    }
}
add_action( 'customize_register', 'the_minimal_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_minimal_customize_preview_js() {
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'the_minimal_customizer', get_template_directory_uri() . '/js' . $build . '/customizer' . $suffix . '..js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'the_minimal_customize_preview_js' );
