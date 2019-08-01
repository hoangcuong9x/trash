<?php
/**
 * Blog Section
 * 
 * @package Mudita
 */
 
$section_title = get_theme_mod( 'mudita_blog_section_title' );
$ed_blog_date  = get_theme_mod( 'mudita_ed_blog_date', '1' );
 
$blog_qry = new WP_Query( array( 
    'post_type'             => 'post',
    'posts_per_page'        => 3,
    'ignore_sticky_posts'   => true
));

?>
<div class="container">
	<?php if( $section_title ) echo '<header class="header"><h2 class="main-title">' . esc_html( $section_title ) . '</h2></header>'; ?>
    
    <?php if( $blog_qry->have_posts() ){ ?>
	<div class="row">
	<?php while( $blog_qry->have_posts() ){ 
	       $blog_qry->the_post();
       ?>
        <article class="post">
            <?php if( has_post_thumbnail() ){ ?>
			<a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail( 'mudita-blog' );?></a>
            <?php }?>
			<div class="entry-header">
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
            <?php if( $ed_blog_date ){?>
			<div class="entry-meta">
				<span class="posted-on">
					<span class="fa fa-calendar-o"></span><a href="<?php the_permalink(); ?>"><time><?php echo esc_html( get_the_date('j M Y') ); ?></time></a>
				</span>
			</div>
            <?php } ?>
		</article>
	<?php }
    wp_reset_postdata(); 
    ?>
	</div>
    <?php } ?>
</div>