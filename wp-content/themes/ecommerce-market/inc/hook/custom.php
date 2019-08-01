<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package eCommerce_Market
 */

if ( ! function_exists( 'ecommerce_market_site_branding' ) ) :
	/**
	 * Site branding 
 	 *
	 * @since 1.0.0
	 */
function ecommerce_market_site_branding() {
	?>
	<div class="hgroup-wrap">
		<div class="container">
			<div class="hgroup-left">

				<section class="site-branding"> <!-- site branding starting from here -->

					<?php 
					$site_identity = ecommerce_market_get_option( 'site_identity' );	
					$title = get_bloginfo( 'name', 'display' );							
					$description    = get_bloginfo( 'description', 'display' );
					?>

					<?php if ( 'logo-only' == $site_identity) {

						if( has_custom_logo() ):

							the_custom_logo();

						endif;
					} elseif ( 'logo-text' == $site_identity ) {
						
						if ( has_custom_logo() ) :

							the_custom_logo();

						endif;

						if ( $description ):

							echo '<p class="site-description">'.esc_html( $description ).'</p>';

						endif;
					} elseif ( 'title-only' == $site_identity) {
						
						if( $title ) : ?>

						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

					<?php endif;

				} elseif ( 'title-text' == $site_identity ) {
					
					if( $title ) : ?>

					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

				<?php endif;

				if ( $description ) :

					echo '<p class="site-description">'.esc_html( $description ).'</p>';

				endif;
			} 
			?>						
			
		</section> <!-- site branding ends here -->

		<?php $search_in_header = ecommerce_market_get_option( 'search_in_header' ); ?>

		<?php if ( true == $search_in_header) : ?>
			
			<div class="product-search-section">

				<?php if ( ecommerce_market_is_woocommerce_active() ) : ?>
					
					<?php get_template_part( 'template-parts/product-search' ); ?>

				<?php else : ?>

					<?php get_search_form();?>
					
				<?php endif; ?>

			</div>

		<?php endif; ?>				


	</div>
	<?php 
	$hgroup_class = '';
	if ( ! has_nav_menu( 'top-menu' ) ) {
		$hgroup_class = 'hgroup-login-wrap';

	}?>

	<div class="hgroup-right <?php echo esc_attr( $hgroup_class);?>">

		<?php if ( has_nav_menu( 'top-menu' ) ) : ?>

			<div class="header-menu-holder">
			<a href="#" class="toggle">
		        <span></span>
		        <span></span>
		        <span></span>
			</a>		
	
				<div class="top-header-menu-wrapper ">
					<?php wp_nav_menu( array(
						'theme_location'  => 'top-menu',
						'container'       => false,							
						'depth'           => 1,
						'fallback_cb'     => 'wp_page_menu',

						) ); ?>
				</div>
			</div>	

			<?php endif; ?>

				<?php if ( ecommerce_market_is_woocommerce_active() ) : ?>

				<?php $login_header = ecommerce_market_get_option( 'login_header' ); ?>

				<?php if ( true == $login_header ) :?>

						<div class="login-register-wrap">
							<?php
							if (is_user_logged_in()) {
								global $current_user;
								wp_get_current_user();
								?>
								<a href="<?php echo esc_url(wp_logout_url( home_url() )); ?>" class="btn">
									<?php echo esc_html__(' Logout', 'ecommerce-market'); ?>
								</a>
								<?php } else { ?>
								<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_myaccount_page_id' ) )); ?>" class="btn toogle-popup">
									<?php echo esc_html__('Register / Login', 'ecommerce-market'); ?>
								</a>

								<?php 
								$popup_class = 'popup-wrapper-no-login';
								if ( shortcode_exists( 'woocommerce_my_account' ) ):

									$popup_class = 'popup-wrapper-login';						

								endif;

								?>

									<div class="popup-wrapper <?php echo esc_attr( $popup_class);?>">
										<div class="popup-wrap">
											<span class="close"><i class="fa fa-close"></i></span>
											<?php echo do_shortcode( '[woocommerce_my_account]');?>
										</div>
									</div>

								
							<?php } ?>

						</div>

				<?php endif; ?>

			<?php endif;?>

			</div>
		</div>
	</div>
	
	<?php 	
}

endif;
add_action( 'ecommerce_market_action_header', 'ecommerce_market_site_branding');

if ( ! function_exists( 'ecommerce_market_primary_menu' ) ) :
	/**
	 * Site branding 
 	 *
	 * @since 1.0.0
	 */
