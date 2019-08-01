<?php 
/**
 * Function to get Single content
 */
if ( ! function_exists( 'wpazure_single_markup' ) ) {

	
	function wpazure_single_markup() {
		
		$BlogLayout = get_theme_mod('single_post_layout','right_sidebar');?>
				<div class="<?php if($BlogLayout=='full_width'){ echo 'col-lg-12'; } else { echo 'col-lg-8'; } ?> col-12""><?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'single' );

						endwhile;

						//the_posts_navigation();
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</div>
			
			<?php if($BlogLayout == 'right_sidebar'){ get_sidebar();}

	} 
}

add_action( 'wpazure_single_loop', 'wpazure_single_markup' );