<?php
/**
 * Testimonial Section
 * 
 * @package Mudita
 */
 
$section_title   = get_theme_mod( 'mudita_testimonial_section_title' );
$section_content = get_theme_mod( 'mudita_testimonial_section_content' );
$post_one        = get_theme_mod( 'mudita_testimonial_post_one' );
$post_two        = get_theme_mod( 'mudita_testimonial_post_two' );
$post_three      = get_theme_mod( 'mudita_testimonial_post_three' );
 
?>
 
<div class="container">
	<?php if( $section_title || $section_content ){ ?>
    <header class="header">
        <?php 
        if( $section_title ) echo '<h2 class="main-title">' . esc_html( $section_title ) . '</h2>'; 
        
        if( $section_content ) echo wpautop( esc_html( $section_content ) );
        ?>
	</header>
    <?php } ?>
    
    <?php if( $post_one || $post_two || $post_three ){ ?>
	<div class="testimonial-holder">
		<?php if( $post_one ){ 
		      $testimonial_qry1 = new WP_Query( array( 'p' => $post_one ) );
              if( $testimonial_qry1->have_posts() ){
                while( $testimonial_qry1->have_posts() ){
                    $testimonial_qry1->the_post();
          ?>
                <div class="col-left">
                    <?php if( has_post_thumbnail() ){?>
        			<div class="img-holder"><?php the_post_thumbnail( 'mudita-testimonial-big' ); ?></div>
                    <?php }?>
        			<div class="text-holder">
        				<blockquote>
        					<?php echo wpautop( get_the_content() );?>
        					<cite><?php esc_html_e( '- ', 'mudita' ); the_title(); ?></cite>
        				</blockquote>
        			</div>
        		</div>
		<?php } 
            wp_reset_postdata(); 
            } 
        }
        
        if( $post_two && $post_three ){ 
            $testimonial_posts = array( $post_two, $post_three );
            $testimonial_qry2 = new WP_Query( array( 
                'post_type'             => 'post',
                'posts_per_page'        => -1,
                'post__in'              => $testimonial_posts,
                'orderby'               => 'post__in',
                'ignore_sticky_posts'   => true
            ) );
            $i = 0;
            if( $testimonial_qry2->have_posts() ){
        ?>
        <div class="col-right">
			<?php while( $testimonial_qry2->have_posts() ){ 
			         $testimonial_qry2->the_post();
                     $i++;
            ?>
            <div class="testimonial-row">
				<?php if( has_post_thumbnail() ){ ?>
                <div class="img-holder<?php if( $i == 1) echo ' img-left'; elseif( $i == 2 ) echo ' img-right';?>"><?php the_post_thumbnail( 'mudita-testimonail-small' ); ?></div>
				<?php } ?>
                <div class="text-holder">
					<blockquote>
						<?php the_content(); ?>
						<cite><?php esc_html_e( '- ', 'mudita' ); the_title(); ?></cite>
					</blockquote>
				</div>
			</div>
            <?php }
            wp_reset_postdata();
            ?>
		</div>
        <?php }
        } ?>
	</div>
    <?php } ?>
</div>