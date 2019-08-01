<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TheFour
 */

get_header(); ?>

<section id="content" class="content">

	<?php if ( have_posts() ) : ?>

		<?php
		$paged = max( get_query_var( 'paged' ), 1 );
		if ( 1 < $wp_query->max_num_pages && 1 < $paged ) : ?>
			<div class="page-title">
				<h4><?php printf( esc_html__( 'Page %1$s of %2$s', 'thefour-lite' ), $paged, $wp_query->max_num_pages ); ?></h4>
			</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php
		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text' => esc_html__( '&larr; Previous', 'thefour-lite' ),
			'next_text' => esc_html__( 'Next &rarr;', 'thefour-lite' ),
		) );
		?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
