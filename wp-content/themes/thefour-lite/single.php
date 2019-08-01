<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package TheFour
 */

// Trigger the_post() to setup post data. The data like author info will be used in hero area.
the_post();
?>

<?php get_header(); ?>

<section id="content" class="content">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'thefour-lite' ) . '</span>',
				'after'       => '</div>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'thefour-lite' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>
		</div>

		<footer class="entry-footer">
			<?php
			// Post tags.
			the_tags( '<p class="post-tags">', '', '</p>' );
			thefour_edit_link();
			?>
		</footer>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template( '', true );
		}
		?>

		<?php
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'thefour-lite' ) . '</span> <span class="screen-reader-text">' . esc_html__( 'Next post:', 'thefour-lite' ) . '</span> <span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'thefour-lite' ) . '</span> <span class="screen-reader-text">' . esc_html__( 'Previous post:', 'thefour-lite' ) . '</span> <span class="post-title">%title</span>',
		) );
		?>

	</article>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
