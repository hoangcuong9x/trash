<?php
/**
 * Service Section
 * 
 * @package Mudita
 */
 
$service_post_one  = get_theme_mod( 'mudita_service_post_one' );
$service_post_two  = get_theme_mod( 'mudita_service_post_two' );
$service_read_more = get_theme_mod( 'mudita_service_read_more' );
 
if( $service_post_one || $service_post_two ){
     $service_posts = array( $service_post_one, $service_post_two );
     
     $service_qry = new WP_Query( array( 
        'post_type'             => 'post',
        'posts_per_page'        => -1,
        'post__in'              => $service_posts,
        'orderby'               => 'post__in',
        'ignore_sticky_posts'   => true 
     ) );
     if( $service_qry->have_posts() ){
        while( $service_qry->have_posts() ){
            $service_qry->the_post();
            if( has_post_thumbnail() ){
            ?>
            <div class="col">
    			<div class="img-holder">
    				<?php the_post_thumbnail( 'mudita-two-column' ); ?>
    				<div class="text-holder">
    					<div class="table">
    						<div class="table-row">
    							<div class="table-cell">
    								<div class="text">
    									<h3 class="title"><?php the_title(); ?></h3>
    									<?php echo wpautop( mudita_excerpt( get_the_content(), 75, '...', false, false ) ); ?>
    									<?php if( $service_read_more ){ ?>
                                        <div class="btn-holder"><a href="<?php the_permalink(); ?>" class="btn-learnmore"><?php echo esc_html( $service_read_more ); ?><span class="icon"></span></a></div>
                                        <?php }?>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
            <?php
            }
        }
        wp_reset_postdata(); 
    }
}		