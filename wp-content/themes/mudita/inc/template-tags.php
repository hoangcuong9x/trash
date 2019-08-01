<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mudita
 */

if ( ! function_exists( 'mudita_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mudita_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'j M Y' ) )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'mudita' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'mudita' ),
		'<span class="author vcard"><span class="fa fa-user"></span><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on"><span class="fa fa-calendar-o"></span>' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    
    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><span class="fa fa-comment"></span>';
		comments_popup_link( esc_html__( 'Leave a comment', 'mudita' ), esc_html__( '1 Comment', 'mudita' ), esc_html__( '% Comments', 'mudita' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'mudita_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mudita_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'mudita' ) );
		if ( $categories_list && mudita_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'mudita' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'mudita' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( '%1$s', 'mudita' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'mudita' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mudita_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mudita_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mudita_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mudita_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mudita_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mudita_categorized_blog.
 */
function mudita_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mudita_categories' );
}
add_action( 'edit_category', 'mudita_category_transient_flusher' );
add_action( 'save_post',     'mudita_category_transient_flusher' );
