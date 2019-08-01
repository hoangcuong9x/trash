<?php 
/**
 *
 *
 */

/**
 * Get the ecommerce_market's placeholder image URL for products.
 *
 * @return string
 */
function ecommerce_market_woocommerce_placeholder_img_src( $image_size = '' ) {

	if($image_size == ''){
		return apply_filters( 'woocommerce_placeholder_img_src', get_template_directory_uri() . '/assest/img/placeholder.png' );
	} else {

		$size           = ecommerce_market_get_image_size($image_size);
		$size['width']  = isset( $size['width'] ) ? $size['width'] : '';
		$size['height'] = isset( $size['height'] ) ? $size['height'] : '';


		return apply_filters( 'woocommerce_placeholder_img_src', get_template_directory_uri() . '/assest/img/placeholder.-'.$size['width'].'x'.$size['height'].'.png' );
	}
}

function ecommerce_market_get_image_size( $name ) {
	global $_wp_additional_image_sizes;

	if ( isset( $_wp_additional_image_sizes[$name] ) )
		return $_wp_additional_image_sizes[$name];

	return false;
}


add_action( 'woocommerce_before_shop_loop_item_title', 'ecommerce_market_sold_out_loop_woocommerce' );
 
function ecommerce_market_sold_out_loop_woocommerce() {
    global $product;
    if ( !$product->is_in_stock() ) { ?>
    	<div class="soldout woocommerce"> 
        	<span><?php echo esc_html__( 'Sold Out', 'ecommerce-market' );?></span>
    	</div>
    <?php }
} 


function ecommerce_market_sold_out_woocommerce() {

	global $product;
    if ( !$product->is_in_stock() ) { ?>
    	<div class="soldout woocommerce"> 
        	<span><?php echo esc_html__( 'Sold Out', 'ecommerce-market' );?></span>
    	</div>

    <?php }

}

add_action( 'woocommerce_before_single_product_summary','ecommerce_market_sold_out_woocommerce');


if (!function_exists('eccomerce_market_loop_columns')) {
	function eccomerce_market_loop_columns() {
		$enable_shop_sidebar = ecommerce_market_get_option('enable_shop_sidebar');
		if( is_active_sidebar('sidebar-shop') && true ==  $enable_shop_sidebar){
			return 3; // 3 products per row
		} else{
			return 4; // 3 products per row
		}
		
	}
}
// Change number or products per row to 3
add_filter('loop_shop_columns', 'eccomerce_market_loop_columns');

function ecommerce_market_change_number_related_products( $args ) {
	$enable_shop_sidebar = ecommerce_market_get_option('enable_shop_sidebar');
	if( is_active_sidebar('sidebar-shop') && true ==  $enable_shop_sidebar){		 
		 $args['posts_per_page'] = 3; // # of related products
		 $args['columns'] = 4; // # of columns per row
		 return $args;
 	}else{
 		$args['posts_per_page'] = 4; // # of related products
		 $args['columns'] = 4; // # of columns per row
		 return $args;		
 	}
}
add_filter( 'woocommerce_output_related_products_args', 'ecommerce_market_change_number_related_products' );