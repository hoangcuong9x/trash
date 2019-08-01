<?php
/**
 * Display an optional post thumbnail, gallery, video in according to post formats
 * above the post excerpt in the archive page.
 *
 * @package TheFour
 */

// Do not display entry media for password protected posts.
if ( post_password_required() ) {
	return;
}

if ( has_post_format( array( 'video', 'audio' ) ) ) {
	$main_content = apply_filters( 'the_content', get_the_content() );
	$media        = get_media_embedded_in_content( $main_content, array(
		'video',
		'audio',
		'object',
		'embed',
		'iframe',
	) );

	if ( $media ) {
		echo '<div class="entry-media">' . reset( $media ) . '</div>'; /* WPCS: xss ok. */

		return;
	}
}

if ( ! has_post_thumbnail() ) {
	return;
}

$size      = is_page() ? 'thefour-grid-thumbnail' : 'thefour-list-thumbnail';
$thumbnail = get_the_post_thumbnail( null, $size );
if ( ! $thumbnail ) {
	return;
}
?>
<div class="entry-media">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( $size ); ?>
	</a>
</div>
