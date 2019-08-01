<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-inner' ); ?>>

	<?php
		Di_Restaurant_Methods::the_thumbnail();
	?>

	<h3 class="the-title"><?php the_title(); ?></h3>

	<?php
	the_content();
	?>

	<?php
	wp_link_pages(
		array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'di-restaurant' ),
		'after'  => '</div>',
		)
	);
	?>

</div>
