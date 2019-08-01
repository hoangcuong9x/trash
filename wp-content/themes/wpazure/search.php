<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Wpazure
 */

get_header();
?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<?php $BlogLayout = get_theme_mod('blog_layout','right_sidebar');?>
			<div class="<?php if($BlogLayout=='full_width'){ echo 'col-lg-12'; } else { echo 'col-lg-8'; } ?> col-12">
				<?php if ( have_posts() ) 
				{?>
					<h2 class="page-title search-title mb-4"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'wpazure' ), '<span>' . get_search_query() . '</span>' );?>
					</h2><?php
					
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
			<?php if($BlogLayout == 'right_sidebar'){ get_sidebar();} ?>
		</div>
	</div>
</section>
<?php get_footer();