<?php
/**
 * The template part for displaying 404 page.
 * Content of this page (heading and search form) are moved to the header.
 *
 * @package TheFour
 */

get_header(); ?>

<section id="content" class="content">

	<p><?php esc_html_e( 'It seems like you have tried to open a page that doesn\'t exist. You are welcome to search for what you are looking for with the form below.', 'thefour-lite' ) ?></p>
	<?php get_search_form(); ?>

</section>

<?php get_footer(); ?>
