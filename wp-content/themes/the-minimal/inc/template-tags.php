<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package The_Minimal
 */

if ( ! function_exists( 'the_minimal_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function the_minimal_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'F jS, Y' ) )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'the-minimal' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'the-minimal' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
    
    $comment_count = sprintf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'the-minimal' ), number_format_i18n( get_comments_number() ) ); 
	
    $comment = sprintf(
		esc_html_x( '%s', 'post comment', 'the-minimal' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $comment_count . '</a>'
	);
    
    echo '<span class="date">' . $posted_on . '</span><span class="name">' . $byline . '</span><span class="comments">' . $comment . '</span>'; // WPCS: XSS OK.    
}
endif;

if ( ! function_exists( 'the_minimal_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function the_minimal_entry_footer() {
	// Hide category and tag text for pages.
	echo '<div class="more-detail">';
    
    if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'the-minimal' ) );
		if ( $categories_list && the_minimal_categorized_blog() ) {
			printf( '<span class="file">' . esc_html__( 'FILED UNDER: %1$s', 'the-minimal' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'the-minimal' ) );
		if ( $tags_list ) {
			printf( '<span class="tag">' . esc_html__( 'TAGGED WITH: %1$s', 'the-minimal' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'the-minimal' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
    
    echo '</div>';
}
endif;

if( ! function_exists( 'the_minimal_pagination' ) ) :
/**
 * Returns numberd pagination
*/
function the_minimal_pagination(){
    the_posts_pagination( array(
        'prev_text'          => __( 'Previous', 'the-minimal' ),
        'next_text'          => __( 'Next', 'the-minimal' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'the-minimal' ) . ' </span>',
     ) );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function the_minimal_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'the_minimal_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'the_minimal_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so the_minimal_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so the_minimal_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in the_minimal_categorized_blog.
 */
function the_minimal_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'the_minimal_categories' );
}
add_action( 'edit_category', 'the_minimal_category_transient_flusher' );
add_action( 'save_post',     'the_minimal_category_transient_flusher' );
