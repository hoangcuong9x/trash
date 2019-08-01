<?php
/**
 * Display Testimonial 
 *
 * @package eCommerce_Market
 */

/**
* A widget that display testimonial
*/
class Ecommerce_Market_Testimonial extends WP_Widget
{
  
  function __construct() {
    
    global $control_ops;

    $widget_ops = array(
      'classname'   => 'ecommerce-market-testimonial',
      'description' => esc_html__( 'Add Widget to Display Testimonial .', 'ecommerce-market' )
    );

    parent::__construct( 'ecommerce_market_testimonial',esc_html__( 'EM: Testimonial', 'ecommerce-market' ), $widget_ops, $control_ops );
  }
  function form( $instance ) {

    $page_id = isset( $instance['page_id'] ) ? absint( $instance['page_id'] ) : ''; 

    
  ?>

    <p><label for="<?php echo esc_attr($this->get_field_id( 'image_url' )); ?>"><?php echo esc_html__( 'Select Page', 'ecommerce-market' ); ?></label> 
      <?php wp_dropdown_pages( array(
      'show_option_none'  => ' ',
      'name'              => esc_attr($this->get_field_name( 'page_id' )),
      'selected'          => absint( $page_id ),
      ) ); ?></p>


  <?php
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['page_id'] = absint( $new_instance['page_id'] );
    

    return $instance;
  }

  function widget( $args, $instance ) {

    $page_id  = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';

    $r = new WP_Query( apply_filters( 'widget_posts_args', array(      
      'page_id'       => absint( $page_id ),

    ) ) );

    if ($r->have_posts()) : ?>

      <section class="testimonial-section"> 
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>

          <?php if ( has_post_thumbnail() ) : ?>

            <figure class="featured-image os-animation" data-os-animation="bounceInLeft">
              <?php the_post_thumbnail( 'ecommerce-market-testimonial' );?>
            </figure>

          <?php endif;?>

          <div class="container">
            <div class="row">
              <div class="custom-col-6 os-animation" data-os-animation="bounceInRight">
                <div class="testimonial-content-wrap">
                  <span class="textimonial-icon">
                    <i class="fa fa-quote-left"></i>
                  </span>

                  <?php
                    $excerpt = ecommerce_market_the_excerpt(50);
                    echo wp_kses_post( wpautop( $excerpt ) );
                  ?>

                  <h5><?php the_title();?></h5>

                </div>
              </div>
            </div>
          </div> 

        <?php endwhile;
        wp_reset_postdata();?>
      </section>

    <?php endif;

  } 

}

function ecommerce_market_action_testimonial() {

  register_widget( 'Ecommerce_Market_Testimonial' );
  
}
add_action( 'widgets_init', 'ecommerce_market_action_testimonial' );