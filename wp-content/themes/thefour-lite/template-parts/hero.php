<?php
/**
 * Display the content in the hero area.
 *
 * @package TheFour
 */

/**
 * For static front page: show the page content.
 */
if ( is_front_page() && ! is_home() ) {
	the_post();
	the_content();

	thefour_edit_link();
	return;
}

/**
 * For normal pages and static blog page: show page title.
 */
if ( is_page() || ( is_home() && ! is_front_page() ) ) {
	$page_id = is_page() ? get_the_ID() : get_option( 'page_for_posts' );
	echo '<h1>' . get_the_title( $page_id ) . '</h1>';

	return;
}

/**
 * For single post: show entry meta and title.
 */
if ( is_single() ) :
	?>
	<?php thefour_posted_on(); ?>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<p class="entry-meta"><?php thefour_entry_meta(); ?></p>
	<?php
	return;
endif;

/**
 * For other archive pages.
 */
if ( is_search() ) {
	echo '<h2>';
	echo esc_html( sprintf( __( 'Search results: "%s"', 'thefour-lite' ), get_search_query() ) );
	echo '</h2>';
} elseif ( is_404() ) {
	echo '<h1>' . esc_html__( 'Not found', 'thefour-lite' ) . '</h1>';
} elseif ( is_category() || is_archive() ) {
	the_archive_title( '<h2>', '</h2>' );
	the_archive_description( '<h3>', '</h3>' );
}
