<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package TheFour
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() ) : ?>

	<div class="comments" id="comments">

		<h2 class="comments-title">
			<?php comments_number( false, esc_html__( '1 Comment', 'thefour-lite' ), esc_html__( '% Comments', 'thefour-lite' ) ); ?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 50,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation( array(
			'prev_text' => esc_html__( '&larr; Older comments', 'thefour-lite' ),
			'next_text' => esc_html__( 'Newer comments &rarr;', 'thefour-lite' ),
		) ); ?>

	</div><!-- .comments -->

<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'thefour-lite' ); ?></p>
<?php endif; ?>

<?php
comment_form();
