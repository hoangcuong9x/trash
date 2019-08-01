<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mudita
 */

get_header();

    $enabled_sections = mudita_get_sections();
    
    if( $enabled_sections ) echo '<div id="next_section"></div>';
    
    foreach( $enabled_sections as $section ){ ?>
        <section class="<?php echo esc_attr( $section['class'] ); ?>" id="<?php echo esc_attr( $section['id'] ); ?>">
            <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
        </section>
    <?php
    }
	
get_footer();