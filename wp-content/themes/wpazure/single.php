<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wpazure
 */

get_header(); ?>
<section class="section-padding">
	<div class="container">
		<div class="row"><?php 
			
			wpazure_single_before(); 
			wpazure_single_loop(); 
			wpazure_single_after();?>
			
		</div>
	</div>
</section>
<?php get_footer();