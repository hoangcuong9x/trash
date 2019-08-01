<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mudita
 */

get_header(); ?>

	<div class="error">
		<h1><?php esc_html_e( '404', 'mudita' ); ?></h1>
		<h2><?php esc_html_e( 'Page not found', 'mudita' ); ?></h2>
		
        <?php 
        $home_link = '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'homepage', 'mudita' ) . '</a>';
        $prev_link = '<a href="javascript:window.history.back();">' . __( 'previous page', 'mudita' ) . '</a>';
        
        printf( __( 'The page you are looking for doesn&apos;t exist or an other error occured. Go to our %1$s or go back to %2$s.', 'mudita' ), $home_link, $prev_link );        
        
        ?>
	</div>
    
<?php
get_footer();