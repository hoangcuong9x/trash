<?php
/**
 * Blog Customizer panel
 *
 */
 
Wpazure_Kirki::add_panel( 'wpazure_blog', array(
    'priority'    => 30,
    'title'       => __( 'Blog', 'wpazure' ),
) );

//Index and Archive section
Wpazure_Kirki::add_section( 'azure_blog_archive', array(
    'title'       	 => __( 'Blog / Archive', 'wpazure' ),
    'panel'          => 'wpazure_blog',
    'priority'       => 12,
) );


//Single posts section
Wpazure_Kirki::add_section( 'azure_single_posts', array(
    'title'       	 => __( 'Single posts', 'wpazure' ),
    'panel'          => 'wpazure_blog',
    'priority'       => 13,
) );

/*Starting Blog and Archive controls */

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio-image',
	'settings'    => 'blog_layout',
	'label'       => __( 'Blog layout', 'wpazure' ),
	'section'     => 'azure_blog_archive',
	'default'     => 'right_sidebar',
	'choices'     => array(
	'right_sidebar'   => WPAZURE_THEME_URI . '/images/customizer/blog-layout/blog-right-sidebar.png',
	'full_width' => WPAZURE_THEME_URI . '/images/customizer/blog-layout/blog-full-width.png',
	),
	
) );


/*Seprater between control*/
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => 'separator_after_blog_layout',
	'section'     => 'azure_blog_archive',
	'default'     => '<hr>',
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'select',
	'settings'    => 'post_content_type',
	'label'       => esc_html__( 'Blog post content', 'wpazure' ),
	'section'     => 'azure_blog_archive',
	'default'     => 'full_content',
	'choices'     => array(
		'full_content' => esc_html__( 'Full content', 'wpazure' ),
		'excerpt' => esc_html__( 'Excerpt', 'wpazure' ),
	),
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'number',
	'settings'    => 'excerpt_length',
	'label'       => esc_html__( 'Excerpt length', 'wpazure' ),
	'section'     => 'azure_blog_archive',
	'default'     => 10,
	'choices'     => array(
		'min'  => 5,
		'max'  => 100,
		'step' => 1,
	),
	'active_callback'    => array(
        array(
            'setting'  => 'post_content_type',
            'value'    => 'excerpt',
            'operator' => '==',
        ),
    ),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'     => 'text',
	'settings' => 'blog_post_readmore_button_text',
	'label'    => esc_html__( 'Read more text', 'wpazure' ),
	'description' => esc_html__('Leave empty to hide', 'wpazure'),
	'section'  => 'azure_blog_archive',
	'default'  => esc_html__( 'Read more', 'wpazure' ),
	'active_callback'    => array(
        array(
            'setting'  => 'post_content_type',
            'value'    => 'excerpt',
            'operator' => '==',
        ),
    ),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => '',
	'section'     => 'azure_blog_archive',
	'default'     => '<hr>',
) );



Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'sortable',
	'settings'    => 'azure_blog_structure',
	'label'       => esc_html__( 'Blog post structure', 'wpazure' ),
	'section'     => 'azure_blog_archive',
	'default'     => array(
		'post_thumnail',
		'post_title',
		'post_meta',
		'post_content',
	),
	'choices'     => array(
		'post_thumnail' => esc_html__( 'Featured image', 'wpazure' ),
		'post_title' => esc_html__( 'Title', 'wpazure' ),
		'post_meta' => esc_html__( 'Blog Meta', 'wpazure' ),
		'post_content' => esc_html__( 'Blog Content', 'wpazure' ),
		
	),
	
) );

// Blog Meta Structure

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => 'blog_meta_structure_seprater',
	'section'     => 'azure_blog_archive',
	'default'     => '<hr>',
	'active_callback'    => array(
        array(
            'setting'  => 'azure_blog_structure',
            'value'    => 'post_meta',
            'operator' => 'contains',
        ),
    ),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'sortable',
	'settings'    => 'blog_meta_structure',
	'label'       => esc_html__( 'Blog meta structure', 'wpazure' ),
	'section'     => 'azure_blog_archive',
	'default'     => array(
		'author',
		'date',
		'comment',
		'category',
		'tag',
	),
	'choices'     => array(
		'author' => esc_html__( 'Author', 'wpazure' ),
		'date' => esc_html__( 'Date', 'wpazure' ),
		'comment' => esc_html__( 'Comment', 'wpazure' ),
		'category' => esc_html__( 'Category', 'wpazure' ),
		'tag' => esc_html__( 'Tag', 'wpazure' ),
	),
	'active_callback'    => array(
        array(
            'setting'  => 'azure_blog_structure',
            'value'    => 'post_meta',
            'operator' => 'contains',
        ),
    ),
	
) );

/*End Blog and Archive controls */

/*Starting Single post controls */

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'radio-image',
	'settings'    => 'single_post_layout',
	'label'       => __( 'Single post layout', 'wpazure' ),
	'section'     => 'azure_single_posts',
	'default'     => 'right_sidebar',
	'choices'     => array(
		'right_sidebar'   => WPAZURE_THEME_URI . '/images/customizer/blog-layout/blog-right-sidebar.png',
		'full_width' => WPAZURE_THEME_URI . '/images/customizer/blog-layout/blog-full-width.png',
	),
	
) );

/*Seprater between control*/
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => 'separator_after_single_post_layout',
	'section'     => 'azure_single_posts',
	'default'     => '<hr>',
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'sortable',
	'settings'    => 'azure_single_post',
	'label'       => esc_html__( 'Single Blog post', 'wpazure' ),
	'section'     => 'azure_single_posts',
	'default'     => array(
		'post_thumnail',
		'post_title',
		'post_meta',
		'post_content',
	),
	'choices'     => array(
		'post_thumnail' => esc_html__( 'Featured image', 'wpazure' ),
		'post_title' => esc_html__( 'Title', 'wpazure' ),
		'post_meta' => esc_html__( 'Blog Meta', 'wpazure' ),
		'post_content' => esc_html__( 'Blog Content', 'wpazure' ),
		
	),
	
) );



// Blog Meta Structure

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'custom',
	'settings'    => 'single_blog_meta_seprater',
	'section'     => 'azure_single_posts',
	'default'     => '<hr>',
	'active_callback'    => array(
        array(
            'setting'  => 'azure_single_post',
            'value'    => 'post_meta',
            'operator' => 'contains',
        ),
    ),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'sortable',
	'settings'    => 'single_blog_meta',
	'label'       => esc_html__( 'Single blog meta', 'wpazure' ),
	'section'     => 'azure_single_posts',
	'default'     => array(
		'author',
		'date',
		'comment',
		'category',
		'tag',
	),
	'choices'     => array(
		'author' => esc_html__( 'Author', 'wpazure' ),
		'date' => esc_html__( 'Date', 'wpazure' ),
		'comment' => esc_html__( 'Comment', 'wpazure' ),
		'category' => esc_html__( 'Category', 'wpazure' ),
		'tag' => esc_html__( 'Tag', 'wpazure' ),
	),
	'active_callback'    => array(
        array(
            'setting'  => 'azure_single_post',
            'value'    => 'post_meta',
            'operator' => 'contains',
        ),
    ),
	
) );