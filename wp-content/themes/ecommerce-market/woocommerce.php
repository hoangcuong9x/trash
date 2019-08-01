<?php
/**
 * The template for displaying woocommerce section.
 *
 * @package eCommerce_Market
 */

get_header(); ?>
<div class="container">
    <div class="row">  
		<?php
			$enable_shop_sidebar = ecommerce_market_get_option('enable_shop_sidebar'); 
			$layout_class = 'col-8';
			$shop_class = 'shop-sidebar';
			$sidebar_layout = ecommerce_market_get_option('layout_options'); 
			if( is_active_sidebar('sidebar-shop') && true ==  $enable_shop_sidebar){
				$layout_class = 'custom-col-8';
				$shop_class = 'shop-sidebar';
			}
			else{
				$layout_class = 'custom-col-12';
				$shop_class = '';
			}
			
		?>      
        <div id="primary" class="<?php echo esc_attr( $shop_class);?> content-area <?php echo esc_attr( $layout_class);?>">
            <main id="main" class="site-main" role="main">

                <?php woocommerce_content(); ?>

            </main><!-- #main -->
        </div><!-- #primary -->

		<?php if('true' == $enable_shop_sidebar ): 

			get_sidebar( 'woocommerce' );
			
		endif;?>


    </div>
</div>

<?php
get_footer();