<?php
/**
 * The template for displaying standard post formats.
 * Used for index/archive/search.
 *
 * @package TheFour
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><?php esc_html_e( 'Featured', 'thefour-lite' ); ?></span>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/content', 'media' ); ?>

	<div class="entry-text">
		<header class="entry-header">
			<div class="entry-meta">
				<?php thefour_posted_on(); ?>
			</div>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>

		<div class="entry-summary clearfix">
			<?php
			$post_format  = get_post_format( get_the_ID() );
			$main_content = apply_filters( 'the_content', get_the_content( sprintf(
				__( 'Continue reading &rarr; %s', 'thefour-lite' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) ) );
			if ( 'audio' === $post_format || 'video' === $post_format ) {
				$media = get_media_embedded_in_content( $main_content, array(
					'audio',
					'video',
					'object',
					'embed',
					'iframe',
				) );
				$main_content = str_replace( $media, '', $main_content );
			}
			echo $main_content; /* WPCS: xss ok. */

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'thefour-lite' ) . '</span>',
				'after'       => '</div>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'thefour-lite' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			thefour_edit_link();
			?>
		</div>
	</div>
</article>
