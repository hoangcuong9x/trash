<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mudita
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <?php if( ! is_single() && has_post_thumbnail() ){ ?>
        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
            <?php is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'mudita-with-sidebar' ) : the_post_thumbnail( 'mudita-without-sidebar' ) ;?>
        </a>
    <?php } ?>
    
    <header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h2 class="entry-title">', '</h2>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php mudita_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
    
    <?php if( is_single() && has_post_thumbnail() ){ ?>
        <div class="post-thumbnail">
            <?php is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'mudita-with-sidebar' ) : the_post_thumbnail( 'mudita-without-sidebar' ) ;?>
        </div>
    <?php } ?>
    
	<div class="entry-content">
		<?php
			if( is_single() ){
                the_content( sprintf(
    				/* translators: %s: Name of current post. */
    				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mudita' ), array( 'span' => array( 'class' => array() ) ) ),
    				the_title( '<span class="screen-reader-text">"', '"</span>', false )
    			) );
            }else{
                if( false === get_post_format() ){
                    the_excerpt();
                }else{
                    the_content( sprintf(
        				/* translators: %s: Name of current post. */
        				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mudita' ), array( 'span' => array( 'class' => array() ) ) ),
        				the_title( '<span class="screen-reader-text">"', '"</span>', false )
        			) );
                }
            }

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mudita' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
        <?php if( ! is_single() ){ ?>
        <div class="btn-holder">
			<a href="<?php the_permalink(); ?>" class="btn-learnmore"><?php esc_html_e( 'Learn More ', 'mudita' ); ?><span class="icon"></span></a>
		</div>
		<?php } ?>
        <?php mudita_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
