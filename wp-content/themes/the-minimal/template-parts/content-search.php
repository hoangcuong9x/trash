<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The_Minimal
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="meta-info">
			<?php the_minimal_posted_on(); ?>
		</div><!-- .meta-info -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
    
    <a href="<?php the_permalink(); ?>" class="continue-reading"><?php esc_html_e( 'Continue Reading', 'the-minimal' ); ?></a>
    
	<footer class="entry-footer">
		<?php the_minimal_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
