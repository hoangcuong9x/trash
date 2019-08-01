<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheFour
 */

?>

</main>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="footer-widgets grid clearfix">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php endif; ?>

		<div class="site-info clearfix">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'thefour-lite' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'thefour-lite' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'thefour-lite' ), '<a href="https://gretathemes.com/wordpress-themes/thefour/">TheFour Lite</a>', 'GretaThemes' ); ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->

</div><!-- .wrapper -->

<nav class="mobile-navigation" role="navigation">
	<?php
	wp_nav_menu( array(
		'container_class' => 'mobile-menu',
		'menu_class'      => 'mobile-menu clearfix',
		'theme_location'  => 'menu-1',
		'items_wrap'      => '<ul>%3$s</ul>',
	) );
	?>
</nav>

<?php wp_footer(); ?>
</body>
</html>
