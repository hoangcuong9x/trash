<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Mudita
 */

global $wp_query;

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Search Result', 'mudita' ); ?></h1>
                <h2 class="count"><?php echo $wp_query->found_posts . __( ' result for: ', 'mudita' ) . get_search_query(); ?></h2>
			</header><!-- .page-header -->

			<?php

			/* Start the Loop */
			while ( have_posts() ) : the_post();
                
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_pagination( array(
    	        'prev_text'          => '<span class="fa fa-angle-double-left"></span>',
    	        'next_text'          => '<span class="fa fa-angle-double-right"></span>',
    	        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mudita' ) . ' </span>',
             ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
