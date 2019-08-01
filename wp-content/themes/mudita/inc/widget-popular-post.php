<?php
/**
 * Widget Popular Post
 *
 * @package Mudita
 */
 
// register Mudita_Popular_Post widget
function mudita_register_popular_post_widget() {
    register_widget( 'Mudita_Popular_Post' );
}
add_action( 'widgets_init', 'mudita_register_popular_post_widget' );

if( ! class_exists( 'Mudita_Popular_Post' ) ) : 
 /**
 * Adds Mudita_Popular_Post widget.
 */
class Mudita_Popular_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'mudita_popular_post', // Base ID
			__( 'RARA: Popular Post', 'mudita' ), // Name
			array( 'description' => __( 'A Popular Post Widget', 'mudita' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	   
        $title      = ! empty( $instance['title'] ) ? strip_tags( $instance['title'] ) : __( 'Popular Posts', 'mudita' );
        $num_post   = ! empty( $instance['num_post'] ) ? absint($instance['num_post']) : 3 ;
        $show_thumb = ! empty( $instance['show_thumbnail'] ) ? esc_attr( $instance['show_thumbnail'] ) : '';
        $show_date  = ! empty( $instance['show_postdate'] ) ? esc_attr( $instance['show_postdate'] ) : '';
        
        $qry = new WP_Query( array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => $num_post,
            'ignore_sticky_posts'   => true,
            'orderby'               => 'comment_count'
        ) );
        if( $qry->have_posts() ){
            echo $args['before_widget'];
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
            ?>
            <ul>
                <?php 
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
                    <li>
                        <?php if( has_post_thumbnail() && $show_thumb ){ ?>
                            <a href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php the_post_thumbnail( 'mudita-recent-post' );?>
                            </a>
                        <?php }?>
						<div class="entry-header">
							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
							<?php if( $show_date ){?>
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <span class="fa fa-calendar-o"></span>
                                        <time datetime="<?php printf( __( '%1$s', 'mudita' ), get_the_date('Y-m-d') ); ?>">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php printf( __( '%1$s', 'mudita' ), get_the_date('j M Y') ); ?>
                                            </a>
                                        </time>                                        
                                    </span>
                                </div>
                            <?php }?>
						</div>                        
                    </li>        
                <?php    
                }
            ?>
            </ul>
            <?php
            echo $args['after_widget'];   
        }
        wp_reset_postdata();  
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $title          = ! empty( $instance['title'] ) ? strip_tags( $instance['title'] ) : __( 'Popular Posts', 'mudita' );		
        $num_post       = ! empty( $instance['num_post'] ) ? absint($instance['num_post']) : 3 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? esc_attr( $instance['show_thumbnail'] ) : '';
        $show_postdate  = ! empty( $instance['show_postdate'] ) ? esc_attr( $instance['show_postdate'] ) : '';
        
        ?>
		
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'mudita' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'num_post' ); ?>"><?php esc_html_e( 'Number of Posts', 'mudita' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'num_post' ); ?>" name="<?php echo $this->get_field_name( 'num_post' ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $num_post ); ?>" />
		</p>
        
        <p>
            <input id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'mudita' ); ?></label>
		</p>
        
        <p>
            <input id="<?php echo $this->get_field_id( 'show_postdate' ); ?>" name="<?php echo $this->get_field_name( 'show_postdate' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_postdate ); ?>/>
            <label for="<?php echo $this->get_field_id( 'show_postdate' ); ?>"><?php esc_html_e( 'Show Post Date', 'mudita' ); ?></label>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']          = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : __( 'Popular Posts', 'mudita' );
        $instance['num_post']       = ! empty( $new_instance['num_post'] ) ? absint($new_instance['num_post']) : 3 ;        
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? esc_attr( $new_instance['show_thumbnail'] ) : '';
        $instance['show_postdate']  = ! empty( $new_instance['show_postdate'] ) ? esc_attr( $new_instance['show_postdate'] ) : '';
		
        return $instance;
        
	}

} // class Mudita_Popular_Post 
endif;