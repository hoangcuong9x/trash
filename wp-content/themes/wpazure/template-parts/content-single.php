<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpazure
 */
 $SingleBlogStructure = get_theme_mod('azure_single_post',array( 'post_thumnail', 'post_title', 'post_meta','post_content' ));
 $SingleBlogMetaStructure = get_theme_mod('single_blog_meta',array('author,date,comment','category','tag'));
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('az-single-post'); ?>>
<div class="post-inner">
<div class="post-info">
<?php
foreach ( $SingleBlogStructure as $BlogData ) 
	{
		switch( $BlogData )
		{
			case 'post_thumnail':
			wpazure_post_thumbnail();
			break;
			
			case 'post_title':?>
			<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
			</header> <?php
			break;
			
			case 'post_meta': ?>
			<ul class="entry-meta"><?php
					foreach ( $SingleBlogMetaStructure as $MetaData ) 
					{
						
						switch ( $MetaData ) 
						{
							
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
					}	 
					?>
			</ul> <?php
			break;
			case 'post_content': ?>
				
			<div class="entry-content">
				<?php the_content( __('Read More','wpazure') ); ?>
				<?php wp_link_pages( ); ?>
			</div> <?php 
			break;
		}

	}?>
	</div>
</div>
</article>