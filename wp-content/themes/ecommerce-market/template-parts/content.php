<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eCommerce_Market
 */

?>

<article data-os-animation="fadeInDown" id="post-<?php the_ID(); ?>" <?php post_class( 'post-item os-animation' ); ?>>
	<?php 
	if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ecommerce_market_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php
	endif; 
	?>


	<div class="entry-meta post-details">

		<?php ecommerce_market_categories_list(); ?>

		<?php ecommerce_market_author_info(); ?>

	</div>	

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
	</header><!-- .entry-header -->	

	<?php if ( has_post_thumbnail() ) : ?>

	    <figure class="post-image">
	      
	    	<?php the_post_thumbnail( 'ecommerce-market-archive' ); ?>

	    </figure>	

    <?php endif;?>	

	<div class="entry-content">

		<?php the_excerpt();?>		

		<?php $archive_readmore = ecommerce_market_get_option( 'archive_readmore' ); ?>
		<a class="read-more" href="<?php the_permalink();?>"><?php echo esc_html( $archive_readmore );?></a>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ecommerce_market_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
