<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package TheFour
 */

?>

<article class="no-results not-found">
	<header class="entry-header">
		<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'thefour-lite' ); ?></h2>
	</header>

	<div class="entry-content clearfix">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				printf(
					wp_kses_post( __( 'Ready to publish your first post? %s.', 'thefour-lite' ) ),
					'<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">' . esc_html__( 'Get started here', 'thefour-lite' ) . '</a>'
				);
				?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'thefour-lite' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'thefour-lite' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</article>
