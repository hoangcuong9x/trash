<?php
/**
 * Display Recent Posts
 *
 * @package eCommerce_Market
 */

/**
* A widget that display recent post
*/
class Ecommerce_Market_Recent_Posts extends WP_Widget
{
  
  function __construct() {
    
    global $control_ops;

    $widget_ops = array(
      'classname'   => 'ecommerce-market-recent-posts',
      'description' => esc_html__( 'Add Widget to Display Resecent Posts.', 'ecommerce-market' )
    );

    parent::__construct( 'ecommerce_market_recent_posts',esc_html__( 'EM: Recent Posts', 'ecommerce-market' ), $widget_ops, $control_ops );
  }
  function form( $instance ) {
    $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
  ?>
    <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'ecommerce-market' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo esc_html__( 'Number of posts to show:', 'ecommerce-market' );?></label>
    <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="4" value="<?php echo esc_attr($number); ?>" size="4" /></p>

    <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
    <label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php echo esc_html__( 'Display post date?', 'ecommerce-market' ); ?></label></p>      


  <?php
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['number'] = (int) $new_instance['number'];
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    return $instance;
  }

  function widget( $args, $instance ) {

    $title = ( ! empty( $instance['title'] ) ) ? esc_html($instance['title']) : esc_html__( 'Latest Blog','ecommerce-market' );

    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
    if ( ! $number )
      $number = 4;
    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $r = new WP_Query( apply_filters( 'widget_posts_args', array(
      'posts_per_page'      => absint( $number ),
      'no_found_rows'       => true,
      'post_status'         => 'publish',
      'ignore_sticky_posts' => true
    ) ) );

    if ($r->have_posts()) : ?>

    <div class="ecommerce-recetnt-blog">
      <div class="container">

        <?php if ( $title ) : ?>

          <header class="entry-header heading os-animation" data-os-animation="fadeInUp">
            <h2 class="entry-title"><?php echo esc_html( $title );?></h2>
          </header>

        <?php endif;?>
        
          <?php while ( $r->have_posts() ) : $r->the_post(); ?>

              <?php $thumbnail_class =  '';  ?>  
              <?php if ( !has_post_thumbnail() ) : 

                $thumbnail_class = 'no-image';

              endif;?>

            <article class="post-item os-animation <?php echo esc_attr( $thumbnail_class);?>" data-os-animation="fadeInDown">   

              <?php if ( has_post_thumbnail() ) : ?>

                <div class="post-image">
                  
                  <?php the_post_thumbnail( 'ecommerce-market-recent-posts' );?>

                </div>

              <?php endif;?>

             <div class="post-item-text">  
              <?php if ( $show_date ) : ?>
                  
                <?php ecommerce_market_posted_on();?>                  

              <?php endif;?>             

              <header class="entry-header">
                <h5 class="entry-title">
                  <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </h5>
              </header>
            </div>

            </article>
            

          <?php endwhile;

          wp_reset_postdata(); ?>

      </div>
    </div>

    <?php endif;

  } 

}

function ecommerce_market_action_recent_posts() {

  register_widget( 'Ecommerce_Market_Recent_Posts' );
  
}
add_action( 'widgets_init', 'ecommerce_market_action_recent_posts' );