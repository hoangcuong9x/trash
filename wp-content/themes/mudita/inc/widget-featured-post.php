<?php
/**
 * Widget Featured Post
 *
 * @package Mudita
 */
 
// register Mudita_Featured_Post widget
function mudita_register_featured_post_widget() {
    register_widget( 'Mudita_Featured_Post' );
}
add_action( 'widgets_init', 'mudita_register_featured_post_widget' );

if( ! class_exists( 'Mudita_Featured_Post' ) ) : 
 /**
 * Adds Mudita_Featured_Post widget.
 */
class Mudita_Featured_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'mudita_featured_post', // Base ID
			__( 'RARA: Featured Post', 'mudita' ), // Name
			array( 'description' => __( 'A Featured Post Widget', 'mudita' ), ) // Args
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
        
        $read_more      = ! empty( $instance['readmore'] ) ? strip_tags( $instance['readmore'] ) : __( 'Read More', 'mudita' );
		$excerpt_char   = ! empty( $instance['excerpt_char'] ) ? absint( $instance['excerpt_char'] ) : 200 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? esc_attr( $instance['show_thumbnail'] ) : '';
        $post_id        = ! empty( $instance['post_list'] ) ? esc_attr( $instance['post_list'] ) : 1 ;
        
        if( get_post_type( $post_id ) == 'post' ){
            $qry = new WP_Query( "p=$post_id" );
        }else{
            $qry = new WP_Query( "page_id=$post_id" );
        }
        if( $qry->have_posts() ){
            echo $args['before_widget'];
            while( $qry->have_posts() ){
                $qry->the_post();
                echo $args['before_title'] . apply_filters( 'widget_title', get_the_title() ) . $args['after_title']; 
            ?>
                <?php if( has_post_thumbnail() && $show_thumbnail ){ ?>                    
					<a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'mudita-featured-post' ); ?>
                    </a>    				
                <?php } ?>
                
                <?php echo wpautop( mudita_excerpt( get_the_content(), $excerpt_char, '...', false, false ) );?>
                <a href="<?php the_permalink();?>" class="readmore"><?php echo esc_attr( $read_more );?><span class="fa fa-angle-right"></span></a>
                        
            <?php    
            }
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
		$postlist[0] = array(
    		'value' => 0,
    		'label' => __( '--choose--', 'mudita' ),
    	);
    	$arg = array( 'posts_per_page' => -1, 'post_type' => array( 'post', 'page' ) );
    	$posts = get_posts( $arg ); 
    	
        foreach( $posts as $p ){ 
    		$postlist[$p->ID] = array(
    			'value' => $p->ID,
    			'label' => $p->post_title
    		);    		
    	}
        
        $read_more      = ! empty( $instance['readmore'] ) ? strip_tags( $instance['readmore'] ) : __( 'Read More', 'mudita' );
		$excerpt_char   = ! empty( $instance['excerpt_char'] ) ? absint( $instance['excerpt_char'] ) : 200 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? esc_attr( $instance['show_thumbnail'] ) : '';
        $post_list      = ! empty( $instance['post_list'] ) ? esc_attr( $instance['post_list'] ) : 1 ;
        
        ?>
		<p>
            <label for="<?php echo $this->get_field_id( 'post_list' ); ?>"><?php esc_html_e( 'Posts', 'mudita' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'post_list' ); ?>" id="<?php echo $this->get_field_id( 'post_list' ); ?>" class="widefat">
				<?php
				foreach ( $postlist as $single_post ) { ?>
					<option value="<?php echo $single_post['value']; ?>" id="<?php echo $this->get_field_id( $single_post['label'] ); ?>" <?php selected( $single_post['value'], $post_list ); ?>><?php echo $single_post['label']; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php esc_html_e( 'Read More Text', 'mudita' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" type="text" value="<?php echo esc_attr( $read_more ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'excerpt_char' ); ?>"><?php esc_html_e( 'Excerpt Character', 'mudita' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'excerpt_char' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_char' ); ?>" type="text" value="<?php echo esc_attr( $excerpt_char ); ?>" />
		</p>
        
        <p>
            <input id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'mudita' ); ?></label>
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
		
        $instance['readmore']       = ! empty( $new_instance['readmore'] ) ? strip_tags( $new_instance['readmore'] ) : __( 'Read More', 'mudita' );
        $instance['excerpt_char']   = ! empty( $new_instance['excerpt_char'] ) ? absint( $new_instance['excerpt_char'] ) : 200 ;
        $instance['post_list']      = ! empty( $new_instance['post_list'] ) ? esc_attr( $new_instance['post_list'] ) : 1;
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? esc_attr( $new_instance['show_thumbnail'] ) : '';
        
		return $instance;
                
	}

} // class Mudita_Featured_Post
endif;