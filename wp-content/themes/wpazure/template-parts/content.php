<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpazure
 */
 $ReadMore 		= get_theme_mod( 'blog_post_readmore_button_text', __( 'Read more', 'wpazure' ) );
 $BlogStructure = get_theme_mod('azure_blog_structure',array( 'post_thumnail', 'post_title', 'post_meta','post_content' ) );
 $BlogMetaStructue = get_theme_mod('blog_meta_structure',array( 'author', 'date', 'comment','category','tag') );
 
 if (function_exists('wpazure_post_classes')){
	 $Classes = wpazure_post_classes();
	}else {
	$Classes = 'az-single-post col-lg-12';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($Classes);?>>

	<div class="post-inner">
		<div class="post-info"><?php
			foreach ( $BlogStructure as $BlogData ) {
						switch( $BlogData ){
							case 'post_thumnail':
								wpazure_post_thumbnail();
							break;
							
							case 'post_title':?> 
							<header class="entry-header">
								<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
							</header><?php
							break;
							
							case 'post_meta':?>
								<ul class="entry-meta"><?php
									foreach ( $BlogMetaStructue as $meta_value ) {
										switch ( $meta_value ) {
											case 'author':
												wpazure_posted_by();
												break;
											case 'date':
												wpazure_posted_on();
												break;
											case 'comment':
												wpazure_get_comments_number();
												break;
											case 'category':
												wpazure_all_categories();
												break;
											case 'tag':
												wpazure_get_tags();
												break;
										}
									}?>
								</ul><?php 
							break;
							
							case 'post_content': ?>
								<div class="entry-content"><?php 
									wpazure_the_excerpt();
									wp_link_pages( ); ?>
								</div><?php
							break;
						
						}	
						
					}?>

		</div>
		
	</div>
	
</article>