<?php
$blog_list_grid = get_theme_mod( 'blog_list_grid', 'list' );
// list, grid2c, grid3c, msry2c, msry3c

if( $blog_list_grid == 'list' ) {
	$index_archive_layout = 'col-md-12';
} elseif( $blog_list_grid == 'msry2c' ) {
	$index_archive_layout = 'dimasonrybox';
} elseif( $blog_list_grid == 'msry3c' ) {
	$index_archive_layout = 'dimasonrybox';
} elseif( $blog_list_grid == 'grid2c' ) {
	$index_archive_layout = 'col-md-6';
} else { // grid3c
	$index_archive_layout = 'col-md-4';
}

?>
<div class="<?php echo esc_attr( $index_archive_layout ); ?> loop-single-post">
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-inner' ); ?>>

		<?php
			Di_Restaurant_Methods::the_thumbnail();
		?>

		<div class="post-category">
			<?php
			the_category( ' ' );
			?>
		</div>

		<h3 class="the-title post-headline-typog"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php
		if( get_theme_mod( 'dispostdt', 'published' ) == 'published' ) {
			?>
			<div class="post-time"><?php the_date(); ?></div>
			<?php
		} elseif( get_theme_mod( 'dispostdt', 'published' ) == 'updated' ) {
			?>
			<div class="post-time"><?php the_modified_date(); ?></div>
			<?php
		} else {
			echo ''; // Nothing to print.
		}
		?>

		<div class="excerpt-or-content-typog">
			<?php
			if( get_theme_mod( 'excerpt_or_content', 'excerpt' ) == 'excerpt' ) {
				the_excerpt();
			} elseif( get_theme_mod( 'excerpt_or_content', 'excerpt' ) == 'content' ) {
				the_content();
			} else {
				echo ''; // Noting to print
			}
			?>
		</div>

	</div>
</div>
