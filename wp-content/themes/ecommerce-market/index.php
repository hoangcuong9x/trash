<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eCommerce_Market
 */

get_header(); ?>

<div class="container">
	<div class="row">
	<?php 
		$layout_class ='col-8';
		$sidebar_layout = ecommerce_market_get_option('layout_options'); 
		if( is_active_sidebar('sidebar-1') && 'no-sidebar' !==  $sidebar_layout){
			$layout_class = 'custom-col-8';
		}
		else{
			$layout_class = 'custom-col-12';
		}		
	?>	
	<div id="primary" class="content-area <?php echo esc_attr( $layout_class);?>">
		<main id="main" class="site-main">

			<div class="theiaStickySidebar">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					do_action( 'ecommerce_market_action_navigation' );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

		<?php get_sidebar();?>

	</div>
</div>			

<?php
get_footer();
