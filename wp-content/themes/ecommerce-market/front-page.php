<?php
/**
 * The template for displaying home page.
 * @package eCommerce_Market
 */

get_header(); ?>
<?php if ( 'posts' != get_option( 'show_on_front' ) ){?>

<div id="primary" class="content-area"> <!-- primary-home starting from here --> 
	<main id="main" class="site-main">

		<div class="theiaStickySidebar">


			<?php if ( is_active_sidebar( 'home-page-section-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'home-page-section-sidebar' ); ?>

			<?php endif; ?>

			<?php $show_home = ecommerce_market_get_option('home_page_content'); 
			if ( true == $show_home) : ?>

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
					<div id="home-page-content" class="<?php echo esc_attr( $layout_class);?>">
						<?php
						while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						endwhile; // End of the loop.
						?>
					</div>

					<?php get_sidebar();?>

				</div>
			</div>
			
		<?php endif; ?>

	</div>

</main>
</div> <!-- primary-home ends here -->

<?php } else{ ?>
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
		<?php } ?>
		<?php get_footer();