<?php
/**
 * The template part for displaying image section in the frontend.
 *
 * @package TheFour
 */

$image = get_theme_mod( 'front_page_image' );
$title = get_theme_mod( 'front_page_image_title' );

if ( ! $image ) {
	return;
}

$alt = '';
$image_id = function_exists( 'wpcom_vip_attachment_url_to_postid' ) ? wpcom_vip_attachment_url_to_postid( $image ) : attachment_url_to_postid( $image );
if ( $image_id ) {
	$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
}
?>

<section class="section image">

	<?php if ( $title ) : ?>
		<h2><?php echo esc_html( $title ); ?></h2>
	<?php endif; ?>

	<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>">

</section>
