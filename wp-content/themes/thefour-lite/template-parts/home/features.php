<?php
/**
 * The template part that shows features page on the front page.
 *
 * @package TheFour
 */

$features_page = get_theme_mod( 'front_page_features_page' );
if ( ! $features_page ) {
	return;
}

$post = get_post( $features_page );
setup_postdata( $post );
?>

<section class="intro section">

	<?php the_title( '<h2>', '</h2>' ); ?>

	<div class="features">
		<?php
		the_content();
		thefour_edit_link();
		?>
	</div>

</section>

<?php wp_reset_postdata(); ?>
