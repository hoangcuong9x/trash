<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpazure
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('az-single-post'); ?>>
	<div class="post-inner">
		<?php 
			wpazure_post_thumbnail();
		?>
		<div class="post-info">
			<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
				
			</header>
			<div class="entry-content">
				<?php the_content( __('Read More','wpazure') ); ?>
				<?php wp_link_pages( ); ?>
			</div>
			
		</div>
	</div>
</article>