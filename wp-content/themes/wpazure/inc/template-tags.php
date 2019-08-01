<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Azure
 */

 
 
/**
 * Site branding
 */
if ( !function_exists( 'wpazure_site_branding' ) ) {
	function wpazure_site_branding()
	{
		if ( has_custom_logo() ) :
				the_custom_logo();
		else : ?>
			<div class="site-branding-text">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html($description); ?></p><?php 
				endif;?>
			</div>
			<?php
		
		endif;
	}
}
/**
* Blog post meta date */
 
if ( ! function_exists( 'wpazure_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wpazure_posted_on() {
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
		

		$posted_on = '<li class="posted-on"><i class="fa fa-clock-o" aria-hidden="true"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></li>';

		echo  $posted_on ;
	}
endif;


/**
* Blog post meta post by 
*/
if ( ! function_exists( 'wpazure_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wpazure_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'wpazure' ),
			'<a class="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		echo '<li class="bytext"> ' . $byline . '</li>'; // WPCS: XSS OK.
	}
endif;

/**
* Blog post featured image 
*/
if ( ! function_exists( 'wpazure_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function wpazure_post_thumbnail() {
				
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() ) :
	?>
	<div class="post-img">
		<?php the_post_thumbnail( 'wpazure-720' ); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>
	<div class="post-img">
		<a  href="<?php the_permalink(); ?>" class="post-thumbnail" aria-hidden="true">
			<?php
				the_post_thumbnail( '', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
					'class' => 'img-fluid mx-auto',
					
				) );
			?>
		</a>
	</div>

	<?php endif; // End is_singular().
}
endif;



/**
 * All categories
 */
if ( ! function_exists( 'wpazure_all_categories' ) ) :
function wpazure_all_categories() {
	$Separate_meta = ' ';
	$categories_list = get_the_category_list($Separate_meta);

	if ( $categories_list ) {
		echo '<li class="cat-links"> <i class="fa fa-folder-open" aria-hidden="true"></i>' . $categories_list . '</li>';
	}
}
endif;

/**
 * Get the comments
 */

if ( ! function_exists( 'wpazure_get_comments_number' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function wpazure_get_comments_number() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link"> <i class="fa fa-comments" aria-hidden="true"></i>';
			
			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<li class="screen-reader-text"> on %s</li>', 'wpazure' ), get_the_title() ) );

			echo '</li>';
		}
	}
endif;

if ( ! function_exists( 'wpazure_get_tags' ) ) :
function wpazure_get_tags(){
	
/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list();
	if ( $tag_list ) {
	echo '<li class="az-tags"> <i class="fa fa-tags" aria-hidden="true"></i>' . $tag_list .'</li>';
	}
}
endif;