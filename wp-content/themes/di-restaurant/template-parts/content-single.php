<!--------------------------------loop section start--------------------->
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-inner' ); ?>>

	<?php
		Di_Restaurant_Methods::the_thumbnail();
	?>

	<div class="post-category">
		<?php
		the_category( ' ' );
		?>
	</div>

	<h3 class="the-title post-headline-typog"><?php the_title(); ?></h3>

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
		the_content();
		?>
	</div>

	<?php
	wp_link_pages(
		array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'di-restaurant' ),
		'after'  => '</div>',
		)
	);
	?>

	<?php
	if( get_theme_mod( 'singl_tgs_endis', '1' )  == 1 ) {
		if( has_tag() ) { ?>
			<div class="widgets_sidebar widget_tag_cloud"><div class="tagcloud"><?php the_tags( '', ' ', '' ); ?></div></div>
		<?php
		}
	}
	?>

</div>