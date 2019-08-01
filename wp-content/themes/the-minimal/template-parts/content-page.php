<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The_Minimal
 */

global $post;

$sidebar_layout = the_minimal_sidebar_layout();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    
    <?php
        if( has_post_thumbnail() ){
            if( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' )){ 
                the_post_thumbnail( 'the-minimal-image', array( 'itemprop' => 'image' ) );
            }else{
                the_post_thumbnail( 'the-minimal-image-full', array( 'itemprop' => 'image' ) );
            }
        }
    ?>
    
	<div class="entry-content" itemprop="text">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-minimal' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'the-minimal' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
