<?php
/**
 * The template part for displaying search form.
 *
 * @package TheFour
 */

?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>" role="search">
	<label>
		<span class="screen-reader-text"><?php esc_html_x( 'Search for:', 'label', 'thefour-lite' ); ?></span>
		<input type="search" class="search-field" name="s" placeholder="<?php esc_attr_e( 'Enter keyword here', 'thefour-lite' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
	</label>
	<button type="submit" class="search-button">
		<i class="fa fa-search"></i><span class="screen-reader-text"><?php esc_html_e( 'Search', 'thefour-lite' ); ?></span>
	</button>
</form>
