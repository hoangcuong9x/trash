<?php
/**
 * The template part for displaying sidebar.
 *
 * @package TheFour
 */

?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside class="sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
<?php endif; ?>
