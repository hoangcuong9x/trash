<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wpazure
 */

get_header(); ?>
	<section class="error-page" style="background: url(<?php echo WPAZURE_THEME_URI; ?>/images/404.jpg)">
		<div class="error-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<strong class="error-404"><?php esc_html_e('4','wpazure');?><i class="fa fa-frown-o"></i><?php esc_html_e('4','wpazure');?></strong>
	         			<h2><?php esc_html_e('Page Not Found..','wpazure');?></h2>
	          			<p> 
	          				<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching?', 'wpazure' ); ?> 
	          			</p>
	          			<?php get_search_form(); ?>
	          		</div>
				</div>
			</div>
		</div>
	</section>
<?php
get_footer();