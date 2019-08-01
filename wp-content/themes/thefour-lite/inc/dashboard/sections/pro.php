<?php
/**
 * Free vs. Pro section.
 *
 * @package TheFour Lite
 */

?>
<div id="pro" class="gt-tab-pane">
	<table class="form-table">
		<thead>
			<tr>
				<th></th>
				<th><?php esc_html_e( 'Lite', 'thefour-lite' ); ?></th>
				<th><?php esc_html_e( 'PRO', 'thefour-lite' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Responsive Design', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Works in any browsers on desktops, tablets and mobile devices and optimized for speed.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-yes"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Front Page Sections', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Easy to setup your static front page with content sections.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-yes"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Custom Logo', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Supports custom logo in WordPress 4.5. Upload your logo has never been easier.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-yes"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( '1-Click Demo Import', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Save time setting up the theme and get exactly what you see in the demo.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Custom Google Fonts', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Integrated all Google Fonts with various options to customize for a beautiful typography.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Custom Colors', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Customize colors of any element on your website.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Infinite Scroll', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Load more posts when to reach to the end of the page. Support auto mode and manual mode.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Portfolio', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Create awesome portfolio with Jetpack and show them beautifully in the frontend.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Testimonial', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'Show the testimonials from your customers to build the trust for your products and services.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Priority Support', 'thefour-lite' ); ?></h3>
					<p><?php esc_html_e( 'You will benefit of our full support for any issues you have with the theme.', 'thefour-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<a href="<?php echo esc_url( "https://gretathemes.com/wordpress-themes/{$this->pro_slug}/{$this->utm}" ); ?>" target="_blank" class="button button-primary button-hero">
						<?php
						/* translators: pro theme name. */
						echo esc_html( sprintf( __( 'Get %s PRO now', 'thefour-lite' ), $this->pro_name ) );
						?>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
