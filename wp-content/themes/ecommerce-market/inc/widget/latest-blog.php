<?php
/**
 * Display Latest Blog
 *
 * @package eCommerce_Market
 */

/**
* A widget that display Latest Blog
*/
class Ecommerce_Market_Latest_Blog extends WP_Widget
{
  
  function __construct() {
    
    global $control_ops;

    $widget_ops = array(
      'classname'   => 'ecommerce-market-latest-blog',
      'description' => esc_html__( 'Add Widget to Display Latest Blog.', 'ecommerce-market' )
    );

    parent::__construct( 'ecommerce_market_latest_blog',esc_html__( 'EM: Latest Blog', 'ecommerce-market' ), $widget_ops, $control_ops );
  }
  function form( $instance ) {
    $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
    $read_more = isset( $instance['read_more'] ) ? esc_attr( $instance['read_more'] ) : esc_html__( 'Read More', 'ecommerce-market' );
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
  ?>
    <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'ecommerce-market' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo esc_html__( 'Number of posts to show:', 'ecommerce-market' );?></label>
    <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="4" min="4" value="<?php echo esc_attr($number); ?>" size="4" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id( 'read_more' )); ?>"><?php echo esc_html__( 'Button Title:', 'ecommerce-market' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'read_more' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'read_more' )); ?>" type="text" value="<?php echo esc_attr($read_more); ?>" /></p>    

    <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
    <label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php echo esc_html__( 'Display post date?', 'ecommerce-market' ); ?></label></p>      


  <?php
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['number'] = (int) $new_instance['number'];
    $instance['read_more'] = sanitize_text_field( $new_instance['read_more'] );
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    return $instance;
  }

  function widget( $args, $instance ) {

    $title = ( ! empty( $instance['title'] ) ) ? esc_html($instance['title']) : esc_html__( 'Latest Blog','ecommerce-market' );

    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
    if ( ! $number )
      $number = 4;

    $read_more = ! empty( $instance['read_more'] ) ? esc_html($instance['read_more']) : esc_html__( 'Read More', 'ecommerce-market' );

    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $r = new WP_Query( apply_filters( 'widget_posts_args', array(
      'posts_per_page'      => absint( $number ),
      'no_found_rows'       => true,
      'post_status'         => 'publish',
      'ignore_sticky_posts' => true
    ) ) );

    if ($r->have_posts()) : ?>

  	<section class="blog-section padding-space">
        <div class="container">
			<?php if ( $title ) : ?>

				<header class="entry-header heading os-animation" data-os-animation="fadeInUp">

					<h2 class="entry-title"><?php echo esc_html( $title );?></h2>
					
				</header>

			<?php endif;?>

          <div class="row">
            
              <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                <div class="custom-col-3 os-animation" data-os-animation="fadeInDown">
                  <article class="post">
                    <?php if ( $show_date ) : ?>

                      <div class="post-details">
                        <span class="date">
                        <time class="entry-date published" datetime="2017-03-20T12:13:09+00:00"><?php echo get_the_date( 'j'); ?><span><?php echo get_the_date( 'F Y'); ?></span></time>
                        </span>
                      </div>

                    <?php endif;?>  

                    <?php if ( has_post_thumbnail() ) : ?>

                      <figure class="post-featured-image">
                        
                        <?php the_post_thumbnail( 'ecommerce-market-latest-blog' );?>

                      </figure>

                    <?php endif;?>

                    <header class="entry-header">
                      <h3 class="entry-title">
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h3>
                    </header>

                    <div class="entry-content">
                        <?php
                          $excerpt = ecommerce_market_the_excerpt(30);
                          echo wp_kses_post( wpautop( $excerpt ) );
                        ?>
                    </div>
                    <a href="<?php the_permalink();?>" class="read-more"><?php echo esc_html( $read_more );?></a>
                  </article>
                </div>

              <?php endwhile;
              wp_reset_postdata();?>

            
          </div>
        </div>
  	</section>

    <?php endif;

  } 

}

function ecommerce_market_action_latest_blog() {

  register_widget( 'Ecommerce_Market_Latest_Blog' );
  
}
add_action( 'widgets_init', 'ecommerce_market_action_latest_blog' );