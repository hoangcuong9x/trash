<?php
/**
 * The template for displaying aside post formats
 * Used for index/archive/search.
 *
 * @package TheFour
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<a class="permalink" href="<?php the_permalink(); ?>">&infin;</a>
		<?php thefour_edit_link(); ?>
	</div>
</article>
