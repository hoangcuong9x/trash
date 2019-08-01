<?php
/**
 * Display Selected Product Carousel
 *
 * @package eCommerce_Market
 */

/**
* A widget that display Carousel
*/
class Ecommerce_Market_Product_Carousel extends WP_Widget
{
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'ecommerce-market-product-carousel',
			'description' => esc_html__( 'Add Widget to Display WooCommerce Product Carousel.', 'ecommerce-market' )
		);

		parent::__construct( 'ecommerce_marke_product_carousel',esc_html__( 'EM: Product Carousel', 'ecommerce-market' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'title' ]            = '';
		$defaults[ 'subtitle' ]         = '';
		$defaults[ 'product_type' ]     = '';
		$defaults[ 'category' ]         = '';
		$defaults[ 'product_number' ]   = 10;
		$defaults[ 'hide_thumbnail_mask' ]   = 0;

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title            = esc_attr( $instance[ 'title' ] );
		$subtitle         = esc_textarea( $instance[ 'subtitle' ] );
		$product_type     = $instance[ 'product_type' ];
		$category         = absint( $instance[ 'category' ] );
		$product_number   = absint( $instance[ 'product_number' ] );
		$hide_thumbnail_mask = $instance[ 'hide_thumbnail_mask' ] ? 'checked="checked"' : '';
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'ecommerce-market' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'product_type' ) ); ?>"><?php esc_html_e( 'Product product_type:', 'ecommerce-market' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'product_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'product_type' ) ); ?>">
				<option value="latest" <?php selected( $instance['product_type'], 'latest'); ?>><?php esc_html_e( 'Latest Products', 'ecommerce-market' ); ?></option>
				<option value="featured" <?php selected( $instance['product_type'], 'featured'); ?>><?php esc_html_e( 'Featured Products', 'ecommerce-market' ); ?></option>
				<option value="sale" <?php selected( $instance['product_type'], 'sale'); ?>><?php esc_html_e( 'On Sale Products', 'ecommerce-market' ); ?></option>
				<option value="category" <?php selected( $instance['product_type'], 'category'); ?>><?php esc_html_e( 'Certain Category', 'ecommerce-market' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category:', 'ecommerce-market' ); ?></label>
			<?php
			wp_dropdown_categories(
				array(
					'show_option_none' => '',
					'show_option_all'  => esc_html__('Select','ecommerce-market'),
					'name'             => $this->get_field_name( 'category' ),
					'selected'         => $instance['category'],
					'taxonomy'         => 'product_cat'
				)
			);
			?>
		</p>	

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>"><?php esc_html_e( 'Number of Products:', 'ecommerce-market' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'product_number' ) ); ?>" type="number" value="<?php echo esc_attr( $product_number ); ?>" />
		</p>				


	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ]          = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'product_type' ]         = $new_instance[ 'product_type' ];
		$instance[ 'category' ]       = absint( $new_instance[ 'category' ] );
		$instance[ 'product_number' ] = absint( $new_instance[ 'product_number' ] );
		//$instance[ 'hide_thumbnail_mask' ]   = isset( $new_instance[ 'hide_thumbnail_mask' ] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title            = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$product_type     = isset( $instance[ 'product_type' ] ) ? $instance[ 'product_type' ] : '';
		$category         = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$product_number   = isset( $instance[ 'product_number' ] ) ? $instance[ 'product_number' ] : '';

		if ( absint( $category ) > 0 ) {
			$term = get_term( $category );
			$slug = $term->slug;
		}		

		if ( $product_type == 'featured' ) {
			$args = array(
				'post_type'        => 'product',
				'posts_per_page'   => absint( $product_number ),
				'tax_query' => array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				)
			);
			if ( absint( $category ) > 0 ) {
				$args['product_cat'] = esc_attr( $slug);
			}			

		} elseif ( $product_type == 'sale' ) {
			$args = array(
				'post_type'      => 'product',
				'meta_query'     => array(
				'relation' => 'OR',
					array( // Simple products type
						'key'           => '_sale_price',
						'value'         => 0,
						'compare'       => '>',
						'type'          => 'numeric'
					),
					array( // Variable products type
					'key'           => '_min_variation_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
					)
				),
				'posts_per_page'   => absint( $product_number ),
			);
			if ( absint( $category ) > 0 ) {
				$args['product_cat'] = esc_attr( $slug);
			}						
		} elseif ( $product_type == 'category' ){
			$args = array(
				'post_type' => 'product',
				'tax_query' => array(
					array(
						'taxonomy'  => 'product_cat',
						'field'     => 'id',
						'terms'     => absint( $category ),
					)
				),
				'posts_per_page' => absint( $product_number ),
			);

		} else {
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => absint( $product_number ),
			);
		}
		?>

		<section class="featured-product-section padding-space">
			<div class="container">

				<?php if ( !empty( $title ) ) :?>
					<header class="entry-header heading os-animation" data-os-animation="fadeInUp">

						<h2 class="entry-title"><?php echo esc_html( $title );?></h2>

					</header>
				<?php endif;?>

				<div id="featured-product-slider" class="featured-product-slider owl-carousel owl-theme">
					<?php
					$featured_query = new WP_Query( $args );

					while ($featured_query->have_posts()) : $featured_query->the_post();
						$product = wc_get_product( $featured_query->post->ID ); 
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id,'ecommerce-market-product-carousel', false);?>
						<div class="product-item">

							<div class="product-list-wrapper">

								<figure class="featured-img">
									<?php if($image_url[0]) { ?>
										<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" alt="<?php the_title(); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>"></a>
									<?php } else { ?>
										<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" alt="<?php the_title(); ?>"><img src="<?php echo esc_url(ecommerce_market_woocommerce_placeholder_img_src()); ?>" alt="<?php the_title_attribute(); ?>"></a>
									<?php } ?>
									
									<?php if ( $product->is_on_sale() ) : 
										$sale_price = $product->get_sale_price();
										$regular_price=   $product->get_regular_price();

										
										if ( $product->is_type( 'variable' ) ){ 
											$discount = '';
										} else{
											$discount_price = $regular_price-$sale_price;	
											$discount = round(($discount_price / $regular_price) * 100);												
										}

									?>
									<?php if ( !$product->is_in_stock() ) { ?>
										<div class="soldout woocommerce"> 
											<?php
											    global $product;
											 
											    if ( !$product->is_in_stock() ) {
											        echo '<span>' . esc_html__( 'SOLD OUT', 'ecommerce-market' ) . '</span>';
											    } 
										    ?>
										</div>	

									<?php } else{ ?>

										<?php if ( !$product->is_type( 'variable' ) ){
											echo apply_filters( 'woocommerce_sale_flash', '<div class="sales-tag"><span>' .absint( $discount ) . esc_html__( '% off Sale!', 'ecommerce-market' ) . '</span></div>', $post, $product ); ?>

									<?php  } } ?>
									
									<?php endif; ?>

								

									<div class="woocommerce-product-rating woocommerce"> <?php
										 if ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) { ?>
												<?php echo wp_kses_post($rating_html); ?>
											<?php } else {
												echo '<div class="star-rating"></div>' ;
											}?>
									</div>		
								</figure>
								<div class="list-info">	
									<header class="entry-header">

										<a href="<?php the_permalink();?>">
											<h3 class="entry-title"><?php the_title();?></h3>
										</a>
										
									</header>

									<?php if ( $price_html = $product->get_price_html() ) : ?>
										<span class="price"><?php echo wp_kses_post($price_html); ?></span>
									<?php endif; ?>

									<?php
									if( function_exists( 'YITH_WCWL' ) ){
										$url = add_query_arg( 'add_to_wishlist', $product->get_id() );
									?>
										<a href="<?php echo esc_url($url); ?>" class="single_add_to_wishlist" >
											<?php esc_html_e('Add to Wishlist','ecommerce-market'); ?><i class="fa fa-heart"></i>
										</a>
									<?php } else{

										woocommerce_template_loop_add_to_cart( $product );
										
									} ?>

								</div>

							</div>

						</div>
					<?php endwhile;
					wp_reset_postdata();?>
				</div>
			</div>
		</section>

		<?php		
	}	

}

function ecommerce_market_action_product_carousel() {

	register_widget( 'Ecommerce_Market_Product_Carousel' );
	
}
add_action( 'widgets_init', 'ecommerce_market_action_product_carousel' );