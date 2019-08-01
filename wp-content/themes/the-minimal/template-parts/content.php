<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The_Minimal
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="meta-info">
			<?php the_minimal_posted_on(); ?>
		</div><!-- .meta-info -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
    
    <?php 
    if( has_post_thumbnail() ){ 
        if( is_single() ){ ?>
            <div class="post-thumbnail">
                <?php is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'the-minimal-image', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'the-minimal-image-full', array( 'itemprop' => 'image' ) ) ; ?>
            </div>
        <?php }else{ ?>
            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                <?php is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'the-minimal-image', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'the-minimal-image-full', array( 'itemprop' => 'image' ) ) ;?>
            </a>
        <?php } 
    } ?>
    
	<div class="entry-content" itemprop="text">
		<?php
			if( is_single() ){
                the_content( sprintf(
    				/* translators: %s: Name of current post. */
    				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'the-minimal' ), array( 'span' => array( 'class' => array() ) ) ),
    				the_title( '<span class="screen-reader-text">"', '"</span>', false )
    			) );
            }else{
                $format = get_post_format();
                if( false === $format ){
                    the_excerpt();                    
                }else{
                    the_content();
                }                
            }
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-minimal' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    
    <?php if( ! is_single() ){ ?>
        <a href="<?php the_permalink(); ?>" class="continue-reading"><?php esc_html_e( 'Continue Reading', 'the-minimal' ); ?></a>
    <?php } ?>
    
	<footer class="entry-footer">
		<?php the_minimal_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
