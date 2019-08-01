<?php
/**
 * Sidebar Function for Wpazure Theme
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/

function wpazure_widgets_init(){
	register_sidebar( 
				array(
					'name'          => esc_html__( 'Sidebar', 'wpazure' ),
					'id'            => 'sidebar-1',
					'description'   => esc_html__( 'Add widgets here.', 'wpazure' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				) 
		);
	
	register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Bar Section 1', 'wpazure' ),
					'id'            => 'footer-widget-1',
					'description'   => '',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			
		);
		
	register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Bar Section 2', 'wpazure' ),
					'id'            => 'footer-widget-2',
					'description'   => '',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			
		);
		
	register_sidebar( 
				array(
					'name' => esc_html__('WooCommerce sidebar widget area', 'wpazure' ),
					'id' => 'woocommerce',
					'description' => esc_html__( 'WooCommerce sidebar widget area', 'wpazure' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h2 class="widget-title">',
					'after_title' => '</h2>',
				) 
	);
	
	if ( !is_plugin_active( 'wpazure-pro/wpazure-pro.php' ) ) {
    
		//Footer widget areas
		$wpazureWidgetAreas = get_theme_mod( 'azure_footer_widgt_layout', 'layout-3' );
		if($wpazureWidgetAreas !='footer_off'){
			for ( $i=1; $i <= 3; $i++ ){
				register_sidebar( 
							array(
								'name'          => __( 'Footer ', 'wpazure' ) . $i,
								'id'            => 'footer-' . $i,
								'description'   => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h3 class="widget-title">',
								'after_title'   => '</h3>',
							) 
					);
			}
		}
	}
		
}
add_action( 'widgets_init', 'wpazure_widgets_init' );