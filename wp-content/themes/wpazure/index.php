<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpazure
 */
get_header();?>

<section class="section-padding">

	<div class="container">
	
		<div class="row"><?php 
		
			wpazure_primary_content_before(); 

			wpazure_content_loop(); 

			wpazure_primary_content_after();?>
		
		</div>
		
	</div>
	
</section>
<?php get_footer();
