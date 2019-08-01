<?php
/**
 * Add theme dashboard page
 *
 * @package TheFour Lite
 */

/**
 * Dashboard class.
 */
class TheFour_Lite_Dashboard {
	/**
	 * Store the theme data.
	 *
	 * @var WP_Theme Theme data.
	 */
	private $theme;

	/**
	 * Theme slug.
	 *
	 * @var string Theme slug.
	 */
	private $slug;

	/**
	 * Pro Version.
	 *
	 * @var string Pro version slug.
	 */
	private $pro_slug;

	/**
	 * Pro Version.
	 *
	 * @var string Pro version name.
	 */
	private $pro_name;

	/**
	 * UTM link.
	 *
	 * @var string UTM link.
	 */
	private $utm;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->theme    = wp_get_theme();
		$this->slug     = $this->theme->template;
		$this->pro_name = str_replace( ' Lite', '', $this->theme->name );
		$this->pro_slug = str_replace( '-lite', '', $this->slug );
		$this->utm      = '?utm_source=WordPress&utm_medium=link&utm_campaign=' . $this->slug;

		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'redirect' ) );
		add_filter( 'wpforms_shareasale_id', array( $this, 'wpforms_shareasale_id' ) );
	}

	/**
	 * Add theme dashboard page.
	 */
	public function add_menu() {
		$page = add_theme_page(
			$this->theme->name,
			$this->theme->name,
			'edit_theme_options',
			$this->slug,
			array( $this, 'render' )
		);
		add_action( "admin_print_styles-$page", array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Show dashboard page.
	 */
	public function render() {
		add_action( 'admin_footer_text', array( $this, 'footer_text' ) );
		?>
		<div class="wrap">
			<div id="poststuff">
				<div id="post-body" class="columns-2">
					<div id="post-body-content">
						<div class="about-wrap">
							<?php include get_template_directory() . '/inc/dashboard/sections/welcome.php'; ?>
							<?php include get_template_directory() . '/inc/dashboard/sections/tabs.php'; ?>
							<?php include get_template_directory() . '/inc/dashboard/sections/getting-started.php'; ?>
							<?php include get_template_directory() . '/inc/dashboard/sections/pro.php'; ?>
							<?php include get_template_directory() . '/inc/dashboard/sections/recommendation.php'; ?>
						</div>
						<div id="postbox-container-1" class="postbox-container">
							<?php include get_template_directory() . '/inc/dashboard/sections/newsletter.php'; ?>
							<?php include get_template_directory() . '/inc/dashboard/sections/upgrade.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts for dashboard page.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/inc/dashboard/css/slick.css' );
		wp_enqueue_style( "{$this->slug}-dashboard-style", get_template_directory_uri() . '/inc/dashboard/css/dashboard-style.css' );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/inc/dashboard/js/slick.js', array( 'jquery' ), '1.8.0', true );
		wp_enqueue_script( "{$this->slug}-dashboard-script", get_template_directory_uri() . '/inc/dashboard/js/script.js', array( 'slick' ), '', true );
	}

	/**
	 *
	 * Change footer text in admin
	 */
	public function footer_text() {
		// Translators: theme name and theme slug.
		echo wp_kses_post( sprintf( __( 'Please rate <strong>%1$s</strong> <a href="https://wordpress.org/support/theme/%2$s/reviews/?filter=5" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="https://wordpress.org/support/theme/%2$s/reviews/?filter=5" target="_blank">WordPress.org</a> to help us spread the word. Thank you from GretaThemes!', 'thefour-lite' ), $this->pro_name, $this->slug ) );
	}

	/**
	 * Redirect to dashboard page after theme activation.
	 */
	public function redirect() {
		global $pagenow;
		if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
			wp_safe_redirect( admin_url( "themes.php?page={$this->slug}" ) );
			exit;
		}
	}

	/**
	 * Set the WPForms ShareASale ID.
	 *
	 * @param string $shareasale_id The the default ShareASale ID.
	 *
	 * @return string $shareasale_id
	 */
	public function wpforms_shareasale_id( $shareasale_id ) {
		$id = '424629';

		if ( ! empty( $shareasale_id ) && $shareasale_id == $id ) {
			return $shareasale_id;
		}

		update_option( 'wpforms_shareasale_id', $id );

		return $id;
	}
}