function ecommerce_market_primary_menu() {
	?>
	<section class="header-nav-section">
		<div class="container">	

			<div id="navbar" class="navbar">  <!-- navbar starting from here -->
				<nav id="site-navigation" class="navigation main-navigation">
					<div class="menu-top-menu-container clearfix">

						<?php wp_nav_menu( array(
							'theme_location'  => 'menu-1',
							'container'       => false,	
							'fallback_cb'     => 'wp_page_menu',

							) ); ?>

						</div>
					</nav>
				</div> <!-- navbar ends here -->


				<div class="header-information">

					<?php if ( has_nav_menu( 'social-menu' ) ) : ?>

						<div class="inline-social-icons social-links">					

							<?php wp_nav_menu( array(
								'theme_location'  => 'social-menu',
								'container'       => false,	
								'fallback_cb'     => 'wp_page_menu',

								) ); ?>

							</div>

						<?php endif; ?>

						<div class="header-product-info">

							<?php if ( ecommerce_market_is_woocommerce_active() ) : ?>

								<?php $cart_header = ecommerce_market_get_option( 'cart_header' ); ?>								

								<?php if ( true == $cart_header ) : ?>

									<div class="header-cart-wrapper clearfix">
										<div class="cart-wrapper">

											<div class="site-cart-views">

												<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													<span class="cart-value"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?>
														
													</span>
												</a>	

											</div>

										</div>
									</div>

								<?php endif; ?>
								
							<?php endif;?>

						</div>

					</div>
				</div>
			</section> 

			<?php 	
		}

		endif;
		add_action( 'ecommerce_market_action_header', 'ecommerce_market_primary_menu', 20 );

if ( ! function_exists( 'ecommerce_market_slider' ) ) :
/**
 * Ecommerce Market Slider
 *
 * @since 1.0.0
 */
function ecommerce_market_slider() {

	if ( is_front_page() ) { ?>

	<?php $featured_slider = ecommerce_market_get_option( 'featured_slider' ); ?>

	<?php if( true == $featured_slider ) : ?>

		<?php $featured_slider_type = ecommerce_market_get_option( 'featured_slider_type' ); 		

		$featured_slider_number 	= ecommerce_market_get_option( 'featured_slider_number' );
		$featured_category 			= ecommerce_market_get_option( 'featured_category' );
		$featured_product_category 	= ecommerce_market_get_option( 'featured_product_category' );
		$featured_slider_read_more_text 	= ecommerce_market_get_option( 'featured_slider_read_more_text' );

		$overlay_text 	= ecommerce_market_get_option( 'overlay_text' );
		?>


		<section class="featured-slider"> <!-- featured-slider starting from here -->
			<div id="owl-slider-demo" class="owl-carousel owl-theme">

				<?php if ( 'featured-category' == $featured_slider_type ) { 

					$post = 'post';
					$slider_category = $featured_category;

				} else{

					$post = 'product';
					$slider_category = $featured_product_category;

				} ?>				

				<?php 
				$slider_args = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'post_type' => esc_attr( $post ),
					'post_status' => 'publish',
					'paged' => 1,
					);

				if ( 'featured-category' == $featured_slider_type ) { 

					if ( absint( $slider_category ) > 0 ) {
						$slider_args['cat'] = absint( $slider_category );
					}

				} else{

					if ( absint( $slider_category ) > 0 ) {
						$slider_args['tax_query'] =array(
							array(
								'taxonomy'  => 'product_cat',
								'field'     => 'id',
								'terms'     => absint( $slider_category ),
							)
						);
					}					

				} 
							// Fetch posts.
				$the_query = new WP_Query( $slider_args );
				?>	
				<?php if ( $the_query->have_posts() ) : 	

				while ( $the_query->have_posts() ) : $the_query->the_post();  ?>	

				<?php $thumail_image = '';

				if( !has_post_thumbnail() ):

					$thumail_image = 'no-image';

				endif; ?>


				<div class="slider-content <?php echo esc_attr( $thumail_image);?>">

					<figure class="slider-image">

						<?php the_post_thumbnail( 'ecommerce-market-slider' );?>

					</figure>

					<div class="slider-text v-center">
						<h3 class="os-animation">
							<?php
							$excerpt = ecommerce_market_the_excerpt(3);
							echo wp_kses_post( wpautop( $excerpt ) );
							?>
						</h3>
						<h2 class="slider-title"><?php the_title();?></h2>

						<?php if( !empty( $featured_slider_read_more_text) ): ?>
							<div class="slider-btn">
								<a href="<?php the_permalink();?>" class="btn">
									<?php echo esc_html( $featured_slider_read_more_text );?>
									
								</a>
							</div>

						<?php endif;?>

						<?php if ( !empty( $overlay_text ) ) :?>

							<span class="slider-text-category">
								<?php echo esc_html( $overlay_text); ?>
								
							</span>

						<?php endif; ?>
					</div>

				</div>

			<?php endwhile; 
			wp_reset_postdata();

			endif; ?>

		</div> 

	</section> <!-- featured-slider ends here -->


<?php endif;	

} else {

	$bg_image_url = get_header_image(); ?>

	<div class="page-title-wrap" style="background-image:url( <?php echo esc_url( $bg_image_url )?>);">
		<div class="container">
			<h2 class="page-title">

				<?php if ( is_archive() ) {
					the_archive_title();
				}elseif (is_search()) {
					/* translators: %s: search term */
					printf( esc_html__( 'Search Results for: %s', 'ecommerce-market' ), '<span>' . get_search_query() . '</span>' );/* translators: %s: search term */
				}else{	            	
					echo single_post_title();
					
				} ?>

			</h2>

			<?php $enable_breadcrumb = ecommerce_market_get_option( 'enable_breadcrumb' );

			if( true === $enable_breadcrumb):?>
			<?php ecommerce_market_breadcrumb(); ?>
		<?php endif;	?>			


	</div>
</div>		

<?php } 

}


