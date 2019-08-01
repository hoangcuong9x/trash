<?php
/**
 * Display Selected  Featured Product 
 *
 * @package eCommerce_Market
 */

/**
* A widget that display categories
*/
class Ecommerce_Market_Categories_Collection extends WP_Widget
{
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'ecommerce-market-categories-collection',
			'description' => esc_html__( 'Add Widget to Display Categories.', 'ecommerce-market' )
		);

		parent::__construct( 'ecommerce_market_categories_collection',esc_html__( 'EM: Categories Collection', 'ecommerce-market' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'title' ]    = '';
		$defaults[ 'orderby' ]    = '';
		$defaults[ 'enable_center' ]    = false;

		for ( $i=0; $i<5; $i++ ) {
			$var = 'cat_id'.$i;			
			$defaults[$var]   = '';			
		}		
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title    	= esc_attr( $instance[ 'title' ] );
		$orderby   	= $instance[ 'orderby' ];
		$enable_center   	= $instance[ 'enable_center' ];					
		
		
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'ecommerce-market' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p><input class="checkbox" type="checkbox"<?php checked( $enable_center ); ?> id="<?php echo esc_attr($this->get_field_id( 'enable_center' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'enable_center' )); ?>" />
   			<label for="<?php echo esc_attr($this->get_field_id( 'enable_center' )); ?>"><?php echo esc_html__( 'Enable Masonry View', 'ecommerce-market' ); ?></label>
		</p>		

		<?php for ($i=0; $i < 5 ; $i++) {  
			$var = 'cat_id'.$i;			
			$var 	= absint( $instance[ $var ] );			
			 
		?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'cat_id'.$i )); ?>"><?php esc_html_e( 'Category', 'ecommerce-market' ); ?>:</label>
				<?php wp_dropdown_categories(
					array(
						'show_option_none' => ' ',
						'name'             => $this->get_field_name( 'cat_id'.$i ),
						'selected'         => $instance['cat_id'.$i],
						'taxonomy'         => 'product_cat'
					)
				);
				?>
			</p>
			

		<?php	next( $defaults );// forwards the key of $defaults array
		} ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By:', 'ecommerce-market' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<option value="name" <?php selected( $instance['orderby'], 'name'); ?>><?php esc_html_e( 'Title', 'ecommerce-market' ); ?></option>
				<option value="id" <?php selected( $instance['orderby'], 'id'); ?>><?php esc_html_e( 'ID', 'ecommerce-market' ); ?></option>
				<option value="count" <?php selected( $instance['orderby'], 'count'); ?>><?php esc_html_e( 'Count', 'ecommerce-market' ); ?></option>
				<option value="none" <?php selected( $instance['orderby'], 'none'); ?>><?php esc_html_e( 'None', 'ecommerce-market' ); ?></option>
			</select>
		</p> 

	<?php } 

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] 	= sanitize_text_field( $new_instance[ 'title' ] ); 
		$instance[ 'orderby' ] 	= sanitize_text_field( $new_instance[ 'orderby' ] );
		$instance['enable_center'] = isset( $new_instance['enable_center'] ) ? (bool) $new_instance['enable_center'] : false;
		

		for( $i=0; $i<5; $i++ ) {
			$var = 'cat_id'.$i;			
			$instance[ $var]   = absint( $new_instance[ $var ] );
			
		}

		return $instance; 	

	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');

		$orderby = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';

		$enable_center = isset( $instance['enable_center'] ) ? $instance['enable_center'] : false;	

		
		$cat_array = array();
		for( $i=0; $i<5; $i++ ) {
			$var = 'cat_id'.$i;

			$cat_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';



 			if( !empty( $cat_id ) ) {
				array_push( $cat_array, $cat_id );// Push the category id in the array
 			}


		}

		?>
		<?php $featured_cats = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => esc_attr( $orderby),
			'hide_empty'   => '0',
			'include'      => $cat_array,
		);

		if ( !empty( $cat_array ) ) { ?>

			<section class="main-product-section padding-space">

				<div class="container">
					    <?php if ( !empty( $title ) ) { ?>
					        <header class="entry-header heading os-animation" data-os-animation="fadeInUp">
					          <h2 class="entry-title"><?php echo esc_html( $title );?></h2>
					        </header>
					    <?php } ?>
					<div class="main-product-wrap">		
						<?php $count = 0;
						$all_categories = get_categories( $featured_cats );
						foreach ($all_categories as  $key=>$term) {				
							

							$image_size  = 'ecommerce-market-product-collection-medium';
							$os_animation = 'bounceInLeft';
							$btn_class = 'btn-transparent';
							$center_class = '';

							
							if ($count ==  2  ) {
								$os_animation = 'bounceInDown';

							} elseif ( $count == 3 || $count == 5) {
								$os_animation = 'bounceInRight';
							}

							if ( $count == 1) {

								
								if( true == $enable_center):
									$image_size = 'ecommerce-market-product-collection-large';
								
									$center_class = 'center';
								endif;
							}

							$term_id = $term->term_id;
							$term_link = get_term_link($term);

							$thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true ); 
							$image_url = wp_get_attachment_image($thumbnail_id, $image_size );

							
							if ( empty( $image_url ) ) { 
								$image_placeholder= 'placeholder-small.png';

								if ( $count == 1) {
									$image_placeholder= 'placeholder-large.png';
								}
								

							}						

							?>
							<div class="product-item os-animation" data-os-animation="<?php echo esc_attr($os_animation);?>">
								<div class="product-content <?php echo esc_attr( $center_class); ?>">
							
									<?php if ( !empty( $image_url ) ) {  ?>

										<a href="<?php echo esc_url( $term_link );?>">
											<?php echo wp_kses_post($image_url); ?>

										</a>


									<?php } else{ ?>

										<img src="<?php echo esc_url(get_template_directory_uri()) . '/assest/img/'.$image_placeholder.''?>">
									<?php } ?>									

									<div class="product-wrapper v-center ">

										<?php if ( !empty( $term->description)) { ?>

											<span><?php echo esc_html( $term->description)?></span>

										<?php } ?>								

										<h3><?php echo esc_html( $term->name ); ?></h3>

										
										<a href="<?php echo esc_url( $term_link );?>" class="btn <?php echo esc_attr( $btn_class );?>">
										<?php echo esc_html__( 'Shop Now', 'ecommerce-market' );?>										
										</a>
										

									</div>
									
								</div>

							</div>
						 	<?php $count++;  //var_dump( $count);?>
						<?php } ?>
					</div>
				</div>
			</section>

		<?php } 
	
	}	

}

function Ecommerce_Market_Action_Categories_Collection() {

	register_widget( 'Ecommerce_Market_Categories_Collection' );
	
}
add_action( 'widgets_init', 'Ecommerce_Market_Action_Categories_Collection' );