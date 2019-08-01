<?php
/**
 * Template Name: Grid
 * Description: Display sub-pages in a grid. Sub-pages should have featured image.
 *
 * @package TheFour
 */

get_header(); ?>

<section id="content" class="content">

	<?php if ( have_posts() ) :  the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'page' ); ?>

	<?php endif; ?>

	<?php
	$query = new WP_Query( array(
		'post_type'      => 'page',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_parent'    => get_the_ID(),
		'posts_per_page' => - 1,
		'no_found_rows'  => true,
	) );
	?>

	<?php if ( $query->have_posts() ) : ?>
		<div class="child-pages grid">
			<?php
			while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'template-parts/content', 'grid' );
			endwhile;
			?>
		</div>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

</section>

<?php get_footer(); ?>