endif;
add_action( 'ecommerce_market_action_header', 'ecommerce_market_slider', 30 );

if ( ! function_exists( 'ecommerce_market_subscription' ) ) :

	/**
	 * Footer Subscription.
	 *
	 * @since 1.0.0
	 */
function ecommerce_market_subscription() {
	?>	
	<?php 
	$subscription_page = ecommerce_market_get_option( 'subscription_page' );
	if( !empty( $subscription_page ) ): ?>

	<section class="subscribe-section">
		<?php ; 

		$args = array (	            		            
			'page_id'			=> absint($subscription_page ),
			'post_status'   	=> 'publish',
			'post_type' 		=> 'page',
			);

		$loop = new WP_Query($args); 


		if ( $loop->have_posts() ) : 

			while ($loop->have_posts()) : $loop->the_post(); ?>
		<?php if ( has_post_thumbnail() ) : ?>

			<figure class="featured-image os-animation" data-os-animation="bounceInRight">
				<?php the_post_thumbnail( 'ecommerce-market-subscription' );?>
			</figure>

		<?php endif;?>

		<div class="container">
			<div class="row">
				<div class="custom-col-6 os-animation" data-os-animation="bounceInLeft">
					<div class="subscribe-content">

						<header class="entry-header heading">
							<h2 class="entry-title"><?php the_title();?></h2>
						</header>

						<?php the_content(); ?>

					</div>
				</div>
			</div>
		</div>

	<?php endwhile;

	wp_reset_postdata();

	endif; ?>

</section>	
<?php endif;
}
endif;

add_action( 'ecommerce_market_action_footer', 'ecommerce_market_subscription', 10 );
if ( ! function_exists( 'ecommerce_market_footer_widgets' ) ) :
	/**
	 * Footer Menu
 	 *
	 * @since 1.0.0
	 */
function ecommerce_market_footer_widget() {
	?>
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' ) ) : ?>
	
		<div class="widget-area"> <!-- widget area starting from here -->
			<div class="container">
				<div class="row">
					<?php
					$column_count = 0;
					$class_coloumn =12;
					for ( $i = 1; $i <= 4; $i++ ) {
						if ( is_active_sidebar( 'footer-' . $i ) ) {
							$column_count++;
							$class_coloumn = 12/$column_count;
						}
					} ?>

					<?php $column_class = 'custom-col-' . absint( $class_coloumn );
					for ( $i = 1; $i <= 4 ; $i++ ) {
						if ( is_active_sidebar( 'footer-' . $i ) ) { ?>
							<div class="<?php echo esc_attr( $column_class ); ?>">
								<?php dynamic_sidebar( 'footer-' . $i ); ?>
							</div>
						<?php }
					} ?>
				</div>
			</div>

		</div> <!-- widget area starting from here -->
	<?php endif;?> 	

	<?php 
}
endif;
add_action( 'ecommerce_market_action_footer', 'ecommerce_market_footer_widget', 12 );

if ( ! function_exists( 'ecommerce_market_contact_section' ) ) :

	/**
	 * Footer Contact Info.
	 *
	 * @since 1.0.0
	 */
