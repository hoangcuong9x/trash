<?php
/**
 * The template for displaying all pages.
 *
 * @package TheFour
 */

get_header(); ?>

<section id="content" class="content">

	<?php if ( have_posts() ) :  the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'page' ); ?>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template( '', true );
		}
		?>

	<?php endif; ?>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
