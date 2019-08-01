<?php
/**
 * Plugin widgets.
 *
 * @package eCommerce_Market
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Ecommerce_Market_Promo.
 *
 * @since 1.0.0
 */
class Ecommerce_Market_Promo extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Widget options.
		$opts = array(
			'classname'                   => 'ecommerce-market-promo',
			'description'                 => __( 'A widget that displays promo section', 'ecommerce-market' ),
			'customize_selective_refresh' => true,
			);

		parent::__construct( 'ecommerce-market', __( 'EM: Promo Widget', 'ecommerce-market' ), $opts );

	}

	function widget( $args, $instance ) {	
		$title = ! empty( $instance['title'] ) ? esc_html($instance['title']) : '';
		$image_url = ! empty( $instance['image_url'] ) ? esc_url($instance['image_url']) : '';
		$button_title = ! empty( $instance['button_title'] ) ? esc_html($instance['button_title']) : '';
		$button_link = ! empty( $instance['button_link'] ) ? esc_url($instance['button_link']) : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		?>
		<section class="discount-section" style="background: url(<?php echo esc_url($image_url)?>);"  >
			<div class="container">
				<div class="discount-content-wrapper">
					<?php if( !empty( $title) ) : ?>
						<header class="entry-header heading os-animation" data-os-animation="fadeInUp">
							<h2 class="entry-title"><?php echo esc_html( $title );?></h2>
						</header>

					<?php endif;?>

					<div class="entry-content">
						<p class="os-animation" data-os-animation="fadeInUp"><?php echo esc_html( $description);?></p>

						<?php if( !empty( $button_link ) ):?>
							<a href="<?php echo esc_url( $button_link );?>" class="btn os-animation" data-os-animation="bounceIn"><?php echo esc_html( $button_title );?></a>
						<?php endif;?>
						
					</div>
				</div>
			</div>
		</section>	


		<?php }


	/**
	 * Outputs the widget settings form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {

		// Defaults.
		$instance = wp_parse_args( (array) $instance, array(
			'title'                  => '',
			'description'            => '',
			'image_url'              => '',			
			'button_title'           => '',			
			'button_link'            => '',	

			) );
		$image_url = '';
		$image_url  = esc_url( $instance[ 'image_url' ] );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html_e( 'Title:', 'ecommerce-market' ); ?>:
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
				<?php echo esc_html_e( 'Description', 'ecommerce-market' ); ?>:
			</label>
			<textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
		</p>

    <div class="cover-image">
        <label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>">
            <?php esc_html_e( 'Background Image:', 'ecommerce-market' ); ?>
        </label><br />
        <input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" value="<?php echo esc_url( $instance['image_url'] ); ?>" /><br />
        <input type="button" class="select-img button button-primary" value="<?php esc_html_e( 'Upload', 'ecommerce-market' ); ?>" data-uploader_title="<?php esc_html_e( 'Select Background Image', 'ecommerce-market' ); ?>" data-uploader_button_text="<?php esc_html_e( 'Choose Image', 'ecommerce-market' ); ?>" style="margin-top:5px;" />

        <?php
        $image_url = '';

        if ( ! empty( $instance['image_url'] ) ) {

            $image_url = $instance['image_url'];

        }

        $wrap_style = '';

        if ( empty( $image_url ) ) {

            $wrap_style = ' style="display:none;" ';
        }
        ?>
        <div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Preview', 'ecommerce-market' ); ?>" style="max-width: 100%;"  />
        </div><!-- .rtam-preview-wrap -->
        
    </div> 

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_title' ) ); ?>">
				<?php esc_html_e( 'Button title', 'ecommerce-market' ); ?>:
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['button_title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>"><?php esc_html_e( 'Link', 'ecommerce-market' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>"
			name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>" type="text" value="<?php echo esc_url( $instance['button_link'] ); ?>" />
		</p>			    


		
		<?php
	}
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']          = sanitize_text_field( $new_instance['title'] );

		$instance['image_url']  = isset($new_instance['image_url']) ? esc_url_raw($new_instance['image_url']) : '';

		$instance['button_title'] 	= sanitize_text_field( $new_instance['button_title'] );

		$instance['button_link']   	= esc_url_raw( $new_instance['button_link'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['description'] = $new_instance['description'];
		} else {
			$instance['description'] = wp_kses_post( $new_instance['description'] );
		}

		return $instance;

	}
}
