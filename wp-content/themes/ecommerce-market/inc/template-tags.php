<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package eCommerce_Market
 */

if ( ! function_exists( 'ecommerce_market_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time .
	 */
	function ecommerce_market_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'ecommerce-market' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="date">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}

endif;

if ( ! function_exists( 'ecommerce_market_author_info' ) ) :
	/**
	 * Prints HTML with meta information for the current  author.
	 */
	function ecommerce_market_author_info() {

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by: %s', 'post author', 'ecommerce-market' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);	


	echo '<span class="user-links">' . $byline . '</span>'; // WPCS: XSS OK.

	}
	
endif;

if ( ! function_exists( 'ecommerce_market_categories_list' ) ) :
	/**
	 *   Prints HTML with meta information for the categories, tags.
	 *
	 */
	function ecommerce_market_categories_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ' ', 'ecommerce-market' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Category: %1$s', 'ecommerce-market' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ecommerce-market' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ecommerce-market' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

	}

	
endif;


if ( ! function_exists( 'ecommerce_market_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the  comments.
	 */
	function ecommerce_market_entry_footer() {

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ecommerce-market' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ecommerce-market' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
