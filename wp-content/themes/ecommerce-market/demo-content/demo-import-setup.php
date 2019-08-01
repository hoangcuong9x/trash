<?php
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package eCommerce_Market
 */
/**
* Remove branding
*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/*Import demo data*/
if ( ! function_exists( 'ecommerce_market_demo_import_files' ) ) :
    function ecommerce_market_demo_import_files() {
        return array(
            array(
                'import_file_name'             => 'eCommerce Market',  
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/demoecommerce.wordpress.2018-02-16.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/demo.rigorousthemes.com-demo-test-widgets.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/ecommerce-market-export.dat',           
                'import_notice'                => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.It may take around 6-30 minutes depending upon your hosting.', 'ecommerce-market' ),
            ),

        );  
    }
    add_filter( 'pt-ocdi/import_files', 'ecommerce_market_demo_import_files' );
endif;

/**
 * Action that happen after import
 */
if ( ! function_exists( 'ecommerce_market_after_demo_import' ) ) :
function ecommerce_market_after_demo_import( $selected_import ) {
    
        //Set Menu
        $primary_menu = get_term_by('name', 'Primary menu', 'nav_menu');   
        $top_menu = get_term_by('name', 'Top menu', 'nav_menu');
        $social_menu = get_term_by('name', 'Social links', 'nav_menu');     
        set_theme_mod( 'nav_menu_locations' , array( 
              'menu-1' => $primary_menu->term_id,
              'top-menu' => $top_menu->term_id,
              'social-menu' => $social_menu->term_id, 


             ) 
        );

    // Set Up the Front page
        $front_page = get_page_by_title( 'Home' );
        $blog_page  = get_page_by_title( 'Blogs' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page -> ID );
        update_option( 'page_for_posts', $blog_page -> ID );
  
    
}
add_action( 'pt-ocdi/after_import', 'ecommerce_market_after_demo_import' );
endif;







