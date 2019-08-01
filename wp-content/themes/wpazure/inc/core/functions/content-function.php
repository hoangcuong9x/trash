<?php 
/**
 * Function to get site content
 */
if ( ! function_exists( 'wpazure_primary_content_markup' ) ) {

	
	function wpazure_primary_content_markup() {
		
		$BlogLayout = get_theme_mod('blog_layout','right_sidebar');?>
		 
		<div class="<?php if($BlogLayout=='full_width'){ echo 'col-lg-12'; } else { echo 'col-lg-8'; } ?> col-12">
		<?php if($BlogLayout=='full_width'){ ?>
		<div class="row">
		<?php } ?>
			<?php 	if ( have_posts() ) {
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content','');
						endwhile;
						the_posts_pagination( array(
							'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
							'next_text'          => '<i class="fa fa-angle-double-right"></i>'
						) );
					}else {
						
						get_template_part( 'template-parts/content', 'none' );
						
					}
			?>
			<?php if($BlogLayout=='full_width'){ ?>
		</div>
		<?php } ?>
		</div>
		<?php if($BlogLayout == 'right_sidebar'){ get_sidebar();} 

	} 
}

add_action( 'wpazure_content_loop', 'wpazure_primary_content_markup' );