<?php
/**
 * Colors Customizer panel
 *
 * @package Wpazure
 */

/**
 * Colors panel
 */
Wpazure_Kirki::add_panel( 'azure_panel_colors', array(
    'priority'    => 25,
    'title'       => esc_attr__( 'Colors', 'wpazure' ),
) );

/**
 * General
 */
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'color_primary',
	'label'       => esc_attr__( 'Primary color', 'wpazure' ),
	'section'     => 'colors',
	'default'     => '#f5443a',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.woocommerce .product_meta a:hover, .woocommerce p.stars a, .woocommerce .star-rating span',
			'property' => 'color',
		),	
		array(
			'element'  => '.woocommerce span.onsale, .woocommerce button.button, .woocommerce a.button, .woocommerce nav.woocommerce-pagination ul li span.current , .wpcf7-form-control .wpcf7-submit, input[type="submit"], .post-inner .read-more-link',
			'property' => 'background-color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '.az-footer, .copyright-section .copyright, .not-footer-copyright-section .copyright',
			'property' => 'border-top-color',
		),
	),			
) );


/**
 * Blog colors
 */
Wpazure_Kirki::add_section( 'azure_section_colors_blog', array(
    'title'       	 => esc_attr__( 'Blog', 'wpazure' ),
	'panel'          => 'azure_panel_colors',
    'priority'       => 12,
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'color_index_post_title',
	'label'       => esc_attr__( 'Post title (archives)', 'wpazure' ),
	'section'     => 'azure_section_colors_blog',
	'default'     => '#1b1a1a',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.blog .entry-title a',
			'property' => 'color',
		),
	),
) );
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'color_single_post_title',
	'label'       => esc_attr__( 'Post title (single)', 'wpazure' ),
	'section'     => 'azure_section_colors_blog',
	'default'     => '#1b1a1a',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.single .entry-title a',
			'property' => 'color',
		),
	),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'blog_color_meta_text',
	'label'       => esc_attr__( 'Meta text', 'wpazure' ),
	'section'     => 'azure_section_colors_blog',
	'default'     => '#bfbfbf',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.az-single-post .entry-meta, .blog-loop .entry-meta',
			'property' => 'color',
		),
	),
) );
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'color_meta_links',
	'label'       => esc_attr__( 'Meta links', 'wpazure' ),
	'section'     => 'azure_section_colors_blog',
	'default'     => '#595959',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.az-single-post .entry-meta .bytext a, .az-single-post .entry-meta a, .az-single-post  .posted-on a, .az-single-post .comments-link a, .az-single-post .cat-links a, .az-single-post .az-tags a',
			'property' => 'color',
			'suffix' 	=> '!important',
		),
	),
) );
Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'color_post_text',
	'label'       => esc_attr__( 'Body text', 'wpazure' ),
	'section'     => 'azure_section_colors_blog',
	'default'     => '#595959',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.az-single-post .entry-content, .blog-loop .entry-content',
			'property' => 'color',
		),
		array(
			'element'  => '.editor-block-list__layout, .editor-block-list__layout .editor-block-list__block',
			'context'  => array( 'editor' ),
		),		
	),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'color_post_readmore',
	'label'       => esc_attr__( 'Read more text color', 'wpazure' ),
	'section'     => 'azure_section_colors_blog',
	'default'     => '#ffffff',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.read-more-link',
			'property' => 'color',
			'suffix'   => '!important',
		),	
	),
) );



/**
 * Footer Widgets
 */

Wpazure_Kirki::add_section( 'azure_section_colors_footer_widgets', array(
    'title'       	 => esc_attr__( 'Footer widgets', 'wpazure' ),
	'panel'          => 'azure_panel_colors',
    'priority'       => 12,
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'footer_background_color',
	'label'       => __( 'Footer widget background color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_widgets',
	'default'     => '#171717',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.az-footer, .copyright-section',
			'property' => 'background-color',
		),
	),	
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'footer_widget_title_color',
	'label'       => __( 'Widget title color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_widgets',
	'default'     => '#ffffff',
	'transport'	 => 'auto',
	'output' => array(
		array(
			'element'  => '.az-footer .widget-title',
			'property' => 'color',
		),
	),	
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'footer_widget_text_color',
	'label'       => __( 'Widget text color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_widgets',
	'default'     => '#979797',
	'output' => array(
		array(
			'element'  => '.az-footer',
			'property' => 'color',
		),
	),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'footer_widget_link_color',
	'label'       => __( 'Widget link color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_widgets',
	'default'     => '#979797',
	'output' => array(
		array(
			'element'  => '.az-footer a',
			'property' => 'color',
		),
	),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'footer_widget_link_hover_color',
	'label'       => __( 'Widget link hover color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_widgets',
	'default'     => '#ffffff',
	'output' => array(
		array(
			'element'  => '.az-footer a:hover',
			'property' => 'color',
		),
	),
) );

/**
 * Footer Bar
 */

Wpazure_Kirki::add_section( 'azure_section_colors_footer_bar', array(
    'title'       	 => esc_attr__( 'Footer bar', 'wpazure' ),
	'panel'          => 'azure_panel_colors',
    'priority'       => 13,
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'azure_footer_bar_bg_color',
	'label'       => __( 'Footer bar background color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_bar',
	'default'     => '#1c1c1c',
	'output' => array(
		array(
			'element'  => '.copyright-section .copyright,.not-footer-copyright-section .copyright',
			'property' => 'background-color',
		),
	),
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'azure_footer_bar_text_color',
	'label'       => __( 'Footer bar text color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_bar',
	'default'     => '#979797',
	'output' => array(
		array(
			'element'  => '.copyright-section .copyright p, .not-footer-copyright-section .copyright, .footerbar-left-content, .footerbar-right-content',
			'property' => 'color',
		),
	),
) );

Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'azure_footer_bar_link_color',
	'label'       => __( 'Footer bar link color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_bar',
	'default'     => '#979797',
	'output' => array(
		array(
			'element'  => '.copyright-section .copyright a,.not-footer-copyright-section .copyright a',
			'property' => 'color',
		),
	),
) );


Wpazure_Kirki::add_field( 'wpazure', array(
	'type'        => 'color',
	'settings'    => 'azure_footer_bar_link_hover_color',
	'label'       => __( 'Footer bar link hover color', 'wpazure' ),
	'section'     => 'azure_section_colors_footer_bar',
	'default'     => '#fff',
	'output' => array(
		array(
			'element'  => '.copyright-section .copyright a:hover, .not-footer-copyright-section .copyright a:hover',
			'property' => 'color',
		),
	),
) );