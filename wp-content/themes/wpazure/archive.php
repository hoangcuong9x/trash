<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpazure
 */
get_header();
?>
<section class="section-padding">
	<div class="container">
		<div class="row"><?php 
		
			wpazure_archive_before(); 
			wpazure_archive_loop(); 
			wpazure_archive_after();?>
			
		</div>
		
	</div>
	
</section>
<?php get_footer();