function ecommerce_market_contact_section() {
	?>

	<?php $footer_address = ecommerce_market_get_option('footer_address');
	$footer_number = ecommerce_market_get_option('footer_number');
	$footer_email = ecommerce_market_get_option('footer_email'); 

	if( !empty($footer_address) || !empty($footer_number) || !empty($footer_email) ): ?>		
	<section class="contact-information">
		<div class="container">

			<?php if( !empty( $footer_address ) ) : ?>

				<dl class=" os-animation" data-os-animation="fadeInDown">
					<dt><i class="fa fa-map-marker"></i></dt>
					<dd><p><?php echo esc_html( $footer_address );?></p></dd>
				</dl> 

			<?php endif;?>  


			<?php if( !empty( $footer_number ) ) : ?>

				<dl class=" os-animation" data-os-animation="fadeInDown">
					<dt><i class="fa fa-phone"></i></dt>
					<dd><p><a href="<?php echo preg_replace( '/\D+/', '', esc_attr( $footer_number ) ); ?>"><?php echo esc_attr($footer_number);?></a></p>						
					</dd>
				</dl>  

			<?php endif; ?>


			<?php if( !empty( $footer_email ) ) : ?>

				<dl class=" os-animation" data-os-animation="fadeInDown">

					<dt><i class="fa fa-envelope"></i></dt>
					<dd><p><a href="mailto:<?php echo esc_attr($footer_email);?>"><?php echo esc_attr( antispambot( $footer_email ) ); ?></a></p></dd>

				</dl>    

			<?php endif;?>

		</div>
	</section>

<?php endif; ?>
<?php
}

endif;

add_action( 'ecommerce_market_action_footer', 'ecommerce_market_contact_section', 15 );



if ( ! function_exists( 'ecommerce_market_footer_copyright' ) ) :

	/**
	 * Footer copyright.
	 *
	 * @since 1.0.0
	 */
function ecommerce_market_footer_copyright() {
	?>
	<section class="bottom-footer"> <!-- site-generator starting from here -->
		<div class="container">

			<?php $footer_logo = ecommerce_market_get_option('footer_logo');

			if ( true == $footer_logo) : 

				if( has_custom_logo() ) : ?>

					<div class="textwidget class=" os-animation" data-os-animation="fadeInDown">
						
						<?php the_custom_logo();?>

					</div>

				<?php endif;
				
			endif; ?>

			
			<?php $footer_social_icon = ecommerce_market_get_option('footer_social_icon');
			if ( true == $footer_social_icon ):

				if( has_nav_menu( 'social-menu' ) ) : ?>

			<div class="inline-social-icons social-links"> <!-- inline social links starting from here -->

				<?php wp_nav_menu( array(
					'theme_location'  => 'social-menu',
					'container'       => false,	
					'fallback_cb'     => 'wp_page_menu',

					) ); ?>

				</div> <!-- inline social links ends here -->

			<?php endif;

			endif; ?>

			<div class="site-generator class=" os-animation" data-os-animation="fadeInDown">
				<?php $footer_social_icon = ecommerce_market_get_option('footer_social_icon'); ?>

				<?php 
				$copyright_footer = ecommerce_market_get_option( 'copyright_text' ); 
				if ( ! empty( $copyright_footer ) ) {
					$copyright_footer = wp_kses_data( $copyright_footer );
				}
				/* translators: %s: theme */ 
				$powered_by_text = sprintf( __( 'Theme of %s', 'ecommerce-market' ), '<a target="_blank" rel="designer" href="https://rigorousthemes.com/">Rigorous Themes</a>' ); /* translators: %s: theme info */ 
				?>
				<span class="copy-right"><?php echo wp_kses_post($powered_by_text);?>&nbsp;<?php echo esc_html( $copyright_footer );?></span>

			</div>
		</div> 
	</section> <!-- site-generator ends here -->
	
	<?php
}

endif;

add_action( 'ecommerce_market_action_footer', 'ecommerce_market_footer_copyright', 20 );

if ( ! function_exists( 'ecommerce_market_navigation' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
function ecommerce_market_navigation() {

	$pagination_option = ecommerce_market_get_option('pagination_option');

	if ( 'default' == $pagination_option) {

		the_posts_navigation();	

	} else{

		the_posts_pagination( array(
			'mid_size' => 5,
			'prev_text' => __( 'PREV', 'ecommerce-market' ),
			'next_text' => __( 'NEXT', 'ecommerce-market' ),
			) );
	}

}
endif;

add_action( 'ecommerce_market_action_navigation', 'ecommerce_market_navigation' );


