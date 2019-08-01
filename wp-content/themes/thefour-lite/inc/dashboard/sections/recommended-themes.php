<?php
/**
 * More themes section.
 *
 * @package TheFour Lite
 */

$themes = array(
	'eros'       => 'Eros',
	'floral'     => 'Floral',
	'eightydays' => 'Eightydays',
	'thefour'    => 'TheFour',
	'yosemite'   => 'Yosemite',
	'bayn'       => 'Bayn',
);
// Check if theme is included in here.
if ( in_array( $this->pro_slug, array_keys( $themes ) ) ) {
	unset( $themes[ $this->pro_slug ] );
}
?>
<h3 class="more-themes"><?php esc_html_e( 'More themes from us', 'thefour-lite' ); ?></h3>
<div class="recommended-themes">
	<?php foreach ( $themes as $slug => $theme ) : ?>
		<?php
		$theme_url = "https://gretathemes.com/wordpress-themes/{$slug}/{$this->utm}";
		$demo_url  = "https://demo.gretathemes.com/{$slug}";
		?>
		<div class="recommended-theme">
			<a href="<?php echo esc_url( $theme_url ); ?>">
				<figure>
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . "/inc/dashboard/images/{$slug}.jpg" ); ?>" alt="<?php echo esc_attr( $theme ); ?>">
				</figure>
			</a>
			<div class="entry-header">
				<h3><a href="<?php echo esc_url( $theme_url ); ?>"><?php echo esc_html( $theme ); ?></a></h3>
				<a href="<?php echo esc_url( $demo_url ); ?>"><?php echo esc_html__( 'Live Demo', 'thefour-lite' ); ?></a>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<p class="more-themes-btn">
	<a href="<?php echo esc_url( "https://gretathemes.com/wordpress-themes/{$this->utm}" ); ?>" target="_blank" class="button button-primary">
		<?php
		/* translators: theme name. */
		esc_html_e( 'Browser All Themes', 'thefour-lite' );
		?>
	</a>
</p>
