<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eCommerce_Market
 */

get_header(); ?>
<div class="container">
	<div class="row">
	<div id="primary" class="content-area custom-col-12">
		<main id="main" class="site-main">

			<section class="error-404 not-found">

	          	<figure class="error-icon custom-col-4">
	                <img src="<?php echo esc_url(get_template_directory_uri());?>/assest/img/404.png" alt="">
	            </figure>

	            <div class="custom-col-8">

					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ecommerce-market' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'ecommerce-market' ); ?></p>

						<?php
							get_search_form();						
						?>
					</div><!-- .page-content -->
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
</div>
<?php
get_footer();
