<?php
/**
 * Getting started section.
 *
 * @package TheFour Lite
 */

?>
<div id="getting-started" class="gt-tab-pane gt-is-active">
	<div class="feature-section two-col">
		<div class="col">

			<h3><?php esc_html_e( 'Customize The Theme', 'thefour-lite' ); ?></h3>
			<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'thefour-lite' ); ?></p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php esc_html_e( 'Start Customize', 'thefour-lite' ); ?></a>
			</p>

			<h3><?php esc_html_e( 'Read Full Documentation', 'thefour-lite' ); ?></h3>
			<p class="about"><?php esc_html_e( 'Need any help to setup and configure the theme? Please check our full documentation for detailed information on how to use it.', 'thefour-lite' ); ?></p>
			<p>
				<a href="<?php echo esc_url( "https://gretathemes.com/docs/{$this->pro_slug}/{$this->utm}" ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Read Documentation', 'thefour-lite' ); ?></a>
			</p>
		</div>

		<div class="col">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.jpg" alt="<?php esc_attr_e( 'screenshot', 'thefour-lite' ); ?>">
		</div>
	</div>
	<?php include get_stylesheet_directory() . '/inc/dashboard/sections/recommended-themes.php'; ?>
</div>
