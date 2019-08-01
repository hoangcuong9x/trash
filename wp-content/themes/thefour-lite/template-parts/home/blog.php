<?php
/**
 * The template part for displaying latest blog posts in the frontend.
 *
 * @package TheFour
 */

$query = new WP_Query( array(
	'posts_per_page' => 6,
	'post_type'      => 'post',
	'post_status'    => 'publish',
) );

if ( ! $query->have_posts() ) {
	return;
}
?>

<section class="section blog">

	<h2><?php echo esc_html( __( 'Recent Posts', 'thefour-lite' ) ); ?></h2>

	<div class="grid">
		<?php
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part( 'template-parts/content', 'grid' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>

</section>
