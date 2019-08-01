<?php 
/**
 * Function to get archive markup
 */
if ( ! function_exists( 'wpazure_archive_markup' ) ) {

	
	function wpazure_archive_markup() {
		
		$BlogLayout = get_theme_mod('blog_layout','right_sidebar');?>
				<div class="<?php if($BlogLayout=='full_width'){ echo 'col-lg-12'; } else { echo 'col-lg-8'; } ?> col-12"><?php 
				if ( have_posts() )
					{ ?>
						<header class="page-header col-md-12 mb30">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content','');
						endwhile;
						the_posts_pagination( array(
								'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
								'next_text'          => '<i class="fa fa-angle-double-right"></i>'
							) );
					}
					else
					{
						get_template_part( 'template-parts/content', 'none' );
					}
				?>
			</div>
			
			<?php if($BlogLayout == 'right_sidebar'){ get_sidebar();} 

	} 
}

add_action( 'wpazure_archive_loop', 'wpazure_archive_markup' );